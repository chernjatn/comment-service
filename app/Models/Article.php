<?php

namespace App\Models;

use App\Models\Traits\HasChannel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory, HasChannel;

    public function articles(): HasMany
    {
        return $this->HasMany(Comment::class);
    }

    protected static function booted()
    {
        if (request()->wantsJson()) {
            static::addGlobalScope('is_active', function (Builder $builder) {
                $builder->where('status', true);
            });
        }
    }
}
