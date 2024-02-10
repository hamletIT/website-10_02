<?php

namespace App\Http\Requests\SubscriptionService;

use App\Traits\Parameters;
use App\Models\Subscriptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Services\Json\CompilerJson;
use App\Http\Requests\UserService\UserService;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubscriptionService extends CompilerJson
{
    use Parameters;
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Create a new subscription record.
     *
     * @param array $data An array containing data for creating the subscription record.
     *                    The array should contain keys corresponding to the fields of the subscription record.
     * @return int|JsonResponse The ID of the newly created record or false on failure.
     *                               In case of successful creation, it returns the ID of the new record.
     *                               If an exception occurs during creation, it may return a JSON response
     *                               with error details.
     * @throws ValidationException If the data fails validation.
     * @throws ModelNotFoundException If the model cannot be found.
     */
    public function create(array $data): int|JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->userService->createUser($data);
            DB::commit();
            return $this->generator($data, 'Subscription created', 200);
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
     * Retrieve a single subscription by user ID.
     *
     * @param array $data An array containing the ID of the user whose subscription is to be retrieved.
     * @return JsonResponse A JSON response containing the subscription data.
     */
    public function get(array $data): JsonResponse
    {
        $data = Subscriptions::with('user')->where($this->userId,$data[$this->id])->get();

        return $this->generator($data,'Subscription data',200);
    }

    /**
     * Retrieve all subscriptions with associated user information.
     *
     * @return JsonResponse A JSON response containing all subscription data with user information.
     */
    public function getAll(): JsonResponse
    {
        $data = Subscriptions::with('user')->get();

        return $this->generator($data,'Subscriptions data with user',200);
    }
}
