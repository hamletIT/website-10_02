<?php

namespace App\Services\Post;

use App\Models\Posts;
use App\Traits\Parameters;
use App\Models\Subscriptions;
use Illuminate\Http\JsonResponse;
use App\Traits\ValidateParameters;
use Illuminate\Support\Facades\DB;
use App\Services\Json\CompilerJson;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService extends CompilerJson
{
    use Parameters, ValidateParameters;

    /**
     * Create a new website record.
     *
     * @param array $data An array containing data for creating the record.
     *                    The array should contain keys corresponding to the fields of the record.
     * @return bool|int|array|JsonResponse The ID of the newly created record or false on failure.
     *                                     In case of exceptions, it may return an array with error details
     *                                     or a JSON response indicating the error.
     * @throws ValidationException If the data fails validation.
     * @throws ModelNotFoundException If the model cannot be found.
     */
    public function create(array $data): bool|int|array|JsonResponse
    {
        DB::beginTransaction();
        try {
            $result = Posts::create([
                $this->title => $data[$this->title ],
                $this->description => $data[$this->description],
                $this->status => 0,
                $this->websiteId => $data[$this->websiteId],
            ]);

            $subscriptions = Subscriptions::where($this->websiteId, $data[$this->websiteId])->get($this->email);
            $newDataEmails = $subscriptions->pluck($this->email)->toArray();
            DB::commit();
            return [
                $this->post => $result,
                $this->email => $newDataEmails
            ];
        } catch (ValidationException $e) {
            DB::rollback();
            return $this->generator($e, $e->getMessage(), 422);
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return $this->generator($e, $e->getMessage(), 404);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->generator($e, $e->getMessage(), 500);
        }
    }

    /**
     * Retrieve a specific post by ID.
     *
     * @param array $data An array containing the ID of the post to retrieve.
     * @return JsonResponse A JSON response containing the post data.
     */
    public function get(array $data): JsonResponse
    {
        $data = Posts::where($this->id,$data[$this->id])->get();
        return $this->generator($data,'Posts data',200);
    }

    /**
     * Retrieve all posts.
     *
     * @return JsonResponse A JSON response containing all post data.
     */
    public function getAll(): JsonResponse
    {
        $data = Posts::get();
        return $this->generator($data,'Posts data',200);
    }

    /**
     * Retrieve all posts with associated website information.
     *
     * @return JsonResponse A JSON response containing all post data with website information.
     */
    public function getAllWebs(): JsonResponse
    {
        $data = Posts::with('website')->get();
        return $this->generator($data,'Posts data with website',200);
    }
}
