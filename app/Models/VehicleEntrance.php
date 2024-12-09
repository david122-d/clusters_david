<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleEntrance extends Model
{
    use HasFactory;

    protected $table = 'vehicle_entrances';

    protected $fillable = ['plates', 'reason', 'check_in_time', 'check_out_time', 'cluster_id', 'stand_id','user_id'];

    public function cluster (){
        return $this->belongsTo(Cluster:: class);
    }
    //Declarar relacion muchos a uno con los clusters

    public function Stand (){
        return $this->belongsTo(Stand:: class);
    }
    //Declarar relacion muchos a uno con las casetas

    public function user (){
        return $this->belongsTo(User::class);
    }
    //Relacion uno a muchos inversa con guardias
}
