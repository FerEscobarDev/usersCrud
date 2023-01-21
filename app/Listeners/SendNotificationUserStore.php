<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\UserStore;
use App\Mail\ReportAdmin;
use App\Mail\UserRegister;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationUserStore
{
    
    
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserStore  $event
     * @return void
     */
    public function handle(UserStore $event)
    {
        Mail::to($event->user->email)->send(new UserRegister($event->user));
        $report = DB::table('users')
                 ->select('country', DB::raw('count(*) as total'))
                 ->groupBy('country')
                 ->get();

        Mail::to('admins@reporte.com')->send(new ReportAdmin($report));
    }
}
