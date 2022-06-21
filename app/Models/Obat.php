<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Obat extends Authenticatable
{
    protected $table = 'pesanan_m';   

    public function PesananObat($id, $status)
    {
        $resep =  $this->join('resep_m as r','pesanan_m.id','r.pemesanan_id')
                ->where('pesanan_m.is_resep',$status)
                ->where('r.pemesanan_id', $id);
                    
            return $resep;
    }
}