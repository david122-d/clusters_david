<div>

    <x-button class="blue-600 m-4" wire:click='agregar()'>Crear nueva caseta</x-button>

    <input wire:model.live='buscar' type="text" class="form-control" placeholder="Buscar por numero...">

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Numero de caseta
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Condominio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>

            @foreach($stands as $stand)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$stand->number}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $stand->cluster->name ?? 'No asignado' }}
                    </th>
        
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click='update({{$stand->id}})'>Editar</a>
                        <div></div>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click='eliminar({{$stand->id}})'>Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $stands->links() }}
        </div>
    </div>

    
    @if($sEdit)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-6 w-110">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='editar'>
                        <div class="mb-4"><span>Editar caseta:</span></div>
                        <div>
                        <x-label class="w-full" for="number" value="Numero de la caseta"/>
                        <x-input class="w-full" type="number" name="number" wire:model='standEdit.number'/><br>
                        </div>

                        <div>
                            <x-label class="w-full" for="cluster_id" value="Cluster"/>
                                <select wire:model='standEdit.cluster_id' class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                                <option value="" disabled> Seleccione un cluster</option>
                                    @foreach($clusters as $cluster)
                                        <option value="{{$cluster->id}}">{{$cluster->name}}</option>
                                    @endforeach
                                </select>  <br>
                            
                        <br>

                        <div class="flex items-center space-x-4">
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('sEdit', false)">Cancelar</button>
                            <br>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                        </div>
                    </form>
                </div>
        </div>
    @endif

    @if($sAdd)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-6 w-110">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='enviar'>
                        <div class="mb-4"><span>Crear nueva caseta</span></div>
                        <div class="mb-4 ml-4">
                            <div>
                                <x-label class="w-full" for="number" value='Numero de caseta'/>
                                <x-input class="w-full" type="number" for="number" wire:model='number' class="w-full"/><br>
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
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('sAdd', false)">Cancelar</button>
                                <br>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="set('sAdd', false)">Agregar</button>
                                
                            </div>
                        </div>
                    
                    </form>
                </div>
        </div>

    @endif
    
</div>
