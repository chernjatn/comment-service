<?php

namespace Tests\Unit\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Response;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIndexReturnsDataInValidFormat()
    {
        $article = Article::create([
            'ext_id' => $this->faker->id,
            'status' => true,
        ]);

        $comment = Comment::create([
            'name'       => $this->faker->name,
            'article_id' => $article->ext_id,
            'is_active'  => true,
            'rating'     => 5,
        ]);

        $this->json('get', "api/comments/$article->ext_id")
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'id',
                            'text',
                            'name',
                            'rating',
                            'created_at'
                        ],
                        'links' => [
                            'first',
                            'last',
                            'prev',
                            'next'
                        ],
                        'meta' => [
                            "current_page",
                            "from",
                            "last_page",
                            "links" => [
                                [
                                    "url",
                                    "label",
                                    "active"
                                ],
                                [
                                    "url",
                                    "label",
                                    "active"
                                ],
                                [
                                    "url",
                                    "label",
                                    "active"
                                ],
                            ],
                        ],
                        'avgRating',
                        'countStars',
                    ]
                ]
            );
    }

    public function testCommentIsCreatedSuccessfully() {
        $article = Article::create([
            'ext_id' => $this->faker->id,
            'status' => true,
        ]);

        $payload = [
            'name'       => $this->faker->name,
            'is_active'  => true,
            'rating'     => 5,
        ];

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
}
