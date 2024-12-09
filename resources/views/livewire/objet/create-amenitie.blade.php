<div>


    <x-button class="blue-600 m-4" wire:click='agregar()'>Crear nueva amenidad</x-button>

    <input wire:model.live='buscar' type="text" class="form-control" placeholder="Buscar por nombre...">

    <div class="d-flex justify-content-end mb-4">
        <x-button class="blue-600 m-4" wire:click="generarReportePDFCluster">Generar Reporte PDF</x-button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre de la amenidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Condominio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>

            @foreach($amenities as $ameniti)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$ameniti->name}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$ameniti->type}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$ameniti->status}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $ameniti->cluster->name ?? 'No asignado' }}
                    </th>
        
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click='update({{$ameniti->id}})'>Editar</a>
                        <div></div>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click='eliminar({{$ameniti->id}})'>Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $amenities->links() }}
        </div>
    </div>

    
    @if($aEdit)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-6 w-110">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='editar'>
                        <div class="mb-4"><span>Editar Sucursal:</span></div>
                        <div>
                        <x-label class="w-full" for="name" value="Nombre del ameniti"/>
                        <x-input class="w-full" name="name" wire:model='amenitiEdit.name'/><br>
                        </div>

                        <div class="flex flex-wrap mb-4">
                                <x-label class="w-full" for="type" value="Tipo"/>
                                    <select wire:model='amenitiEdit.type' class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                        <option value="" disabled>Seleccione un estado para la amenidad</option>
                                        <option value="pool">Picina</option>
                                        <option value="tennis court">Cancha de tenis</option>
                                        <option value="basketball court">Cancha de basketball</option>
                                        <option value="gym">Gimnacio</option>
                                        <option value="party hall">Salón de fiestas</option>
                                        <option value="park">Parque</option>
                                        <option value="soccer field">Cancha de futbol</option>
                                        <option value="little shop">Tiendita</option>
                                        <option value="skating rink">Pista de skate</option>
                                        <option value="cinema">Sala de cine</option>
                                        <option value="meeting room">Cuarto de reuniones</option>
                                  </select>
                                  <br>                              
                          </div>


                        <div class="flex flex-wrap mb-4">                            
                                <x-label class="w-full" for="status" value="Estado"/>
                                    <select wire:model='amenitiEdit.status' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                    <option value="" disabled>Seleccione una opcion</option>
                                    <option value="activa">Disponible</option>
                                    <option value="inactiva">No disponible</option>
                                    <option value="maintenance">En mantenimiento</option>
                                  </select>
                                  <br>
                          </div>

                        <div>
                            <x-label class="w-full" for="cluster_id" value="Condominio"/>
                                <select wire:model='amenitiEdit.cluster_id' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                <option value="" disabled> Seleccione un condominio</option>
                                    @foreach($clusters as $cluster)
                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>  <br>
                        </div>
                            
                        <br>

                        <div class="flex items-center space-x-4">
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('aEdit', false)">Cancelar</button>
                            <br>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                        </div>
                    </form>
                </div>
        </div>
    @endif

    @if($aAdd)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-10 w-200">
                <div class="bg-white shadow rounded-lg p-12">
                    <form class="max-w-lg mx-auto" wire:submit='enviar'>
                        <div class="mb-4"><span>Crear nueva amenidad</span></div>
                        <div class="mb-4 ml-4">
                            <div>
                                <x-label class="w-full" value="Nombre de la amenidad"/>
                                <x-input class="w-full" wire:model='name' required/><br>
                            </div>

                            <br>

                            <div>
                             <div class="flex flex-wrap mb-4">
                                    <x-label for="type" value="Tipo"  class="w-full"/>
                                      <select wire:model='type' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                        <option value="" disabled>Seleccione un tipo</option>
                                        <option value="Picina">Picina</option>
                                        <option value="tennis court">Cancha de tenis</option>
                                        <option value="basketball court">Cancha de basketball</option>
                                        <option value="gym">Gimnacio</option>
                                        <option value="party hall">Salón de fiestas</option>
                                        <option value="park">Parque</option>
                                        <option value="soccer field">Cancha de futbol</option>
                                        <option value="little shop">Tiendita</option>
                                        <option value="skating rink">Pista de skate</option>
                                        <option value="cinema">Sala de cine</option>
                                        <option value="meeting room">Cuarto de reuniones</option>
                                      </select>
                                      <br>                                  
                              </div>
                            </div>


                            <div class="flex flex-wrap mb-4">
                                    <x-label for="status" value="Estado"  class="w-full"/>
                                      <select wire:model='status' class="w-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                        <option value="" disabled>Seleccione un estado</option>
                                        <option value="activa">Disponible</option>
                                        <option value="inactiva">No disponible</option>
                                        <option value="En mantenimiento">En mantenimiento</option>
                                      </select>
                                      <br>                    
                              </div>

                            <div>
                                <x-label class="w-full" for="cluster_id" value="Condominio"/>
                                <select wire:model='cluster_id' class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                    <option value="" disabled>Seleccione un condominio</option>
                                    @foreach($clusters as $cluster)
                                        <option wire:key='{{ $cluster->id }}' value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                                
                                <br>
        
                            <div class="flex items-center space-x-4">
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('aAdd', false)">Cancelar</button>
                                <br>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="set('aAdd', false)">Agregar</button>
                                
                            </div>
                        </div>
                    
                    </form>
                </div>
        </div>

    @endif

    @if($reportClust)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
        <div class="bg-white shadow rounded-lg p-6 w-96">
            <x-label for="cluster_id" value="Seleccionar Condominio para Reporte PDF" />
            
            <select wire:model="selectedClusterId" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
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
    
</div>
