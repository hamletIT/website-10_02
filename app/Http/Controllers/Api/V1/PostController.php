<?php

namespace App\Http\Controllers\Api\V1;

use App\Interfaces\PostInterface;
use Illuminate\Http\JsonResponse;
use App\Services\Post\PostService;
use App\Services\Email\EmailService;
use App\Http\Controllers\Controller;
use App\Services\Post\PostServicesGetValidate;
use App\Services\Post\PostServicesCreateValidate;
use Illuminate\Validation\ValidationException;

class PostController extends Controller implements PostInterface
{
    public function __construct(
        public PostService $postService,
        public EmailService $emailService,
    ) { }

    /**
     * @OA\Post(
     *     path="/api/create-post",
     *     summary="Request that add new post",
     *     description="",
     *     tags={"Post Section"},
     *     @OA\Parameter(
     *        name="title",
     *        in="query",
     *        description="Please write title",
     *        required=true,
     *        allowEmptyValue=false,
     *     ),
     *     @OA\Parameter(
     *        name="description",
     *        in="query",
     *        description="Please write description",
     *        required=true,
     *        allowEmptyValue=false,
     *     ),
     *     @OA\Parameter(
     *        name="website_id",
     *        in="query",
     *        description="Please write a website id",
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
    public function createPost(PostServicesCreateValidate $request): void
    {
        $postInfo = $this->postService->create($request->all());
        $this->emailService->sendMail($postInfo);
    }

    /**
     * @OA\Get(
     *     path="/api/get-post",
     *     summary="Request that get a single post",
     *     description="",
     *     tags={"Post Section"},
     *     @OA\Parameter(
     *        name="id",
     *        in="query",
     *        description="Please write post id",
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
    public function getPost(PostServicesGetValidate $request): JsonResponse
    {
        return $this->postService->get($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/get-all-posts",
     *     summary="Request that get all post",
     *     description="",
     *     tags={"Post Section"},
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
    public function getAllPosts(): JsonResponse
    {
        return $this->postService->getAll();
    }

    /**
     * @OA\Get(
     *     path="/api/get-website-posts",
     *     summary="Request that get all post wits website",
     *     description="",
     *     tags={"Post Section"},
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
    public function getWebsitePosts(): JsonResponse
    {
        return $this->postService->getAllWebs();
    }
}
