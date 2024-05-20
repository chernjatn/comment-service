<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'is_active',
        'name',
        'article_id',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id','ext_id');
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active', true);
    }

    protected static function booted()
    {
        if (request()->wantsJson()) {
            static::addGlobalScope('is_active', function (Builder $builder) {
                $builder->active();
            });
        }
    }
}
