<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class BadgeUnlocked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $badge_name, User $user)
    {
        try{
            $watchedCount = DB::table('lesson_user')->where('user_id', $user->id)->count();
            $commentCount = DB::table('comment')->where('user_id', $user->id)->count();

            DB::table('badgelog')->insert(['badge' => $badge_name, 'user_id' => $user->id, 'watched' => $watchedCount, 'written' => $commentCount, 'comment' => "You have earned the ${badge_name} Badge"]);
        }
        catch(Throwable $exp)
        {
            report($exp);
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
