<?php

namespace App\Services\V1;

use App\Models\Blog;
use Illuminate\Http\Response;

class BlogService
{
    public function store($request, $imageService): Response
    {
        Blog::query()
            ->create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageService->upload($request)
            ]);

        return response()->noContent(201);
    }
}
