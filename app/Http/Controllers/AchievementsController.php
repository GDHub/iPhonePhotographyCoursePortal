<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        //Validate User supplied is not empty and valid
        if(isset($user->name))
        {
            global $currentCommentAchievement, $currentWatchedAchievement, $currentBadge, $nextCommentAchievement, $nextWatchedAchievement, $nextBadge, $remainingAchievement;
        
            //Fetch the Last Comment Achievement from Log Table
            $fetchCommentAchievement = DB::table('achievementlog')->where([['achievement', 'like', '%Comments Written'], ['user_id', '=', $user->id],])->orderByDesc('id')->first();
            $fetchWatchedAchievement = DB::table('achievementlog')->where([['achievement', 'like', '%Lesson'], ['user_id', '=', $user->id],])->orderByDesc('id')->first();
            $achievementCount = DB::table('achievementlog')->where('user_id', $user->id)->count();
            $fetchBadge = DB::table('badgelog')->where('user_id', $user->id)->orderByDesc('id')->first();

            $commentAchievement = ['First Comment Written' => 1, '3 Comments Written' => 3, '5 Comments Written' => 5, '10 Comments Written' => 10, '20 Comments Written' => 20];
            $lessonWatchedAchievement = ['First Lesson Watched' => 1, '5 Lessons Watched' => 5, '10 Lessons Watched' => 10, '25 Lessons Watched' => 25, '50 Lessons Watched' => 50];
            $badges = ['Beginner', 'Intermediate', 'Advanced', 'Master'];

            if(isset($fetchCommentAchievement))
            {
                $currentCommentAchievement = $fetchCommentAchievement->achievement;

                $currentindex = array_search($currentCommentAchievement, array_keys($commentAchievement));
                $nextCommentAchievement = array_keys($commentAchievement)[$currentindex + 1];
            }
            else
            {
                $currentCommentAchievement = '';
                $nextCommentAchievement = 'First Comment Written';
            }

            if(isset($fetchWatchedAchievement))
            {
                $currentWatchedAchievement = $fetchWatchedAchievement->achievement;

                $currentindex = array_search($currentWatchedAchievement, array_keys($lessonWatchedAchievement));
                $nextCommentAchievement = array_keys($lessonWatchedAchievement)[$currentindex + 1];
            }
            else
            {
                $currentWatchedAchievement = '';
                $nextWatchedAchievement = 'First Lesson Watched';
            }

            if(isset($fetchBadge))
            {
                $currentBadge = $fetchBadge->badge;

                if($currentBadge == 'Master')
                    $nextBadge = '';
                else
                {
                    $currentindex = array_search($currentBadge, $badges);
                    $nextBadge = $badges[$currentindex + 1];
                }
            }
            else
            {
                $currentBadge = 'Beginner';
                $nextBadge = 'Intermediate';
            }

            if(isset($achievementCount))
            {
                if($achievementCount < 4 && $achievementCount > 0)
                {
                    $remainingAchievement = 4 - $achievementCount;
                }
                elseif($achievementCount < 8 && $achievementCount > 4)
                {
                    $remainingAchievement = 8 - $achievementCount;
                }
                elseif($achievementCount < 10 && $achievementCount > 8)
                {
                    $remainingAchievement = 10 - $achievementCount;
                }
                else
                {
                    $remainingAchievement = 0;
                }
            }
            else
            {
                $remainingAchievement = 4;
            }

            return response()->json([
                'unlocked_achievements' => [$currentCommentAchievement, $currentWatchedAchievement],
                'next_available_achievements' => [$nextCommentAchievement, $nextWatchedAchievement],
                'current_badge' => $currentBadge,
                'next_badge' => $nextBadge,
                'remaing_to_unlock_next_badge' => $remainingAchievement
            ]);
        }
        else
        {
            return response()->json([
                'unlocked_achievements' => [],
                'next_available_achievements' => [],
                'current_badge' => '',
                'next_badge' => '',
                'remaing_to_unlock_next_badge' => 0 
            ]);
        }
        
    }
}
