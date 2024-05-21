<?php

namespace App\Console\Commands;

use App\Enums\Channel;
use App\Models\Article;
use App\Services\Article\Exceptions\ArticlesImportException;
use App\Services\Entity\AddArticles;
use Illuminate\Console\Command;

class ImportArticles extends Command
{
    protected $signature = 'app:import-articles';

    protected $description = 'import articles';

    public function handle()
    {
        $version = mt_rand(11111, 55555);

        try {
            foreach (Channel::cases() as $channel) {
                $articles = articleManager()->getArticles($channel->value, $version);

                AddArticles::process($articles);
            }

            Article::query()
                ->where('version', '!=', $version)
                ->delete();
        } catch (\Throwable $exc) {
            (new ArticlesImportException($exc->getMessage(), (int) $exc->getCode(), $exc))->report();
        }
    }
}
