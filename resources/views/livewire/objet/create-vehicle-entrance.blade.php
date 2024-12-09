<div>

    
    <div class="mb-4">
        <x-button class="blue-600 m-4" wire:click='agregar()'>Agregar nueva entrada</x-button>
        <input wire:model.live='buscar' type="text" class="form-control" placeholder="Buscar por placas...">
    </div>

    <div class="d-flex justify-content-end mb-4">
        <x-button class="blue-600 m-4" wire:click="generarReportePDFUser">Generar Reporte PDF por Usuario</x-button>
        <x-button class="blue-600 m-4" wire:click="generarReportePDFCluster">Generar Reporte PDF por Clúster</x-button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Placas
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hora de entrada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hora de salida
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Condominio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Caseta
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Guardia
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>

            @foreach($vehicleEntrances as $vehicleEntrance)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$vehicleEntrance->plates}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$vehicleEntrance->check_in_time}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$vehicleEntrance->check_out_time}}
                    </th>


                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $vehicleEntrance->cluster->name ?? 'No asignado' }}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $vehicleEntrance->stand->number ?? 'No asignado' }}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $vehicleEntrance->user->name ?? 'No asignado' }}
                    </th>
        
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click='update({{$vehicleEntrance->id}})'>Editar</a>
                        <div></div>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click='eliminar({{$vehicleEntrance->id}})'>Eliminar</a>
                        <div></div>
                        <a href="#" class="font-medium text-green-600 dark:text-green-500 hover:underline" wire:click='salida({{$vehicleEntrance->id}})'>Actualizar salida</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $vehicleEntrances->links() }}
        </div>
    </div>

    @if($reportUser)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
        <div class="bg-white shadow rounded-lg p-6 w-96">
            <x-label for="user_id" value="Seleccionar usuario para Reporte PDF" />
            
            <select wire:model="selectedUserId" class="W-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                <option value="" disabled>Seleccione un usuario</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
    
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('reportUser', false)">
                    Cancelar
                </button>
                
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="createPDFUser" wire:click="set('reportUser', false)">
                    Crear
                </button>
            </div>
        </div>
    </div>
    @endif

    @if($reportClust)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
        <div class="bg-white shadow rounded-lg p-6 w-96">
            <x-label for="cluster_id" value="Seleccionar condominio para Reporte PDF" />
            
            <select wire:model="selectedClusterId" class="W-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                <option value="" disabled>Seleccione un condominio</option>
                @foreach($clusters as $cluster)
                    <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                @endforeach
            </select>
    
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('reportClust', false)">
                    Cancelar
                </button>
                
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="createPDFCluster" wire:click="set('reportClust', false)">
                    Crear
                </button>
            </div>
        </div>
    </div>
    @endif

    @if($vOut)
        <form class="max-w-lg mx-auto" wire:submit="salida({{ $vehicleEntranceID }})">
    @endif


    @if($vEdit)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-10 w-200">
                <div class="bg-white shadow rounded-lg p-12">
                    <form class="max-w-lg mx-auto" wire:submit='editar'>
                        <div class="mb-4"><span>Editar Entrada:</span></div>
                        <div>
                        <x-label class="w-full" for="plates" value="Placas"/>
                        <x-input class="w-full" name="plates" wire:model='vehicleEntranceEdit.plates'/><br>
                        </div>

                        <div>
                            <x-label class="w-full" for="reason" value="Razon"/>
                            <textarea class="w-full" rows="4"  name="reason" wire:model='vehicleEntranceEdit.reason'>Escriba su mensaje aquí</textarea><br>
                        </div>

                        <div>
                            <x-label class="w-full" for="cluster_id" value="Condominio"/>
                                <select wire:model='vehicleEntranceEdit.cluster_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                <option value="" disabled> Seleccione un condominio</option>
                                    @foreach($clusters as $cluster)
                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>  <br>
                        </div>

                        <div>
                            <x-label class="w-full" for="stand_id" value="Caseta"/>
                                <select wire:model='vehicleEntranceEdit.stand_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                <option value="" disabled> Seleccione una caseta</option>
                                    @foreach($stands as $stand)
                                        <option value="{{$stand->id}}">{{$stand->number}}</option>
                                    @endforeach
                                </select>  <br>
                        </div>

                        <div>
                            <x-label class="w-full" for="user_id" value="Guardia"/>
                                <select wire:model='vehicleEntranceEdit.user_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                <option value="" disabled> Seleccione un guardia</option>
                                    @foreach($standUsers as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>  <br>
                        </div>
                            
                        <br>

                        <div class="flex items-center space-x-4">
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('vEdit', false)">Cancelar</button>
                            <br>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($vAdd)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-10 w-200">
                <div class="bg-white shadow rounded-lg p-12">
                    <form class="max-w-lg mx-auto" wire:submit='enviar'>
                        <div class="mb-4"><span>Agregar nueva entrada</span></div>
                        <div class="mb-4 ml-4">
                            <div>
                                <x-label class="w-full" value="Placas"/>
                                <x-input class="w-full" wire:model='plates' required/><br>
                            </div>

                            <br>

                            <div>
                                <x-label class="w-full" value="Razón"/>
                                <textarea class="w-full" rows="7"  name="reason"  wire:model='reason' required> Ingresa la razón</textarea><br>
                            </div>

                            <br>

                            <div>
                                <x-label class="w-full" for="cluster_id" value="Condominio"/>
                                <select wire:model='cluster_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                    <option value="" disabled>Seleccione un condominio</option>
                                    @foreach($clusters as $cluster)
                                        <option wire:key='{{ $cluster->id }}' value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div>
                                <x-label class="w-full" for="stand_id" value="Caseta"/>
                                <select wire:model='stand_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                    <option value="" disabled>Seleccione una caseta</option>
                                    @foreach($stands as $stand)
                                        <option wire:key='{{ $stand->id }}' value="{{$stand->id}}">{{$stand->number}}</option>
                                    @endforeach
                                </select>

                            </div>
                                
                            <br>

                            <div>
                                <x-label class="w-full" for="user_id" value="Guardia"/>
                                <select wire:model='user_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                    <option value="" disabled>Seleccione un guardia</option>
                                    @foreach($standUsers as $user)
                                        <option wire:key='{{ $user->id }}' value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                                <br>
        
                            <div class="flex items-center space-x-4">
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('vAdd', false)">Cancelar</button>
                                <br>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="set('vAdd', false)">Agregar</button>
                                
                            </div>
                        </div>
                    
                    </form>
                </div>
        </div>
    @endif
</div>
