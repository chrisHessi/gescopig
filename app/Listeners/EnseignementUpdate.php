<?php

namespace App\Listeners;

use App\Events\EnseignementUpdate as EventEnseignementUpdate;
use App\Models\Ingoing;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnseignementUpdate
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
     * @param  EnseignementUpdate  $event
     * @return void
     */
    public function handle(EventEnseignementUpdate $event)
    {
        $enseignement = $event->model;
        if($enseignement->mhEff >= ($enseignement->mhTotal/2)){
            if(!$enseignement->communication || !$enseignement->cc) {
                if(!$enseignement->has('ingoing'))
                    $enseignement->ingoing()->save(new Ingoing);
                elseif($enseignement->ingoing != null){
                        $enseignement->ingoing->update(['updated_at' => Carbon::now()]);
                    }
            }
        }

        if(!$enseignement->progression){
            if(!$enseignement->has('ingoing'))
                $enseignement->ingoing()->save(new Ingoing);
            elseif($enseignement->ingoing != null)
                $enseignement->ingoing->update(['updated_at' => Carbon::now()]);
        }
    }
}
