<?php
 
namespace App\Jobs;
 
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Apps;
use Mail;
use App\Http\Models\SurveyResult;
use App\Http\Models\Survey;
 
class DailyJob extends Job implements ShouldQueue {
 
    use InteractsWithQueue,
        SerializesModels;
    
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {

        $client = \DB::table('appsforce_client')->first();
 
        \Config::set('mail.driver', $client->maildriver);
        \Config::set('mail.host', $client->smtpserver);
        \Config::set('mail.port', $client->smtpserverport);
        \Config::set('mail.from.address', $client->from_address);
        \Config::set('mail.from.name', $client->from_name);
        \Config::set('mail.encryption', $client->encryption);
        \Config::set('mail.username', $client->username);
        try {
            \Config::set('mail.password', customDecrypt($client->password));
        } catch (\Exception $e) {
            \Config::set('mail.password', $client->password);
        }
        \Config::set('mail.stream', [
            'ssl' => [
                'allow_self_signed' => true,
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
            ]);
       //   \Log::info($client->username);
        (new \Illuminate\Mail\MailServiceProvider(app()))->register();
    } 
 
    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle() {
    
        \Log::info('TRIGGER DAILY job');
        $users = \App\User::where('role','mkb')->get();
        $surveys = \App\Http\Models\Survey::all();
    
            foreach ($users as $user) { 
                \Log::info('User: '.$user->name);
            foreach ($surveys as $survey) {
                if($survey->no_email == 1){
                    \Log::info('daily job - no_email: '.$survey->id);
                    // Do nothing > no_mail checled
                }else{
                    $date = new \DateTime($survey->published_at);
                    $survey_results = \App\Http\Models\SurveyResult:: where ('survey_id',$survey->id) -> where ('user_id',$user->id)-> first();
                //publishing_date is today
                    if ($survey_results == NULL && $date == (new  \DateTime('today'))) { 
                        \Log::info('SurveyPublished today-id:  '.$survey->id );

                        Mail::to($user->email)->locale(app()->getLocale())->queue(new \App\Mail\SurveyNotification($user,$survey));
                        //Mail::to('ek@appsforce.org')->locale(app()->getLocale())->queue(new \App\Mail\SurveyNotification($user,$survey));
                    } 
                //publishing_date is 7 days ago
                        $date7 = $date->modify('+7 day');
                    if ($survey_results == NULL && $date7 == new  \DateTime('today')) { 
                        \Log::info('SurveyPublished 7 days ago-id:  '.$survey->id );

                        Mail::to($user->email)->locale(app()->getLocale())->queue(new \App\Mail\SurveyNotificationReminder($user,$survey));
                        //Mail::to('ek@appsforce.org')->locale(app()->getLocale())->queue(new \App\Mail\SurveyNotification($user,$survey));
                    }   
        
                //publishing_date is 14 days ago 
                        $date14 = $date7->modify('+7 day');
                    if ($survey_results == NULL && $date14 == new  \DateTime('today')) { 
                        \Log::info('SurveyPublished 14 days ago-id:  '.$survey->id );

                        Mail::to($user->email)->locale(app()->getLocale())->queue(new \App\Mail\FinalReminder($user,$survey));
                        //Mail::to('ek@appsforce.org')->locale(app()->getLocale())->queue(new \App\Mail\SurveyNotification($user,$survey));
                    } 
                }
            }
        }
    }  
}