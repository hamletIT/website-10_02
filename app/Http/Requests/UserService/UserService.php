<?php

namespace App\Http\Requests\UserService;

use App\Models\User;
use App\Traits\Parameters;
use App\Models\Subscriptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Services\Json\CompilerJson;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService extends CompilerJson
{
    use Parameters;

    /**
     * Create a new user record and associated subscription.
     *
     * @param array $data An array containing data for creating the user and subscription records.
     *              The array should contain keys corresponding to the fields of the user and subscription records.
     * @return array|JsonResponse The data array if user creation is successful.
     *                            If an exception occurs during creation, it may return a JSON response
     *                            with error details.
     * @throws ValidationException If the data fails validation.
     * @throws ModelNotFoundException If the model cannot be found.
     */
    public function createUser(array $data): array|JsonResponse
    {
        try {
            $rand_min = config('app.rand_min');
            $rand_max = config('app.rand_max');
            $user = User::create([
                $this->name => 'user'.rand($rand_min,$rand_max),
                $this->email => $data[$this->email],
                $this->password => Hash::make('user'.rand($rand_min,$rand_max)),
            ]);
            Subscriptions::create([
                $this->status => 0,
                $this->userId => $user->id,
                $this->email => $data[$this->email],
                $this->websiteId => $data[$this->domain],
            ]);
            return $data;
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
}
