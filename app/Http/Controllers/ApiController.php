<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use Carbon\Carbon;
use DB;
use App\Api;
use App\Contacts;
use App\ContactData;
use App\Exports\SurveysExport;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{

    public function export()
    {
        return Excel::download(new SurveysExport, 'SurveysExport.xlsx');
    }
    public function index()
    {

    // $survey = DB::table('surveys')->distinct()->get();

    // $survey = Api::all();

    //    $apis = DB::table('apis')
    //                  ->select('id')
    //                  ->paginate(10);

    $survey =  DB::table('api')
    ->select('*')
    ->paginate(10);

 return view('welcome',compact('survey'));


    }

    public function index2()
    {

       // $survey = DB::table('')->distinct()->get();

     //$survey = Api::all();

    //    $apis = DB::table('apis')
    //                  ->select('id')
    //                  ->paginate(10);

    $survey =  DB::table('surveys')
    ->select('surveys.contactId','users.id','contact_data.email')
    ->join('contact_data','contact_data.contactLookupId','=','surveys.contactId')
    ->paginate(10);
        // return view('welcome',compact('survey'));
       // dd('ssss');

       $survey = ContactData::find(1)->survey;
       dd($survey);
    }



public function getData(Request $request)
{
$client = new \GuzzleHttp\Client();


global $offset ;


$arraySurveyId  = array('SV_dgRvTv9etk2tYwJ','SV_37pd3qDU44DMeBT','SV_8rguWQaistQvxzL','SV_cTQ1nBOqwKT6zIx','SV_9S0JkHvfd2MDOfz');
$count = count($arraySurveyId);




    for ($k=14000; $k <= 20000; $k+=100) {

    $url = 'http://eu.qualtrics.com/API/v3/distributions?distributionRequestType=SFTrigger&surveyId='.$arraySurveyId[4].'&offset='.$k;

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

    }



    }
}
