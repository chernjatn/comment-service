<?php

namespace App\Services\Article\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ArticlesImportException extends Exception
{
    public function report()
    {
        Log::channel('articles-import')->error($this->getMessage(), ['exception' => $this]);
    }
}
