<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class storeCommentAchievement
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
        $commentWritten = $event->comment;
        $commentWriter = $commentWritten->user; //User who wrote the comment

        try{
            //Check if User has written any comment before now
            $commentCount = DB::table('comment')->where('user_id', $commentWriter->id)->count();
            $eventCount = DB::table('eventlog')->where('user_id', $commentWriter->id)->count();
            $achievementCount = DB::table('achievementlog')->where('user_id', $commentWriter->id)->count();
            
            if(!isset($commentCount) or $commentCount == 1)
            {
                //First Comment Written Achievement Earned (AchievementUnlocked)
                AchievementUnlocked::dispatch('First Comment Written', $commentWriter);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'COMMENTWRITTEN', 'comment' => 'First Comment Written', 'user_id' => $commentWriter->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $commentWriter);
            }
            elseif($commentCount == 3)
            {
                //3 Comments Written
                AchievementUnlocked::dispatch('3 Comments Written', $commentWriter);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'COMMENTWRITTEN', 'comment' => '3 Comments Written', 'user_id' => $commentWriter->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $commentWriter);
            }
            elseif($commentCount == 5)
            {
                //5 Comments Written
                AchievementUnlocked::dispatch('5 Comments Written', $commentWriter);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'COMMENTWRITTEN', 'comment' => '5 Comments Written', 'user_id' => $commentWriter->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $commentWriter);
            }
            elseif($commentCount == 10)
            {
                //10 Comments Written
                AchievementUnlocked::dispatch('10 Comments Written', $commentWriter);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'COMMENTWRITTEN', 'comment' => '10 Comments Written', 'user_id' => $commentWriter->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $commentWriter);
            }
            elseif($commentCount == 20)
            {
                //20 Comments Written
                AchievementUnlocked::dispatch('20 Comments Written', $commentWriter);

                //Log Event
                DB::table('eventlog')->insert(['eventtype' => 'COMMENTWRITTEN', 'comment' => '20 Comments Written', 'user_id' => $commentWriter->id]);

                //Badge Unlocked Event Check
                isBadgeUnlocked($achievementCount + 1, $commentWriter);
            }
            elseif(isset($commentCount))
            {
                //Log Event
                $logComment = "${commentCount} Comments Written";
                DB::table('eventlog')->insert(['eventtype' => 'COMMENTWRITTEN', 'comment' => $logComment, 'user_id' => $commentWriter->id]);
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
