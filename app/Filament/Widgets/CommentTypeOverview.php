<?php

namespace App\Filament\Widgets;

use App\Enums\Channel;
use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CommentTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = [];

        foreach (Channel::cases() as $channel) {
            $stats[] = Stat::make($channel->value, Article::query()
                ->where('channel', $channel->value)->withCount('comments')->get()->sum('comments_count'));
        }

        return $stats;
    }
}
