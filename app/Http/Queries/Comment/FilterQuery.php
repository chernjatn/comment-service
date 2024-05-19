<?php

namespace App\Http\Queries\Comment;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilterQuery extends QueryBuilder
{
    public function __construct(?Request $request = null)
    {
        parent::__construct(Comment::query()->with(['article'])->compact(), $request);

        $this
            ->allowedFilters([
                AllowedFilter::exact('inSlider', 'in_slider'),
                AllowedFilter::exact('hasHeadingId', 'heading_id'),
                AllowedFilter::exact('tradeNameId','tradeNames.id')
            ])
            ->allowedSorts([
                'created_at',
            ])
            ->defaultSort('-id');
    }
}
