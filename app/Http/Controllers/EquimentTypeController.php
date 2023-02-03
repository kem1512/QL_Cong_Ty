<?php

namespace App\Http\Controllers;

use App\Models\equiment;
use App\Models\Equiment_Type;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;

class EquimentTypeController extends Controller
{
    public function Index()
    {
        return view('pages.Equiments.Equiment_Type.Index');
    }

    public function Get_Equiment_Type($totalPage = null, $Page = null)
    {
        $list = DB::table('equiment_types')->get();
        $paginate = new Paginator($list, $totalPage, $Page);
        return $paginate;
    }
}