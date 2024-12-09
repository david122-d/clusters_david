<?php

namespace App\Livewire\Objet;

use App\Models\Cluster;
use App\Models\Stand;
use App\Models\User;
use App\Models\VehicleEntrance;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Container\Attributes\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;

class CreateVehicleEntrance extends Component
{
    public $plates;
    public $reason;
    public $check_in_time;
    public $check_out_time;
    public $cluster_id = '';
    public $stand_id = '';
    public $user_id = '';
    
    public $isEditable;
    //public $vehicleEntrances;
    public $clusters;
    public $stands;
    public $users;
    public $vehicleEntranceID;
    public $standUsers;

    public $vehicleEntranceEdit = [
        'id' => '',
        'plates' => '',
        'reason' => '',
        'check_in_time' => '',
        'check_out_time' => '',
        'cluster_id' => '',
        'stand_id' => '',
        'user_id' => '',
    ];

    public $idEditable;
    public $selectedClusterId;
    public $selectedUserId;
    public $buscar='';

     //Variables para mostrar los cuestionarios de agregar y editar
     public $vAdd = false;
     public $vEdit = false;
     public $vOut = false;
     public $vDelete = false;
     public $reportClust = false;
     public $reportUser = false;
 
     //Obtiene los valores de la tabla vehicle_entrancee 
     public function mount(){
         $this->clusters = Cluster::all();
         $this->stands = Stand::all();
         $this->users = User::all();
         $this->standUsers = $this->users->where('action', 'in stand'); //Obtiene los usuarios que tengan como valor 'in stand' en el atributo 'action'
     }
 
     //Esta funcion Devuelve la vista de create vehicle_entrancee
    public function render()
    {
        //$this->vehicleEntrances = VehicleEntrance::all();
        //return view('livewire.objet.create-vehicle-entrance');

        $vehicleEntrances = VehicleEntrance::where('plates', 'like', '%' . $this->buscar . '%')//Encuentra y almacena en la cariable vehicleEntrances los que tienen en alguna parte de su nombre el valor de la variable buscar
        ->orderBy('id', 'desc')//Los ordena en orden decendente por id
        ->paginate(20);//Cada pagina contiene 5 objetos
        return view('livewire.objet.create-vehicle-entrance', compact('vehicleEntrances'));//Devuelve la vista create-cluster, con las entradas de vehiculos almacenados en la variable vehicleEntrances
        
    }

    //La funcion enviar devuelve los datos de un vehicleEntrance
    public function enviar(){
        $vehicleEntrance = new VehicleEntrance();//se crea una entrada de veiculo para almacenar los datos

        $vehicleEntrance->plates = $this->plates;//obtiene el dato de las placas
        $vehicleEntrance->reason = $this->reason;//obtiene el dato de la razon 
        $vehicleEntrance->check_in_time = Carbon::now();//obtiene el dato de la hora de entrada
        $vehicleEntrance->check_out_time = $this->check_out_time;//obtiene el dato de la hora de salida
        $vehicleEntrance->cluster_id = $this->cluster_id;//obtiene el dato del id del cluster al que pertenece
        $vehicleEntrance->stand_id = $this->stand_id;//obtiene el dato del id del stand al que pertenece
        $vehicleEntrance->user_id = $this->user_id;//obtiene el dato del id del guardia al que pertenece
        $vehicleEntrance->save(); //Se guarda el vehicleEntrance
        $this->reset(['plates', 'reason', 'check_in_time', 'check_out_time', 'cluster_id', 'stand_id', 'user_id']);//Se resetean los valores del vehicleEntrance para poder poner otros
    }

    public function update($vehicleEntranceID){
        $this->vEdit = true; //Se activa la edicion u muestra el cuadro de edicion

        $vehicleEntranceEditable = VehicleEntrance::find($vehicleEntranceID); //encuentra el id de el vehiculo a editar y lo guarda en el id del objeto vehicleEntranceEditable
        $this->idEditable = $vehicleEntranceEditable->id; //Le da el valor del ID de vehicleEntranceEditable a idEditable
        //Toma los valores de cada atrobuto de el objeto a editar y lo asigna al mismo atributo del objeto vehicleEntranceEdit
        $this->vehicleEntranceEdit['plates'] = $vehicleEntranceEditable->plates;
        $this->vehicleEntranceEdit['reason'] = $vehicleEntranceEditable->reason;
        $this->vehicleEntranceEdit['check_in_time'] = $vehicleEntranceEditable->check_in_time;
        $this->vehicleEntranceEdit['check_out_time'] = $vehicleEntranceEditable->check_out_time;
        $this->vehicleEntranceEdit['cluster_id'] = $vehicleEntranceEditable->cluster_id;
        $this->vehicleEntranceEdit['stand_id'] = $vehicleEntranceEditable->stand_id;
        $this->vehicleEntranceEdit['user_id'] = $vehicleEntranceEditable->user_id;
    } 


