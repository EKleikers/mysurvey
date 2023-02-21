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
 
class HourlyJob extends Job implements ShouldQueue {
 
    use InteractsWithQueue,
        SerializesModels;
    
    public $tries = 1;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        // $client = \DB::table('appsforce_client')->first();
 
        // \Config::set('mail.driver', $client->maildriver);
        // \Config::set('mail.host', $client->smtpserver);
        // \Config::set('mail.port', $client->smtpserverport);
        // \Config::set('mail.from.address', $client->from_address);
        // \Config::set('mail.from.name', $client->from_name);
        // \Config::set('mail.encryption', $client->encryption);
        // \Config::set('mail.username', $client->username);
        // try {
        //     \Config::set('mail.password', customDecrypt($client->password));
        // } catch (\Exception $e) {
        //     \Config::set('mail.password', $client->password);
        // }
        // (new \Illuminate\Mail\MailServiceProvider(app()))->register();
    }
 
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        //\Log::info('No HOURLY job for mysurvey');
    }
 
}