<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ContactData;
use App\Contacts;

class DataContact extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'engie:data';

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
        $datas = Contacts::all();


    foreach ($datas as  $key => $data) {


            if($data->check_contact_id == 0){


                    \Log::info("Start  qualtrics fine!");
                     $client = new \GuzzleHttp\Client();

                            $url = 'http://eu.qualtrics.com/API/v3/directories/POOL_esoWeAjbR3o8tUh/mailinglists/CG_b9s41iQWuu0okLP/contacts/'.$data->contactId;

                            $request = $client->request('GET', $url, [
                            'headers' => ['X-Api-Token' => 'Uhe6FBsILOlOOQDiwQALkmrpcm731OpvSvvhyO2i','Content-Type' => 'application/json'],
                            'verify' => false,
                            ]);

                        $response = $request->getBody()->getContents();

                        $array = json_decode($response, true);
                        $final =  $array['result'];
                        $final2 =  $array['result']['embeddedData'];
                        $Finalcount  = count($final);
                        \Log::info('table'.$Finalcount);


                        $contactId = $final['contactId'];
                        $email = $final['email'];
                        $contactLookupId = $final['contactLookupId'];
                        $firstName = $final['firstName'];
                        $lastName = $final['lastName'];
                        $civilite__c = $final['embeddedData']['civilite__c'];

                        if (isset($final['stats']['LastInviteDate']) ){
                            $LastInviteDate = $final['stats']['LastInviteDate'];
                        }else{
                            $LastInviteDate = null;
                        }
                        if (isset($final['stats']['LastEmailDate']) ){
                            $LastEmailDate = $final['stats']['LastEmailDate'];
                        }else{
                            $LastEmailDate = null;
                        }
                        if (isset($final['embeddedData']['commune_pdl__c']) ){
                            $commune_pdl__c = $final['embeddedData']['commune_pdl__c'];
                        }else{
                            $commune_pdl__c = 0;
                        }
                        if (isset($final['embeddedData']['date_fermeture_demande__c']) ){
                            $date_fermeture_demande__c = $final['embeddedData']['date_fermeture_demande__c'];
                        }else{
                            $date_fermeture_demande__c = null;
                        }
                        if (isset($final['embeddedData']['date_reception_demande__c']) ){
                            $date_reception_demande__c = $final['embeddedData']['date_reception_demande__c'];
                        }else{
                            $date_reception_demande__c = null;
                        }
                        if (isset($final['embeddedData']['numero_demande__c']) ){
                            $numero_demande__c = $final['embeddedData']['numero_demande__c'];
                        }else{
                            $numero_demande__c = null;
                        }


                        if (isset($final['embeddedData']['raison_sociale__c']) ){
                            $raison_sociale = $final['embeddedData']['raison_sociale__c'];
                        }else{
                            $raison_sociale = 0;
                        }


                    //  dd($final['embeddedData']['raison_sociale__c']);
                        if (isset($final['embeddedData']['thematique_demande__c']) ){
                            $thematique_demande__c = $final['embeddedData']['thematique_demande__c'];
                        }else{
                            $thematique_demande__c = 0;
                        }
                        $type_enquete__c = $final['embeddedData']['type_enquete__c'];

                        // $check_phone = $final['embeddedData']['phone__c'];
                        // $check_mobile = $final['embeddedData']['mobile__c'];
                        $mobile__c= 0;
                        $phone__c = 0;


                        if (isset($final['embeddedData']['phone__c']) ){
                            $phone__c = $final['embeddedData']['phone__c'];
                        }
                        if (isset($final['embeddedData']['mobile__c']) ){
                            $mobile__c = $final['embeddedData']['mobile__c'];
                        }
                        if (isset($final['embeddedData']['commune_pdl__c']) ){
                            $commune_pdl__c = $final['embeddedData']['commune_pdl__c'];
                        }else{
                            $commune_pdl__c = 0;
                        }

                        $ContactData = new ContactData();

                            // verifier le champs id  dans la base de donnée
                        Contacts::where('contactId', '=', $contactId)->update(array('check_contact_id' => 1));


                        $ContactData->contactId = $contactId;
                        $ContactData->contactLookupId = $contactLookupId;
                        $ContactData->email = $email;
                        $ContactData->firstName = $firstName;
                        $ContactData->lastName = $lastName;
                        $ContactData->phone__c = $phone__c;
                        $ContactData->mobile__c = $mobile__c;
                        $ContactData->civilite__c = $civilite__c;
                        $ContactData->commune_pdl__c = $commune_pdl__c;
                        $ContactData->date_fermeture_demande__c = $date_fermeture_demande__c;
                        $ContactData->date_reception_demande__c = $date_reception_demande__c;
                        $ContactData->numero_demande__c = $numero_demande__c;
                        $ContactData->raison_sociale__c = $raison_sociale;
                        $ContactData->thematique_demande__c = $thematique_demande__c;
                        $ContactData->type_enquete__c = $type_enquete__c;
                        $ContactData->LastEmailDate = $LastEmailDate;
                        $ContactData->LastInviteDate = $LastInviteDate;



                        $ContactData->save();

                    }
                    else {
                        \Log::info("No data ");
                    }

                    $this->info('Demo:Cron Cummand '.$key.' successfully! | num ');
                }
            }
            }

