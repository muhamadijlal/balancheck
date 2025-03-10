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

        $clusters = $query->groupBy('cluster')->where('aktiv', 1)->get();

        return $clusters;
    }

    public function selectRuas(Request $request)
    {
        $query = DB::table("tbl_gerbang")
                    ->select("cb as value","cabang as label")
                    ->where("cluster",$request->clusterId)
                    ->groupBy("cb");

        if($request['query']) {
            $query->where('cabang', 'like', '%'.$request['query'].'%');
        }

        $ruas = $query->groupBy("cb")->where('aktiv', 1)->get();

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

        $gerbang = $query->groupBy("gb","nama")->where('aktiv', 1)->get();

        return $gerbang;
    }
}
