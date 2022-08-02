<?php

namespace App\Listeners;

use App\Events\MyCaseStatusChangedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MyCaseStatusChangedListener
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
     * @param  \App\Events\MyCaseStatusChangedEvent  $event
     * @return void
     */
    public function handle(MyCaseStatusChangedEvent $event)
    {
        if ((bool) $event->myCase->status->status_linking) {
            $complaints = $event->myCase->complaints;
            foreach ($complaints as $complaint) {
                $complaint->status_id = $event->myCase->status->complaint_status_id;
                $complaint->save();
            }
        }
    }
}
