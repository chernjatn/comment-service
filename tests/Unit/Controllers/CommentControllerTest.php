<?php

namespace Tests\Unit\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    public function testIndexReturnsDataInValidFormat()
    {
        $comment = Comment::factory()->forArticle()->create();

        $this->json('get', "api/comments?filter[articleId]=$comment->article_id")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment(
                [
                    [
                        'id' => $comment->id,
                        'text' => $comment->text,
                        'name' => $comment->name,
                        'rating' => $comment->rating,
                        'created_at' => Carbon::parse($comment->created_at)->format('d.m.Y')
                    ],
                    'avgRating' => 5,
                    'countStars' => [
                        "5" => 1
                    ],
                ]
            );
    }

    public function testCommentIsCreatedSuccessfully() {
        $article = Article::factory()->create();

        $payload = Comment::factory()->make()->getAttributes();

        $this->json('post', "api/comments/$article->ext_id", $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'text',
                        'name',
                        'rating',
                        'created_at'
                    ]
                ]
            );

        $this->assertDatabaseHas('comments', $payload);
    }

    public function testIndexForMissingArticle() {
        $this->json('get', "api/comments?filter[articleId]=0")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => []
                ]
            );
    }

    public function testStoreWithMissingData() {
        $article = Article::factory()->create();

        $comment = Comment::factory()->make()->getAttributes();

        $payload = collect($comment)->except('text')->all();

        $this->json('post', "api/comments/$article->ext_id", $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['errors']);
    }
}
