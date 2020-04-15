<?php

namespace App\Observers;

use App\FriendRequest;
use App\LogUserAction;

class UserActionObserver
{
    private $action = ['Req sent','Req accepted','Req declined','blocked'];
    /**
     * Handle the friend request "created" event.
     *
     * @param  \App\FriendRequest  $friendRequest
     * @return void
     */
    public function created(FriendRequest $friendRequest)
    {
        $log = [
            'created_by' => $friendRequest->action_by,
            'created_for' => $friendRequest->user_two_id,
            'action' => $this->action[$friendRequest->status]
        ];
        LogUserAction::create($log);
    }

    /**
     * Handle the friend request "updated" event.
     *
     * @param  \App\FriendRequest  $friendRequest
     * @return void
     */
    public function updated(FriendRequest $friendRequest)
    {
        $log = [
            'created_by' => $friendRequest->action_by,
            'created_for' => $friendRequest->user_two_id,
            'action' => $this->action[$friendRequest->status]
        ];
        LogUserAction::create($log);
    }

    /**
     * Handle the friend request "deleted" event.
     *
     * @param  \App\FriendRequest  $friendRequest
     * @return void
     */
    public function deleted(FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Handle the friend request "restored" event.
     *
     * @param  \App\FriendRequest  $friendRequest
     * @return void
     */
    public function restored(FriendRequest $friendRequest)
    {
        //
    }

    /**
     * Handle the friend request "force deleted" event.
     *
     * @param  \App\FriendRequest  $friendRequest
     * @return void
     */
    public function forceDeleted(FriendRequest $friendRequest)
    {
        //
    }
}
