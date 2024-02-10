<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\SubscriptionInterface;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\SubscriptionService\{SubscriptionService,
    SubscriberServicesGetValidate,
    SubscriptionServicesCreateValidate};

class SubscriptionController extends Controller implements SubscriptionInterface
{
    public function __construct(
        public SubscriptionService $subscriptionServices,
    ) { }

    /**
     * @OA\Post(
     *     path="/api/subscribe",
     *     summary="Request for subscribing",
     *     description="",
     *     tags={"Subscribe Section"},
     *     @OA\Parameter(
     *        name="domain",
     *        in="query",
     *        description="Please write domain",
     *        required=true,
     *        allowEmptyValue=false,
     *     ),
     *     @OA\Parameter(
     *        name="email",
     *        in="query",
     *        description="Please write email",
     *        required=true,
     *        allowEmptyValue=false,
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\MediaType(
     *            mediaType="application/json",
     *        )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=429,
     *         description="validation error"
     *     )
     *   ),
     * )
     * @throws ValidationException
     */
    public function subscribe(SubscriptionServicesCreateValidate $request): bool|JsonResponse
    {
        return $this->subscriptionServices->create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/get-subscriber",
     *     summary="Request for get subscribers",
     *     description="",
     *     tags={"Subscribe Section"},
     *     @OA\Parameter(
     *        name="id",
     *        in="query",
     *        description="Please write subscriber id",
     *        required=true,
     *        allowEmptyValue=false,
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\MediaType(
     *            mediaType="application/json",
     *        )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=429,
     *         description="validation error"
     *     )
     *   ),
     * )
     */
    public function getSubscriber(SubscriberServicesGetValidate $request): JsonResponse
    {
        return $this->subscriptionServices->get($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/get-all-subscribers",
     *     summary="Request for get all subscribers",
     *     description="",
     *     tags={"Subscribe Section"},
     *     @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\MediaType(
     *            mediaType="application/json",
     *        )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=429,
     *         description="validation error"
     *     )
     *   ),
     * )
     */
    public function getAllSubscribers(): JsonResponse
    {
        return $this->subscriptionServices->getAll();
    }
}
