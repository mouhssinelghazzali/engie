<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;
use Datatables;
use Redirect,Response,DB,Config;

use App\Api;
use App\Survey;

class DatatablesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function categoryData()
    {
        $surveys = DB::table('api')->select('*');
        return datatables()->of($surveys)
            ->make(true);

       // return Datatables::queryBuilder(DB::table(''))->make(true);

    }
}
