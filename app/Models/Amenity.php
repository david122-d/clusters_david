<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'amenities';

    protected $fillable = ['name', 'type','status', 'cluster_id'];

    public function cluster (){
        return $this->belongsTo(Cluster:: class);
    }
    //Relacion muchos a uno con los clusters


}
