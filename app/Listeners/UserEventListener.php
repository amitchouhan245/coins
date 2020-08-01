<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\General\VerifyController;
use App\Models\{ User };
use Mail;

class UserEventListener
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
     * @param  UserEvent  $event
     * @return void
     */
      public function handle(UserEvent $event)
    {        
        $user = $event->user;
       
        // Mobile Verification
        $check = $this->mobile($user->id);

        // Email Verification
        $this->email($user->id);

        // Create User settings 
        //$this->user_setting($user->id);

        Mail::to($user->email)->send(new NewUser($user));   
    
    }
}
