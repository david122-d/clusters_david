<?php

namespace App\Livewire\Objet;

use App\Models\Cluster;
use App\Models\Stand;
use Livewire\Component;

class CreateStand extends Component
{
    public $number;
    public $cluster_id = '';
    
    public $isEditable;
    public $stands;
    public $clusters;

    public $standEdit = [
        'id' => '',
        'number' => '',
        'cluster_id' => '',
    ];

    public $idEditable;

    //Variables para mostrar los cuestionarios de agregar y editar
    public $sAdd = false;
    public $sEdit = false;

    //Obtiene los valores de la tabla cluster 
    public function mount(){
        $this->clusters = Cluster::all();
    }

    //Esta funcion Devuelve la vista de create stand
    public function render()
    {
        $this->stands = Stand::all();
        return view('livewire.objet.create-stand');
    }

    //La funcion enviar debuelve los datos de un stand
    public function enviar(){
        $stand = new Stand();//se crea un stand para almacenar los datos

        $stand->number = $this->number;//obtiene el dato del nombre
        $stand->cluster_id = $this->cluster_id;//obtiene el dato del id del cluster al que pertenece
        $stand->save(); //Se guarda el stand
        $this->reset(['number', 'cluster_id']);//Se resetean los valores del stand para poder poner otros
    }

    public function update($standID){
        $this->sEdit = true;

        $standEditable = Stand::find($standID);
        $this->idEditable = $standEditable->id;
        $this->standEdit['number'] = $standEditable->number;
        $this->standEdit['cluster_id'] = $standEditable->cluster_id;
    }

    public function editar(){
        $stand = Stand::find($this->idEditable);

        $stand->update([
        'number' => $this->standEdit['number'],
        'cluster_id' => $this->standEdit['cluster_id']
        ]);

        $this->reset([
            'standEdit',
            'idEditable',
            'sEdit'
        ]);
    }

    //
    public function agregar(){
        $this->sAdd = true; 
        $stand = new Stand();

        $this->reset([
            'standEdit',
            'idEditable',
            'sEdit'
        ]);
    }

    //Tomamos el stand que recibimos de la vista y le aplicamos un metodo delete para eleminarlo de la tabla
    public function eliminar (Stand $stand){
        $stand->delete();
    }
}
