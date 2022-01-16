<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            
            if(!isset($commentCount) or $commentCount == 0)
            {
                //First Comment Written Achievement Earned (AchievementUnlocked)

                //Badge Unlocked Event Check
            }
            elseif($commentCount == 2)
            {
                //3 Comments Written

                //Badge Unlocked Event Check
            }
            elseif($commentCount == 4)
            {
                //5 Comments Written

                //Badge Unlocked Event Check
            }
            elseif($commentCount == 9)
            {
                //10 Comments Written

                //Badge Unlocked Event Check
            }
            elseif($commentCount == 19)
            {
                //20 Comments Written

                //Badge Unlocked Event Check
            }
            elseif($commentCount)
            {
                //Log Event
            }
        }
        catch(Throwable $exp)
        {
            report($exp);
        }
    }
}
