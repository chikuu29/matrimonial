<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class updateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateUser:insert';

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
    public function handle()
    {
        // //
        //      $curl = curl_init();

        //     curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://portal.csm.co.in/ex-employee-information',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS =>' {
        //         "jsonrpc": 2.0,
        //         "params": {
        //             "from_date": "2022-09-18",
        //             "to_date":   "2023-01-10"
        //         }
        //     }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json',
        //         'Cookie: session_id=174c5cf0cab5770f1af69b4a1ab3b47ae7005d5a'
        //     ),
        //     ));

        //     $response = curl_exec($curl);

        //     curl_close($curl);
        //     echo $response;
            
            //file_put_contents("./test.txt",$response);


    }
}
