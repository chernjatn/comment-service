<?php

namespace App\Console\Commands;

use App\Enums\Channel;
use App\Services\Article\Exceptions\ArticlesImportException;
use App\Services\Entity\AddArticle;
use Illuminate\Console\Command;

class ImportArticles extends Command
{
    protected $signature = 'app:import-articles';

    protected $description = 'import articles';

    public function handle()
    {
        try {
            foreach (Channel::cases() as $channel) {
                $articles = articleManager()->getArticles($channel->value);

                AddArticle::process($articles);
            }
        } catch (\Throwable $exc) {
            (new ArticlesImportException($exc->getMessage(), (int) $exc->getCode(), $exc))->report();
        }
    }
}
