<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $table = 'clusters';

    protected $fillable = ['name'];

    public function users (){
        return $this->hasMany(User:: class);
    }
    //Relacion uno a muchos con guardias

    public function veicle_entrance (){
        return $this->hasMany(VeicleEntrance:: class);
    }
    //Relacion uno a muchos con las entradas de veiculos

    public function houses (){
        return $this->hasMany(House:: class);
    }
    //Relacion uno a muchos con las casas

    public function amenities (){
        return $this->hasMany(Amenity:: class);
    }
    //Relacion uno a muchos con las amenidades

    public function stand(){
        return $this->hasMany(Cluster::class);
    }
    //Relacion uno a muchos con las casetas
}
