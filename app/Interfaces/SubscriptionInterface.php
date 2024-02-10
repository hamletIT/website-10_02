<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use App\Http\Requests\SubscriptionService\SubscriberServicesGetValidate;
use App\Http\Requests\SubscriptionService\SubscriptionServicesCreateValidate;

/**
 * Interface SubscriptionInterface
 * @package App\Interfaces
 */
interface SubscriptionInterface
{
    /**
     * Subscribe a user.
     *
     * @param SubscriptionServicesCreateValidate $request The request object containing validated data for subscription.
     * @return bool|JsonResponse True if the user was successfully subscribed, otherwise false.
     */
    public function subscribe(SubscriptionServicesCreateValidate $request): bool|JsonResponse;

    /**
     * Retrieve a specific subscriber.
     *
     * @param SubscriberServicesGetValidate $request The request object containing validated data for retrieving a subscriber.
     * @return JsonResponse The JSON response containing the subscriber data.
     */
    public function getSubscriber(SubscriberServicesGetValidate $request): JsonResponse;

    /**
     * Retrieve all subscribers.
     *
     * @return JsonResponse The JSON response containing all subscribers.
     */
    public function getAllSubscribers(): JsonResponse;
}

