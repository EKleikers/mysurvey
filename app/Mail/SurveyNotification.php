<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SurveyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $tries = 1;

    protected $user;
    protected $survey;

       /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($user, $survey)

{
    $this->user = $user;
    $this->survey = $survey;
    
    
}
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        \Log::info('Build'.$this->user->name.' id '.$this->survey->id);
        return $this->subject(trans('surveys.subject'))
        ->view('emails.surveynotification')
        ->with([
            'user' => $this->user,
            'survey' => $this->survey,
         
        ]);
        
    }
}
