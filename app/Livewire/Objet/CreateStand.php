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
    public $clusters;
    //public $stands;
    public $buscar='';

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
        if($this->buscar == ''){
            $stands = Stand::paginate(10);

        }else{
            $stands = Stand::where('number','like', '%' . $this->buscar . '%')//Encuentra y almacena en la variable stands los stands que tienen en alguna parte de su nombre el valor de la variable buscar
            ->orderBy('id', 'desc')//Los ordena en orden decendente por id
            ->paginate(10);//Cada pagina contiene 5 objetos
        }
        return view('livewire.objet.create-stand', compact('stands'));//Devuelve la vista create-cluster, con los clusters almacenados en la variable clusters
    
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
        $this->sEdit = true;//Se activa la edicion u muestra el cuadro de edicion

        $standEditable = Stand::find($standID);//encuentra el id de el vehiculo a editar y lo guarda en el id del objeto standEditable
        $this->idEditable = $standEditable->id; //Le da el valor del ID de standEditable a idEditable
        //Toma los valores de cada atrobuto de el objeto a editar y lo asigna al mismo atributo del objeto standEdit
        $this->standEdit['number'] = $standEditable->number;
        $this->standEdit['cluster_id'] = $standEditable->cluster_id;
    }

    public function editar(){
        $stand = Stand::find($this->idEditable);//Buscamos el objeto que contenga idEditable obtenido en la funcion update

        //Le actualizamos el valor de cada atributo por el nuevo almacenado en standEdit
        $stand->update([
        'number' => $this->standEdit['number'],
        'cluster_id' => $this->standEdit['cluster_id']
        ]);

        //Reseteamos estas variables para evitar problemas en futuras ejecuciones
        $this->reset([
            'standEdit',
            'idEditable',
            'sEdit'
        ]);
    }

    //Sirve para inicializar el mandado de informacion, en donde crea un nuevo stand paraa almacenarlo, 
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
