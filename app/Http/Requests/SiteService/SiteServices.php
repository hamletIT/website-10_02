<?php

namespace App\Http\Requests\SiteService;

use Exception;
use App\Models\WebSites;
use App\Traits\Parameters;
use Illuminate\Http\JsonResponse;
use App\Traits\ValidateParameters;
use App\Services\Json\CompilerJson;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiteServices extends CompilerJson
{
    use Parameters, ValidateParameters;

    /**
     * Create a new website record.
     *
     * @param array $data An array containing data for creating the website record.
     *                    The array should contain keys corresponding to the fields of the website record.
     * @return int|JsonResponse The ID of the newly created record or false on failure.
     *                               In case of successful creation, it returns the ID of the new record.
     *                               If an exception occurs during creation, it may return a JSON response
     *                               with error details.
     * @throws ValidationException If the data fails validation.
     * @throws ModelNotFoundException If the model cannot be found.
     */
    public function create(array $data): int|JsonResponse
    {
        try {
            $res = WebSites::create([
                $this->domain => $data[$this->domain],
                $this->status => 0,
            ]);

            return $this->generator($res,'Web site data',200);
        } catch (ValidationException $e) {
            return $this->generator($e, $e->getMessage(), 422);
        } catch (ModelNotFoundException $e) {
            return $this->generator($e, $e->getMessage(), 404);
        } catch (Exception $e) {
            return $this->generator($e, $e->getMessage(), 500);
        }
    }

    /**
     * Retrieve a single website by ID.
     *
     * @param array $data An array containing the ID of the website to retrieve.
     * @return JsonResponse A JSON response containing the website data.
     */
    public function getSingle(array $data): JsonResponse
    {
        $data = WebSites::where($this->id, $data[$this->id])->get();

        return $this->generator($data,'Web site data',200);
    }

    /**
     * Retrieve all websites.
     *
     * @return JsonResponse A JSON response containing all website data.
     */
    public function getAll(): JsonResponse
    {
        $data = WebSites::get();

        return $this->generator($data,'Web site data',200);
    }
}
