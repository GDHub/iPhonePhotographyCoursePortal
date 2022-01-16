<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Database\DatabaseManager;

class storeLessonWatchedAchievement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $lessonWatched = $event->lesson;
        $lessonWatcher = $event->user; //User who watched lesson

        try{
            //Check if User has written any comment before now
            $watchedCount = DB::table('lesson_user')->where('user_id', $lessonWatcher->id)->count();
            $eventCount = DB::table('eventlog')->where('user_id', $lessonWatcher->id)->count();
            $achievementCount = DB::table('achievementlog')->where('user_id', $lessonWatcher->id)->count();
            
            if(isset($watchedCount) && $watchedCount == 1)
            {
                //First Lesson Watched Achievement Earned (AchievementUnlocked)
                AchievementUnlocked::dispatch('First Lesson Watched', $lessonWatcher);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'LESSONWATCHED', 'comment' => 'First Lesson Watched', 'user_id' => $lessonWatcher->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $lessonWatcher);
            }
            elseif($watchedCount == 5)
            {
                //5 Lessons Watched
                AchievementUnlocked::dispatch('5 Lessons Watched', $lessonWatcher);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'LESSONWATCHED', 'comment' => '5 Lessons Watched', 'user_id' => $lessonWatcher->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $lessonWatcher);
            }
            elseif($watchedCount == 10)
            {
                //10 Lessons Watched
                AchievementUnlocked::dispatch('10 Lessons Watched', $lessonWatcher);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'LESSONWATCHED', 'comment' => '10 Lessons Watched', 'user_id' => $lessonWatcher->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $lessonWatcher);
            }
            elseif($watchedCount == 25)
            {
                //25 Lessons Watched
                AchievementUnlocked::dispatch('25 Lessons Watched', $lessonWatcher);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'LESSONWATCHED', 'comment' => '25 Lessons Watched', 'user_id' => $lessonWatcher->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $lessonWatcher);
            }
            elseif($watchedCount == 50)
            {
                //50 Lessons Watched
                AchievementUnlocked::dispatch('50 Lessons Watched', $lessonWatcher);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'LESSONWATCHED', 'comment' => '50 Lessons Watched', 'user_id' => $lessonWatcher->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $lessonWatcher);
            }
            elseif(isset($watchedCount) && $watchedCount > 1)
            {
                //Log Event
                $logComment = "${watchedCount} Lessons Watched";
                DB::table('eventlog')->insert(['eventtype' => 'LESSONWATCHED', 'comment' => $logComment, 'user_id' => $lessonWatcher->id]);
            }
        }
        catch(Throwable $exp)
        {
            report($exp);
        }
    }

    private function isBadgeUnlocked($noOfAchievement, $user)
    {
        $currentAchievement = DB::table('achievementlog')->where('user_id', $user->id);

        if(isset($currentAchievement))
        {
            if($noOfAchievement == 4)
            {
                //Intermediate Badge Unlocked
                BadgeUnlocked::dispatch('Intermediate', $commentWriter);
            }
            elseif($noOfAchievement == 8)
            {
                //Advanced Badge Unlocked
                BadgeUnlocked::dispatch('Advanced', $commentWriter);
            }
            elseif($noOfAchievement == 10)
            {
                //Master Badge Unlocked
                BadgeUnlocked::dispatch('Master', $commentWriter);
            }
        }
        else
        {
            //Beginner Badge Unlocked
            BadgeUnlocked::dispatch('Beginner', $commentWriter);
        }
    }
}
