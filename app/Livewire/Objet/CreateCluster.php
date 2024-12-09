<?php

namespace App\Livewire\Objet;

use App\Models\Amenity;
use App\Models\Cluster;
use App\Models\VehicleEntrance;
use Livewire\Component;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Dompdf\Adapter\PDFLib;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Facade;

class CreateCluster extends Component
{
    public $name;
    public $cAdd = false;
    public $cEdit = false;
    public $isEditable;
    public $buscar = '';

    public $clusterEdit = [
        'id' => '',
        'name' => '',
    ];

    public $amenities;
    public $vehicleEntrances;
    public $selectedClusterId;
    public $clust;

    public $idEditable;
    public $reportClust = false;

    //Esta funcion Devuelve la vista de create cluster
    public function render()
    {
        //$this->clusters = Cluster::all();
        //return view('livewire.objet.create-cluster');

        $clusters = Cluster::where('name', 'like', '%' . $this->buscar . '%')//Encuentra y almacena en la cariable clusters los que tienen en alguna parte de su nombre el valor de la variable buscar
        ->orderBy('id', 'desc')//Los ordena en orden decendente por id
        ->paginate(10);//Cada pagina contiene 5 objetos
        return view('livewire.objet.create-cluster', compact('clusters'));//Devuelve la vista create-cluster, con los clusters almacenados en la variable clusters
    }

    //La funcion enviar debuelve los datos de un cluster
    public function enviar(){
        $cluster = new Cluster();//se crea un cluster para almacenar los datos

        $cluster->name = $this->name;//obtiene el dato del nombre
        $cluster->save(); //Se guarda el cluster
        $this->reset(['name']);//Se resetean los valores del cluster para poder poner otros
    }

    public function update($clusterID){
        $this->cEdit = true;//Se activa la edicion u muestra el cuadro de edicion

        $clusterEditable = Cluster::find($clusterID);//encuentra el id de el vehiculo a editar y lo guarda en el id del objeto clusterEditable
        $this->idEditable = $clusterEditable->id; //Le da el valor del ID de clusterEditable a idEditable
        //Toma los valores de cada atrobuto de el objeto a editar y lo asigna al mismo atributo del objeto clusterEdit
        $this->clusterEdit['name'] = $clusterEditable->name;
    }

    public function editar(){
        $cluster = Cluster::find($this->idEditable);//Buscamos el objeto que contenga idEditable obtenido en la funcion update

        //Le actualizamos el valor de cada atributo por el nuevo almacenado en clusterEdit
        $cluster->update([
        'name' => $this->clusterEdit['name']
        ]);

        //Reseteamos estas variables para evitar problemas en futuras ejecuciones
        $this->reset([
            'clusterEdit',
            'idEditable',
            'cEdit'
        ]);
    }

    //Sirve para inicializar el mandado de informacion, en donde crea un nuevo cluster para almacenarla, 
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

    public function generarReportePDFCluster()
    {
        $this->reportClust = true;
    }

    //Obtenemos los datos de las amenidades y entradas
    public function createPDFCluster()
    {
        $this->reportClust = true;

        if ($this->selectedClusterId) {
            $amenities = Amenity::where('cluster_id', $this->selectedClusterId)->get();
            $vehicleEntrances = VehicleEntrance::where('cluster_id', $this->selectedClusterId)->get();
            $clust = Cluster::find($this->selectedClusterId);
            $na = $clust->name; 
            $pdf = FacadePdf::loadView('livewire.objet.report-cluster-pdf', ['amenities' => $amenities, 'vehicleEntrances' => $vehicleEntrances, 'selectedClust' => $na]);
            return response()->streamDownload(
                fn () => print($pdf->output()),
                "reporte_cluster_" . $this->selectedClusterId . ".pdf"
            );
        }
    }
}
