<?php

namespace App\Livewire\Objet;

use App\Models\Cluster;
use Livewire\Component;

class CreateCluster extends Component
{
    public $name;
    public $cAdd = false;
    public $cEdit = false;
    public $isEditable;
    public $clusters;

    public $clusterEdit = [
        'id' => '',
        'name' => '',
    ];

    public $idEditable;

    //Esta funcion Devuelve la vista de create cluster
    public function render()
    {
        $this->clusters = Cluster::all();
        return view('livewire.objet.create-cluster');
    }

    //La funcion enviar debuelve los datos de un cluster
    public function enviar(){
        $cluster = new Cluster();//se crea un cluster para almacenar los datos

        $cluster->name = $this->name;//obtiene el dato del nombre
        $cluster->save(); //Se guarda el cluster
        $this->reset(['name']);//Se resetean los valores del cluster para poder poner otros
    }

    public function update($clusterID){
        $this->cEdit = true;

        $clusterEditable = Cluster::find($clusterID);
        $this->idEditable = $clusterEditable->id;
        $this->clusterEdit['name'] = $clusterEditable->name;
    }

    public function editar(){
        $cluster = Cluster::find($this->idEditable);

        $cluster->update([
        'name' => $this->clusterEdit['name']
        ]);

        $this->reset([
            'clusterEdit',
            'idEditable',
            'cEdit'
        ]);
    }

    //
    public function agregar(){
        $this->cAdd = true; 
        $cluster = new Cluster();

        $this->reset([
            'clusterEdit',
            'idEditable',
            'cEdit'
        ]);
    }

    //Tomamos el cluster que recibimos de la vista y le aplicamos un metodo delete para eleminarlo de la tabla
    public function eliminar (Cluster $cluster){
        $cluster->delete();
    }
}
