<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\reminderController;
class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'HourlyUpdate:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle(reminderController $reminder)
    {
        
        $reminder->startExecution();
        $user = DB::table('m_dyn_message_configuration')->get();
        foreach ($user as $a)
        {
    Mail::raw("This is automatically generated and Updated each minute", function($message) use ($a)
    {
        $message->from('xyz.gt@gmail.com');
        $message->to($a->email)->subject('everyMinute Update');
    });
    }
    $this->info(' successfully Updated in everyMinute');
 
    }
}
