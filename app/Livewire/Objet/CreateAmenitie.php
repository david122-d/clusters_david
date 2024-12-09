<?php

namespace App\Livewire\Objet;

use App\Models\Amenity;
use App\Models\Cluster;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Adapter\PDFLib;
use Illuminate\Support\Facades\Facade;

class CreateAmenitie extends Component
{
    public $name;
    public $type;
    public $status;
    public $cluster_id = '';
    
    public $isEditable;
    public $clusters;
    public $buscar='';

    public $amenitiEdit = [
        'id' => '',
        'name' => '',
        'type' => '',
        'status' => '',
        'cluster_id' => '',
    ];

    public $idEditable;
    public $reportClust = false;

     //Variables para mostrar los cuestionarios de agregar y editar
     public $aAdd = false;
     public $aEdit = false;
     public $selectedAmenitiId;
     public $selectedClusterId;
 
     //Obtiene los valores de la tabla amenitie 
     public function mount(){
         $this->clusters = Cluster::all();
     }
 
     //Esta funcion Devuelve la vista de create amenitie
    public function render()
    {
        //$this->amenities = Amenity::all();
        //return view('livewire.objet.create-amenitie');

        $amenities = Amenity::where('name', 'like', '%' . $this->buscar . '%')//Encuentra y almacena en la variable amenities los que tienen en alguna parte de su nombre el valor de la variable buscar
        ->orderBy('id', 'desc')//Los ordena en orden decendente por id
        ->paginate(10);//Cada pagina contiene 5 objetos
        return view('livewire.objet.create-amenitie', compact('amenities'));//Devuelve la vista create-amenities, con las amenidades almacenados en la variable amenities
    }

    //La funcion enviar debuelve los datos de un ameniti
    public function enviar(){
        $ameniti = new Amenity();//se crea un ameniti para almacenar los datos

        $ameniti->name = $this->name;//obtiene el dato del nombre
        $ameniti->type = $this->type;//obtiene el dato del tipo
        $ameniti->status = $this->status;//obtiene el dato del estatus
        $ameniti->cluster_id = $this->cluster_id;//obtiene el dato del id del cluster al que pertenece
        $ameniti->save(); //Se guarda el ameniti
        $this->reset(['name', 'type', 'status', 'cluster_id']);//Se resetean los valores del ameniti para poder poner otros
    }

    public function update($amenitiID){
        $this->aEdit = true;//Se activa la edicion u muestra el cuadro de edicion

        $amenitiEditable = Amenity::find($amenitiID);//encuentra el id de el vehiculo a editar y lo guarda en el id del objeto amenitiEditable
        $this->idEditable = $amenitiEditable->id; //Le da el valor del ID de amenitiEditable a idEditable
        //Toma los valores de cada atrobuto de el objeto a editar y lo asigna al mismo atributo del objeto amenitiEdit
        $this->amenitiEdit['name'] = $amenitiEditable->name;
        $this->amenitiEdit['type'] = $amenitiEditable->type;
        $this->amenitiEdit['status'] = $amenitiEditable->status;
        $this->amenitiEdit['cluster_id'] = $amenitiEditable->cluster_id;
    }

    public function editar(){
        $ameniti = Amenity::find($this->idEditable);//Buscamos el objeto que contenga idEditable obtenido en la funcion update

        //Le actualizamos el valor de cada atributo por el nuevo almacenado en amenitiEdit
        $ameniti->update([
        'name' => $this->amenitiEdit['name'],
        'type' => $this->amenitiEdit['type'],
        'status' => $this->amenitiEdit['status'],
        'cluster_id' => $this->amenitiEdit['cluster_id']
        ]);

        //Reseteamos estas variables para evitar problemas en futuras ejecuciones
        $this->reset([
            'amenitiEdit',
            'idEditable',
            'aEdit'
        ]);
    }

    //Sirve para inicializar el mandado de informacion, en donde crea una nueva amenidad para almacenarla, 
    public function agregar(){
        $this->aAdd = true; 
        $ameniti = new Amenity();

        $this->reset([
            'amenitiEdit',
            'idEditable',
            'aEdit'
        ]);
    }

    //Tomamos el ameniti que recibimos de la vista y le aplicamos un metodo delete para eleminarlo de la tabla
    public function eliminar (Amenity $ameniti){
        $ameniti->delete();
    }

    public function generarReportePDFCluster()
    {
        $this->reportClust = true;
    }

    public function createPDFCluster()
    {
        $this->reportClust = true;

        if ($this->selectedClusterId) {
            $amenities = Amenity::where('cluster_id', $this->selectedClusterId)->get();
            $clust = Cluster::find($this->selectedClusterId);
            $na = $clust->name; 
            $pdf = FacadePdf::loadView('livewire.objet.report-ameniti-pdf', ['amenities' => $amenities, 'nombre' => $na]);
            return response()->streamDownload(
                fn () => print($pdf->output()),
                "reporte_cluster_" . $this->selectedClusterId . ".pdf"
            );
        }
    }
}
