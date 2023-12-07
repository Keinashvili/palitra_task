<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\{Builder, Collection, Model};

class BlogRepository implements BlogRepositoryInterface
{
    public function getAllBlogWithTagAndFilter($search = null, $filter = null): Collection|array
    {
        return Blog::with('tag')
            ->search($search)
            ->filter($filter)
            ->get();
    }

    public function getBlogById($id): Model|Collection|Builder|array|null
    {
        return Blog::query()->findOrFail($id);
    }
}
