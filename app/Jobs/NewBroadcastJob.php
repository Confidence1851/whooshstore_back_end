<?php

namespace App\Jobs;

use App\Models\Broadcast;
use App\Notifications\NewBroadcastNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class NewBroadcastJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $model;
    private $broadcast;
    private $recipients;
    public function __construct(Broadcast $broadcast, Model $model , array $recipients)
    {
        $this->model = $model;
        $this->broadcast = $broadcast;
        $this->recipients = $recipients;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subject = $this->broadcast['subject'];
        $body = $this->broadcast['body'];
        $recipients = $this->model->whereIn("id", $this->recipients)->pluck("name" , "email")->toArray();
        foreach ($recipients as $email => $name) {
            $data['email'] = $email;
            $data['subject'] = str_replace('{{name}}', $name, $subject);
            $data['message'] = str_replace('{{name}}', $name, $body);
            $params['data']           = $data; //optional
            $params['to']             = $data["email"]; //required
            $params['template_type']  = 'markdown';  //default is view
            $params['subject']        = $data["subject"]; 
            sendMailHelper($params);
            // Notification::route("mail", $data['email'])->notify(new NewBroadcastNotification($data));
        }

    }
}
