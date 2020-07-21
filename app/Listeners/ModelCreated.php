<?php

namespace App\Listeners;

use App\Events\ModelCreated as EventModelCreated;
use App\Models\Ingoing;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Laracasts\Flash\Flash;

class ModelCreated
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
     * @param  ModelCreated  $event
     * @return void
     */
    public function handle(EventModelCreated $event)
    {
        $contrat = $event->model->contrat;
        if($contrat->absences->where('justify',0)->count() >= 2){
            if(!$contrat->ingoing)
                $contrat->ingoing()->save(new Ingoing);
            else
                $contrat->ingoing->update(['updated_at' => Carbon::now()]);
        }
    }
}
