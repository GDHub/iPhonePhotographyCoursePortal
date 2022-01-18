<?php

namespace Tests\Feature;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class EventFiringTest extends TestCase
{
    /**
     * Achievement Unlocked Test Feature.
     *
     * @return void
     */
    public function test_achievement_can_be_unlocked()
    {
        Event::fake();

        // Assert that an event was dispatched...
        Event::assertDispatched(AchievementUnlocked::class);

        // Assert an event was not dispatched...
        Event::assertNotDispatched(AchievementUnlocked::class);

        // Assert that no events were dispatched...
        Event::assertNothingDispatched();
    }

    /**
     * Badge Unlocked Test Feature.
     *
     * @return void
     */
    public function test_badge_can_be_unlocked()
    {
        Event::fake();

        // Assert that an event was dispatched...
        Event::assertDispatched(BadgeUnlocked::class);

        // Assert an event was not dispatched...
        Event::assertNotDispatched(BadgeUnlocked::class);

        // Assert that no events were dispatched...
        Event::assertNothingDispatched();
    }

    /**
     * Comment Written Test Feature.
     *
     * @return void
     */
    public function test_comment_is_written()
    {
        Event::fake();

        // Assert that an event was dispatched...
        Event::assertDispatched(CommentWritten::class);

        // Assert an event was not dispatched...
        Event::assertNotDispatched(CommentWritten::class);

        // Assert that no events were dispatched...
        Event::assertNothingDispatched();
    }

    /**
     * Lesson Watched Test Feature.
     *
     * @return void
     */
    public function test_lesson_is_watched()
    {
        Event::fake();

        // Assert that an event was dispatched...
        Event::assertDispatched(LessonWatched::class);

        // Assert an event was not dispatched...
        Event::assertNotDispatched(LessonWatched::class);

        // Assert that no events were dispatched...
        Event::assertNothingDispatched();
    }
}
