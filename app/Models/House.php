<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    
    protected $table = 'houses';

    protected $fillable = ['number', 'owner_name', 'maintenance', 'cluster_id'];

    public function cluster (){
        return $this->belongsTo(Cluster:: class);
    }
    //Declarar relacion uno a muchos con los clusters

}
