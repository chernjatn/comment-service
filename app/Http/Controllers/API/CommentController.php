<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Queries\Comment\FilterQuery;
use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CommentController extends Controller
{
    public function index(FilterQuery $filterQuery, Request $request): AnonymousResourceCollection
    {
        $comments = $filterQuery->get();

        $paginator = $this->getPaginator($comments, $request);

        return CommentResource::collection($paginator)->additional([
            'avgRating'  => $comments->avg('rating'),
            'countStars' => $comments->groupBy('rating')->map(fn (Collection $items) => $items->count())
        ]);
    }

    public function store(Article $article, CommentRequest $request)
    {
        $article->comments()->create([
            'text'      => $request->getText(),
            'name'      => $request->getName(),
            'rating'    => $request->getRating(),
            'is_active' => false,
        ]);

        return response()->json(['success' => true]);
    }

    public function getPaginator(Collection $items, Request $request): LengthAwarePaginator
    {
        return new LengthAwarePaginator($items, $items->count(), $request->input('per_page') ?? 1);
    }
}
