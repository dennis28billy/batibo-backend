<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uid', 'user_id', 'address_id',  'total', 'ongkosKirim', 'status', 'payment_url', 'isOrder', 'nama_penerima', 'nomor_handphone', 'email', 'alamat_penerima', 'latitude', 'longitude'
    ];

    public function order(){
        return $this->hasMany(Order::class, 'transaction_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function address(){
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
    
    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }


}
