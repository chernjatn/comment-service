<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    private string $name;
    private string $text;
    private int    $rating;

    public function rules()
    {
        return [
            'text'   => 'required|string|min:6',
            'name'   => 'required|string|min:6',
            'rating' => 'required|integer|between:1,5',
        ];
    }

    public function passedValidation()
    {
        $this->name   = $this->get('name');
        $this->text   = $this->get('text');
        $this->rating = $this->get('rating');
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRating(): int
    {
        return $this->rating;
    }
}
