<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Survey;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'engie:cron';

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
    public function handle1()
    {
        \Log::info("Start  qualtrics fine!");

          $client = new \GuzzleHttp\Client();

              $k=100;



              while($k <=20000) {
                      

              $url = 'http://eu.qualtrics.com/API/v3/distributions?distributionRequestType=SFTrigger&surveyId=SV_9S0JkHvfd2MDOfz&offset='.$k;

              $request = $client->request('GET', $url, [
                  'headers' => ['X-Api-Token' => 'Uhe6FBsILOlOOQDiwQALkmrpcm731OpvSvvhyO2i','Content-Type' => 'application/json'],
                  'verify' => false,
              ]);

              $response = $request->getBody()->getContents();

              $array = json_decode($response, true);

              $final =  $array['result']['elements'];


              $AllFinal = [];

              $AllFinal += $final;
              $mouhssine = count($AllFinal);



              var_dump($mouhssine);
              echo '<pre>';
              echo '----';

            echo '</pre>';

            $countArray  = count($AllFinal);

                         for ($i=0; $i < $countArray ; $i++) {

                          $FormatsendDate  = $AllFinal[$i]['sendDate'];
                          $sendDate = substr($FormatsendDate, 0, -10);
                          $response_id = $AllFinal[$i]['id'];
                          $stats = $AllFinal[$i]['stats'];
                          $contactId = $final[$i]['recipients']['contactId'];

                           $state_tojson = json_encode($stats);

                          // verifier le champs id  dans la base de donnée
                           $CheckSurvey = Survey::where('response_id', '=', $response_id)->get();

                           if(!count($CheckSurvey) > 0)
                          {
                              $survey = new Survey();
                              $survey->sendDate = $sendDate;
                              $survey->response_id = $response_id;
                              $survey->stats = $state_tojson;
                              $survey->contactId = $contactId;
                              $survey->save();
                          }
                          else{

                          }

                         }
                         $k+=100;

              }



        \Log::info("Cron is qualtrics fine !");
        $this->info('Demo:Cron Cummand Run successfully!');
    }

    public function handle()
    {
        \Log::info("Start  qualtrics fine!");

            $client = new \GuzzleHttp\Client();

                        $j =0;
                        $nextPage = [];

                            $url = 'http://eu.qualtrics.com/API/v3/distributions?distributionRequestType=SFTrigger&surveyId=SV_9S0JkHvfd2MDOfz';

                            $request = $client->request('GET', $url, [
                                'headers' => ['X-Api-Token' => 'Uhe6FBsILOlOOQDiwQALkmrpcm731OpvSvvhyO2i','Content-Type' => 'application/json'],
                                'verify' => false,
                            ]);

                            $response = $request->getBody()->getContents();

                            $array = json_decode($response, true);

                            $final =  $array['result']['elements'];

                            $nextPage =  $array['result']['nextPage'];

                            $nextPage  = explode( 'offset=', $nextPage ) ;


                            var_dump($nextPage);

                               $Finalcount  = count($final);


                               \Log::info('table'.$Finalcount);

                               for ($i=0; $i < $Finalcount ; $i++) {


                            $FormatsendDate  = $final[$i]['sendDate'];
                            $sendDate = substr($FormatsendDate, 0, -10);
                            $response_id = $final[$i]['id'];
                            $stats = $final[$i]['stats'];
                            $contactId = $final[$i]['recipients']['contactId'];
                            $surveyId = $final[$i]['surveyLink']['surveyId'];

                           $state_tojson = json_encode($stats);

                          // verifier le champs id  dans la base de donnée
                           $CheckSurvey = Survey::where('response_id', '=', $response_id)->get();

                           if(!count($CheckSurvey) > 0)
                          {
                              $survey = new Survey();
                              $survey->sendDate = $sendDate;
                              $survey->response_id = $response_id;
                              $survey->stats = $state_tojson;
                              $survey->contactId = $contactId;
                              $survey->surveyId = $surveyId;
                              $survey->sent = $stats['sent'];
                              $survey->failed = $stats['failed'];
                              $survey->started = $stats['started'];
                              $survey->bounced = $stats['bounced'];
                              $survey->opened = $stats['opened'];
                              $survey->skipped = $stats['skipped'];
                              $survey->finished = $stats['finished'];
                              $survey->complaints = $stats['complaints'];
                              $survey->blocked = $stats['blocked'];
                              $survey->save();
                          }
                          else{

                          }

                               }





                        while ($nextPage > 0) {

                            $url = 'http://eu.qualtrics.com/API/v3/distributions?distributionRequestType=SFTrigger&surveyId=SV_9S0JkHvfd2MDOfz&offset='.$nextPage[1];

                            $request = $client->request('GET', $url, [
                                'headers' => ['X-Api-Token' => 'Uhe6FBsILOlOOQDiwQALkmrpcm731OpvSvvhyO2i','Content-Type' => 'application/json'],
                                'verify' => false,
                            ]);

                            $response = $request->getBody()->getContents();

                            $array = json_decode($response, true);

                            $final =  $array['result']['elements'];
                            $nextPage =  $array['result']['nextPage'];

                            $nextPage  = explode( 'offset=', $nextPage ) ;

                            var_dump($nextPage[1]);

                               $Finalcount  = count($final);
                               \Log::info('table'.$Finalcount);
                               for ($i=0; $i < $Finalcount ; $i++) {

                                $FormatsendDate  = $final[$i]['sendDate'];
                            $sendDate = substr($FormatsendDate, 0, -10);
                            $response_id = $final[$i]['id'];
                            $stats = $final[$i]['stats'];
                            $contactId = $final[$i]['recipients']['contactId'];
                            $surveyId = $final[$i]['surveyLink']['surveyId'];

                            $CheckSurvey = Survey::where('response_id', '=', $response_id)->get();


                           if(!count($CheckSurvey) > 0)
                           {
                               $survey = new Survey();
                               $survey->sendDate = $sendDate;
                               $survey->response_id = $response_id;
                               $survey->stats = $state_tojson;
                               $survey->contactId = $contactId;
                               $survey->surveyId = $surveyId;
                               $survey->sent = $stats['sent'];
                               $survey->failed = $stats['failed'];
                               $survey->started = $stats['started'];
                               $survey->bounced = $stats['bounced'];
                               $survey->opened = $stats['opened'];
                               $survey->skipped = $stats['skipped'];
                               $survey->finished = $stats['finished'];
                               $survey->complaints = $stats['complaints'];
                               $survey->blocked = $stats['blocked'];
                               $survey->save();



                           }
                           if($CheckSurvey == null)
                           {
                            echo 'Fin ...... ';
                           }

                               }


                        }



                     \Log::info("Cron is qualtrics fine !");
                     $this->info('Demo:Cron Cummand Run successfully!');

    }
}