    //Creamos una funcion para actualizar el valor de salida
    public function salida($vehicleEntranceID)
    {  

        $this->check_out_time = Carbon::now();//Le asignamos la hora actual a la variable check_out_time
    
        $vehicleEntranceEditable = VehicleEntrance::find($vehicleEntranceID);//Le asigmanos a vehicleEntranceEditable el los valores de la entrada a actualizar
    
        //Si encontramos la entrada de vehiculo, reemplazamos a anterior entrada y le asignamos la nueva y lo guardamos
        if ($vehicleEntranceEditable) {
            $vehicleEntranceEditable->check_out_time = $this->check_out_time;
            $vehicleEntranceEditable->save();
    
        }
    }
    

    public function editar(){
        $vehicleEntrance = VehicleEntrance::find($this->idEditable); //Buscamos el objeto que contenga idEditable obtenido en la funcion update

        //Le actualizamos el valor de cada atributo por el nuevo almacenado en vehicleEntranceEdit
        $vehicleEntrance->update([
        'plates' => $this->vehicleEntranceEdit['plates'],
        'reason' => $this->vehicleEntranceEdit['reason'],
        'check_in_time' => $this->vehicleEntranceEdit['check_in_time'],
        'check_out_time' => $this->vehicleEntranceEdit['check_out_time'],
        'cluster_id' => $this->vehicleEntranceEdit['cluster_id'],
        'stand_id' => $this->vehicleEntranceEdit['stand_id'],
        'user_id' => $this->vehicleEntranceEdit['user_id']
        ]);

        //Reseteamos estas variables para evitar problemas en futuras ejecuciones
        $this->reset([
            'vehicleEntranceEdit',
            'idEditable',
            'vEdit'
        ]);
    }

    //Sirve para inicializar el mandado de informacion, en donde crea una nueva entrada de vehiculo para almacenarla, 
    public function agregar(){
        $this->vAdd = true; 
        $vehicleEntrance = new VehicleEntrance();

        $this->reset([
            'vehicleEntranceEdit',
            'idEditable',
            'vEdit'
        ]);
    }

    //Tomamos la entrada de veiculo que recibimos de la vista y le aplicamos un metodo delete para eleminarlo de la tabla
    public function eliminar (VehicleEntrance  $vehicleEntrance){
        $this->vDelete = true;
        $vehicleEntrance->delete();
    }

    public function generarReportePDFCluster()
    {
        $this->reportClust = true;
    }

    public function generarReportePDFUser()
    {
        $this->reportUser = true;
    }

    //Obtenemos los datos de la entradas de vehiculos que tienen el id del cluster seleccionado y los manda al reporte y lo devuelve ya hecho
    public function createPDFCluster()
    {
        $this->reportClust = true;

        if ($this->selectedClusterId) {
            $vehicleEntrances = VehicleEntrance::where('cluster_id', $this->selectedClusterId)->get();
            $pdf = FacadePdf::loadView('livewire.objet.report-vehicle-pdf', ['vehicleEntrances' => $vehicleEntrances]);
            return response()->streamDownload(
                fn () => print($pdf->output()),
                "reporte_entradas_vehiculos_" . $this->selectedClusterId . ".pdf"
            );
        }
    }

    //Obtenemos los datos de la entradas de vehiculos que tienen el id del suario seleccionado y los manda al reporte y lo devuelve ya hecho
    public function createPDFUser()
    {
        $this->reportUser = true;

        if ($this->selectedUserId) {
            $vehicleEntrances = VehicleEntrance::where('user_id', $this->selectedUserId)->get();
            $pdf = FacadePdf::loadView('livewire.objet.report-vehicle-pdf', ['vehicleEntrances' => $vehicleEntrances]);
            return response()->streamDownload(
                fn () => print($pdf->output()),
                "reporte_entradas_vehiculos_" . $this->selectedUserId . ".pdf"
            );
        }
    }
    
}
