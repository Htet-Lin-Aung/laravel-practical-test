<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SurveyCreated;
use App\Notifications\EmailSurvey;
use Illuminate\Support\Facades\Notification;

class SendSurveyNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SurveyCreated $event): void
    {
        $user = auth()->user();
        $details = [
            'greeting' => 'Dear '.$user->name.',',
            'body' => 'This is survey for '.$event->survey->form->name,
            'thanks' => 'Thank you for your answer!',
            'actionText' => 'Visit Our Site',
            'actionURL' => url('https://google.com'),
        ];

        Notification::send($user, new EmailSurvey($details));
    }
}
