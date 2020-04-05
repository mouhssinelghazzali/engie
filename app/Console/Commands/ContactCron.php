<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Contacts;

class ContactCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'engie:contact';

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
        \Log::info("Start  qualtrics fine!");

            $client = new \GuzzleHttp\Client();

                        $j =0;
                        $nextPage = [];

                            $url = 'http://eu.qualtrics.com/API/v3/directories/POOL_esoWeAjbR3o8tUh/mailinglists/CG_b9s41iQWuu0okLP/contacts';

                            $request = $client->request('GET', $url, [
                                'headers' => ['X-Api-Token' => 'Uhe6FBsILOlOOQDiwQALkmrpcm731OpvSvvhyO2i','Content-Type' => 'application/json'],
                                'verify' => false,
                            ]);

                            $response = $request->getBody()->getContents();

                            $array = json_decode($response, true);

                            $final =  $array['result']['elements'];
                            $nextPage =  $array['result']['nextPage'];

                            $nextPage  = explode( '?', $nextPage ) ;

                            var_dump($nextPage[1]);

                               $Finalcount  = count($final);
                               \Log::info('table'.$Finalcount);
                               for ($i=0; $i < $Finalcount ; $i++) {

                                $contactId = $final[$i]['contactId'];
                                $lastName = $final[$i]['lastName'];
                                $email = $final[$i]['email'];



                                 $contact = new Contacts();
                                // verifier le champs id  dans la base de donnée
                                $CheckcontactId = Contacts::where('contactId', '=', $contactId)->get();

                                if(!count($CheckcontactId) > 0)
                                {
                                    $contact->contactId = $contactId;
                                    $contact->lastName = $lastName;
                                    $contact->email = $email;
                                    $contact->save();
                                    \Log::info("Save Data".$i);
                                }else
                                {
                                    \Log::info("No data ");

                                }

                               }





                        while ($nextPage > 0) {

                            $url = 'http://eu.qualtrics.com/API/v3/directories/POOL_esoWeAjbR3o8tUh/mailinglists/CG_b9s41iQWuu0okLP/contacts?'.$nextPage[1];

                            $request = $client->request('GET', $url, [
                                'headers' => ['X-Api-Token' => 'Uhe6FBsILOlOOQDiwQALkmrpcm731OpvSvvhyO2i','Content-Type' => 'application/json'],
                                'verify' => false,
                            ]);

                            $response = $request->getBody()->getContents();

                            $array = json_decode($response, true);

                            $final =  $array['result']['elements'];
                            $nextPage =  $array['result']['nextPage'];

                            $nextPage  = explode( '?', $nextPage ) ;

                            var_dump($nextPage[1]);

                               $Finalcount  = count($final);
                               \Log::info('table'.$Finalcount);
                               for ($i=0; $i < $Finalcount ; $i++) {

                                $contactId = $final[$i]['contactId'];

                                $lastName = $final[$i]['lastName'];
                                $email = $final[$i]['email'];



                                 $contact = new Contacts();
                                // verifier le champs id  dans la base de donnée
                                $CheckcontactId = Contacts::where('contactId', '=', $contactId)->get();

                                if(!count($CheckcontactId) > 0)
                                {
                                    $contact->contactId = $contactId;
                                    $contact->lastName = $lastName;
                                    $contact->email = $email;
                                    $contact->save();
                                    \Log::info("Save Data".$i);
                                }else
                                {
                                    \Log::info("No data ");

                                }

                               }


                        }



                     \Log::info("Cron is qualtrics fine !");
                     $this->info('Demo:Cron Cummand Run successfully!');

    }
}
