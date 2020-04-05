<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Survey;
use App\Http\Resources\SurveyResource;

class RegisterController extends BaseController
{
    public function index()
    {
        $survey = Survey::all();

        return $this->sendResponse(SurveyResource::collection($survey), 'Products retrieved successfully.');
    }
}
