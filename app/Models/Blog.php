<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id');
    }

    public function scopeSearch($query, $search = null): void
    {
        $query->when($search ?? false, function ($query) use ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhereHas('tag', fn($query) => (
                    $query->where('name', 'LIKE', '%' . $search . '%')
                )
            );
        });
    }

    public function scopeFilter($query, $filter = null): void
    {
        if (json_decode($filter) !== null) {
            $filter = json_decode($filter);
        }

        if (gettype($filter) !== "array") {
            $filter = explode(',', $filter);
        }

        $query->when($filter ?? false, function ($query) use ($filter) {
            $query->whereHas('tag', fn($query) => $query->whereIn('id', $filter));
        });
    }
}
