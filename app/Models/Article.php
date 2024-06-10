<?php

namespace App\Models;

use App\Models\Traits\HasChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory, HasChannel;

    protected $fillable = [
        'ext_id',
        'channel',
        'title',
        'version'
    ];

    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class, 'article_id', 'ext_id');
    }
}
