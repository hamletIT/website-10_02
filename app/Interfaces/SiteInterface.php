<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use App\Services\SiteService\SiteServicesGetValidate;
use App\Services\SiteService\SiteServicesCreateValidate;

/**
 * Interface SiteInterface
 * @package App\Interfaces
 */
interface SiteInterface
{
    /**
     * Create a new website.
     *
     * @param SiteServicesCreateValidate $request The request object containing validated data for creating a website.
     * @return bool|JsonResponse True if the website was created successfully, otherwise a JsonResponse.
     */
    public function createWebsite(SiteServicesCreateValidate $request): bool|JsonResponse;

    /**
     * Retrieve a specific website.
     *
     * @param SiteServicesGetValidate $request The request object containing validated data for retrieving a website.
     * @return JsonResponse The JSON response containing the website data.
     */
    public function getWebsite(SiteServicesGetValidate $request): JsonResponse;

    /**
     * Retrieve all websites.
     *
     * @return JsonResponse The JSON response containing all websites.
     */
    public function getAllWebsites(): JsonResponse;
}
