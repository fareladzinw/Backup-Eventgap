<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    use HasFactory;

    public function tikets()
    {
        return $this->hasMany('App\Models\Tiket','tiketId');
    }
}
