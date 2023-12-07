<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\{Builder, Collection, Model};

interface BlogRepositoryInterface
{
    public function getAllBlogWithTagAndFilter($search, $filter = null): Collection|array;

    public function getBlogById($id): Model|Collection|Builder|array|null;
}
