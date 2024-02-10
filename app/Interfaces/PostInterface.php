<?php

namespace App\Interfaces;

use Illuminate\Http\JsonResponse;
use App\Services\Post\PostServicesGetValidate;
use App\Services\Post\PostServicesCreateValidate;

/**
 * Interface PostInterface
 * @package App\Interfaces
 */
interface PostInterface
{
    /**
     * Create a new post.
     *
     * @param PostServicesCreateValidate $request The request object containing validated data for creating a post.
     * @return void
     */
    public function createPost(PostServicesCreateValidate $request): void;

    /**
     * Retrieve a specific post.
     *
     * @param PostServicesGetValidate $request The request object containing validated data for retrieving a post.
     * @return JsonResponse The JSON response containing the post data.
     */
    public function getPost(PostServicesGetValidate $request): JsonResponse;

    /**
     * Retrieve all posts.
     *
     * @return JsonResponse The JSON response containing all posts.
     */
    public function getAllPosts(): JsonResponse;

    /**
     * Retrieve posts belonging to a specific website.
     *
     * @return JsonResponse The JSON response containing posts belonging to a specific website.
     */
    public function getWebsitePosts(): JsonResponse;
}
