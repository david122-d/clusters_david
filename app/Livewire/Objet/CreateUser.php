<?php

namespace App\Livewire\Objet;

use App\Models\Cluster;
use App\Models\User;
use Livewire\Component;

class CreateUser extends Component
{
    public $name;
    public $last_name;
    public $turn;
    public $action;
    public $email;
    public $cluster_id='';
    public $stand_id='';

    public $isEditable;
    public $clusters;
    public $stands;
    public $buscar='';

    //Obtiene los valores de la tabla vehicle_entrancee 
    public function mount(){
        $this->clusters = Cluster::all();
    }

    //Esta funcion Devuelve la vista de create user
    public function render()
    {
        //$this->users = User::all();
        //return view('livewire.objet.create-user');

        $users = User::where('name', 'like', '%' . $this->buscar . '%')//Encuentra y almacena en la variable users los que tienen en alguna parte de su nombre el valor de la variable buscar
        ->orderBy('id', 'desc')//Los ordena en orden decendente por id
        ->paginate(10);//Cada pagina contiene 5 objetos
        return view('livewire.objet.create-user', compact('users'));//Devuelve la vista create-user, con los usuarios almacenados en la variable users
    }

    //La funcion enviar debuelve los datos de un user
    public function enviar(){
        $user = new User();//se crea un user para almacenar los datos

        $user->name = $this->plates;//obtiene el dato del nombre del usuario
        $user->last_name = $this->reason;//obtiene el dato del apellido del usuario
        $user->turn = $this->check_in_time;//obtiene el dato del turno del usuario
        $user->action = $this->check_out_time;//obtiene el dato de la accion del usuario
        $user->cluster_id = $this->cluster_id;//obtiene el dato del id del cluster al que pertenece
        $user->stand_id = $this->stand_id;//obtiene el dato del id del stand al que pertenece
        $user->save(); //Se guarda el user
        $this->reset(['name', 'last_name', 'turn', 'action', 'cluster_id', 'stand_id']);//Se resetean los valores del user para poder poner otros
    }
}
