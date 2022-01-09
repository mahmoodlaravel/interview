<?php

namespace App\Jobs;

use App\Models\interview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $interviews = interview::notRemembered()->where('date','<=',Carbon::now()->addMinutes(30))->where('date','>',Carbon::now())->get();

        $users = User::all();
        foreach ($interviews as $interview)
        {

            foreach ($users as  $user)
            {
                Mail::raw("یادآوری مصاحبه عنوان:".$interview->title.'. توضیحات: '.$interview->description.' و قرار آن در زمان:'.$interview->date, function ($mail) use ($interview,$user) {
                    $mail->from('info@myWebsite.com');
                    $mail->to($user->email)
                        ->subject('یاد آوری مصاحبه!');
                });
            }
            $interview->update(['remembered'=>1]);

        }
    }
}
