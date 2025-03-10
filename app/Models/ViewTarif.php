<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewTarif extends Model
{
    protected $table = 'view_tarif';

    public function scopeGroupByCluster($query)
    {
        return $query->select('cluster')
                     ->groupBy('cluster');
    }

    public function scopeGroupByRuas($query)
    {
        return $query->select('cabang')
                     ->groupBy('cabang');
    }

    public function scopeGroupByGerbang($query)
    {
        return $query->select('nama_gb')
                     ->groupBy('nama_gb');
    }
   
    public function scopeGroupByAsalGerbang($query)
    {
        return $query->select('nama_asal_gb')
                     ->groupBy('nama_asal_gb');
    }
}