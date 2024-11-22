<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $table = 'stands';

    protected $fillable = ['number', 'cluster_id'];

    public function cluster (){
        return $this->belongsTo(Cluster:: class);
    }
    //Declarar relacion muchos a uno con los clusters


    public function users (){
        return $this->hasMany(User:: class);
    }
    //Declarar relacion uno a muchos con los guardias

}
