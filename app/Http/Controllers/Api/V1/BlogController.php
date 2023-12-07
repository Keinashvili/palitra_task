<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BlogRequest;
use App\Http\Resources\V1\BlogResource;
use App\Repositories\BlogRepositoryInterface;
use App\Services\V1\{BlogService, ImageService};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function __construct(
        private readonly BlogRepositoryInterface $blogRepository,
    ){}

    public function index(): AnonymousResourceCollection
    {
        return BlogResource::collection(
            $this->blogRepository->getAllBlogWithTagAndFilter(
                request()->search,
                request()->filter
            )
        );
    }

    public function store(BlogRequest $request, BlogService $service, ImageService $imageService): Response
    {
        return $service->store($request, $imageService);
    }

    public function attachTag($blogId, $tagId): BlogResource
    {
        $blog = $this->blogRepository->getBlogById($blogId);

        $blog->tag()->attach($tagId);

        return BlogResource::make($blog);
    }

    public function detachTag($blogId, $tagId): BlogResource
    {
        $blog = $this->blogRepository->getBlogById($blogId);

        $blog->tag()->detach($tagId);

        return BlogResource::make($blog);
    }
}
