<?php

namespace App\Providers;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\LessonWatched;
use App\Events\CommentWritten;
use App\Listener\storeCommentAchievement;
use App\Listener\storeLessonWatchedAchievement;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CommentWritten::class => [
            storeCommentAchievement::class,
        ],
        LessonWatched::class => [
            storeLessonWatchedAchievement::class,
        ],
        AchievementUnlocked::class => [
            storeLessonWatchedAchievement::class,
        ],
        BadgeUnlocked::class => [
            storeLessonWatchedAchievement::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
