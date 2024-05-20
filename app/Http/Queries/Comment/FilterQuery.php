<?php

namespace App\Http\Queries\Comment;

use App\Models\Comment;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilterQuery extends QueryBuilder
{
    public function __construct(?Request $request = null)
    {
        parent::__construct(Comment::query()->with(['article']), $request);

        $this
            ->allowedFilters([
                AllowedFilter::exact('articleId','article_id')
            ])
            ->allowedSorts([
                'created_at',
            ])
            ->defaultSort('-id');
    }
}
