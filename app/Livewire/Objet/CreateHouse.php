<?php

namespace App\Livewire\Objet;

use App\Models\Cluster;
use App\Models\House;
use Livewire\Component;

class CreateHouse extends Component
{
    public $number;
    public $owner_name;
    public $maintenance;
    public $cluster_id = '';
    
    public $isEditable;
    //public $houses;
    public $clusters;

    public $houseEdit = [
        'id' => '',
        'number' => '',
        'owner_name' => '',
        'maintenance' => '',
        'cluster_id' => '',
    ];

    public $idEditable;
    public$buscar='';

     //Variables para mostrar los cuestionarios de agregar y editar
     public $hAdd = false;
     public $hEdit = false;
 
     //Obtiene los valores de la tabla houses 
     public function mount(){
         $this->clusters = Cluster::all();
     }
 
     //Esta funcion Devuelve la vista de create houses
    public function render()
    {
        if($this->buscar == ''){
            $houses = House::paginate(20);

        }else{
            $houses = House::where('number','like', '%' . $this->buscar . '%')//Encuentra y almacena en la variable houses las casas que tienen en alguna parte de su nombre el valor de la variable buscar
            ->orderBy('id', 'desc')//Los ordena en orden decendente por id
            ->paginate(20);//Cada pagina contiene 5 objetos
        }
        return view('livewire.objet.create-house', compact('houses'));//Devuelve la vista create-house, con los clusters almacenados en la variable houses
    
    }

    //La funcion enviar debuelve los datos de un house
    public function enviar(){
        $house = new House();//se crea un house para almacenar los datos

        $house->number = $this->number;//obtiene el dato del numero de la casa
        $house->owner_name = $this->owner_name;//obtiene el dato del nombre del dueño
        $house->maintenance = $this->maintenance;//obtiene el dato del estatus del pago
        $house->cluster_id = $this->cluster_id;//obtiene el dato del id del cluster al que pertenece
        $house->save(); //Se guarda el house
        $this->reset(['number', 'owner_name', 'maintenance', 'cluster_id']);//Se resetean los valores del house para poder poner otros
    }

    public function update($houseID){
        $this->hEdit = true;//Se activa la edicion u muestra el cuadro de edicion

        $houseEditable = House::find($houseID);//encuentra el id de el vehiculo a editar y lo guarda en el id del objeto houseEditable
        $this->idEditable = $houseEditable->id; //Le da el valor del ID de houseEditable a idEditable
        //Toma los valores de cada atrobuto de el objeto a editar y lo asigna al mismo atributo del objeto houseEdit
        $this->houseEdit['number'] = $houseEditable->number;
        $this->houseEdit['owner_name'] = $houseEditable->owner_name;
        $this->houseEdit['maintenance'] = $houseEditable->maintenance;
        $this->houseEdit['cluster_id'] = $houseEditable->cluster_id;
    }

    public function editar(){
        $house = House::find($this->idEditable);//Buscamos el objeto que contenga idEditable obtenido en la funcion update

        //Le actualizamos el valor de cada atributo por el nuevo almacenado en houseEdit
        $house->update([
        'number' => $this->houseEdit['number'],
        'owner_name' => $this->houseEdit['owner_name'],
        'maintenance' => $this->houseEdit['maintenance'],
        'cluster_id' => $this->houseEdit['cluster_id']
        ]);

        //Reseteamos estas variables para evitar problemas en futuras ejecuciones
        $this->reset([
            'houseEdit',
            'idEditable',
            'hEdit'
        ]);
    }

    //Sirve para inicializar el mandado de informacion, en donde crea una nueva casa para almacenarla, 
    public function agregar(){
        $this->hAdd = true; 
        $house = new House();

        $this->reset([
            'houseEdit',
            'idEditable',
            'hEdit'
        ]);
    }

    //Tomamos el house que recibimos de la vista y le aplicamos un metodo delete para eleminarlo de la tabla
    public function eliminar (House $house){
        $house->delete();
    }
}
