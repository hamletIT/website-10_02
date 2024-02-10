<?php

namespace App\Http\Controllers\Api\V1;

use App\Interfaces\SiteInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\SiteService\{SiteServices, SiteServicesGetValidate, SiteServicesCreateValidate};

class SitesController extends Controller implements SiteInterface
{
    public function __construct(
        public SiteServices $siteServices,
    ) { }

    /**
     * @OA\Post(
     *     path="/api/create-website",
     *     summary="Request that add new Web Site",
     *     description="",
     *     tags={"Web Site Section"},
     *     @OA\Parameter(
     *        name="domain",
     *        in="query",
     *        description="Please write a Domain",
     *        required=true,
     *        allowEmptyValue=false,
     *     ),
     *     @OA\Parameter(
     *        name="status",
     *        in="query",
     *        description="Please write status",
     *        required=false,
     *        allowEmptyValue=true,
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
    public function createWebsite(SiteServicesCreateValidate $request): bool|JsonResponse
    {
        return $this->siteServices->create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/get-website",
     *     summary="Request that get single web site",
     *     description="",
     *     tags={"Web Site Section"},
     *     @OA\Parameter(
     *        name="id",
     *        in="query",
     *        description="Please write web site id",
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
    public function getWebsite(SiteServicesGetValidate $request): JsonResponse
    {
        return $this->siteServices->getSingle($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/get-all-websites",
     *     summary="Request that get all web sites",
     *     description="",
     *     tags={"Web Site Section"},
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
    public function getAllWebsites(): JsonResponse
    {
        return $this->siteServices->getAll();
    }
}
