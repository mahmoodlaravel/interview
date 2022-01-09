<?php

namespace App\Console\Commands;

use App\Jobs\SendEmails;
use App\Models\interview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class RememberEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:remember';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email To alert an Interview';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        SendEmails::dispatch();
    }
}
