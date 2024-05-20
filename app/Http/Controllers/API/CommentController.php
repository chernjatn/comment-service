<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Queries\Comment\FilterQuery;
use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    public function index(FilterQuery $filterQuery, Request $request): AnonymousResourceCollection
    {
        $comments = $filterQuery
            ->paginate($request->input('per_page'));

        return CommentResource::collection($comments);
    }

    public function store(Article $article, CommentRequest $request)
    {
        return response()->json([
            'success' => $article->comments()->insert(['text' => $request->getText(), 'is_active' => false])
        ]);
    }
}
