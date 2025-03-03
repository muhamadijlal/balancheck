<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Controller extends Controller
{
    public function selectCluster(Request $request)
    {
        $query = DB::table("tbl_gerbang")
                    ->select("cluster as value", "cluster as label");

        if($request['query']) {
            $query->where('cluster', 'like', '%'.$request['query'].'%');
        }

        $clusters = $query->groupBy('cluster')->get();

        return $clusters;
    }

    public function selectRuas(Request $request)
    {
        $query = DB::table("tbl_gerbang")
                    ->select("cb as value","cb as label")
                    ->where("cluster",$request->clusterId)
                    ->groupBy("cb");

        if($request['query']) {
            $query->where('cb', 'like', '%'.$request['query'].'%');
        }

        $ruas = $query->groupBy("cb")->get();

        return $ruas;
    }
    
    public function selectGerbang(Request $request)
    {
        $query = DB::table("tbl_gerbang")
                    ->select("gb as value","nama as label")
                    ->where("cluster",$request->clusterId)
                    ->where("cb",$request->ruasId);

        if($request['query']) {
            $query->where('nama', 'like', '%'.$request['query'].'%');
        }

        $gerbang = $query->groupBy("gb","nama")->get();

        return $gerbang;
    }
}
