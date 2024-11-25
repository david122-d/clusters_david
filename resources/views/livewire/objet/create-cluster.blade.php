<div>


    <x-button class="blue-600 m-4" wire:click='agregar()'>Crear nuevo cluster</x-button>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre del cluster
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>

            @foreach($clusters as $cluster)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$cluster->name}}
                    </th>
        
                    <td class="px-6 py-4">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click='update({{$cluster->id}})'>Editar</a>
                        <div></div>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click='eliminar({{$cluster->id}})'>Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    
    @if($cEdit)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="mb-12">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='editar'>
                        <div class="mb-4"><span>Editar Sucursal:</span></div>
                        <div>
                        <x-label class="w-full" for="name" value="Nombre del cluster"/>
                        <x-input class="w-full" name="name" wire:model='clusterEdit.name'/><br>
                        </div>
                        
                        <br>

                        <div class="flex items-center space-x-4">
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('cEdit', false)">Cancelar</button>
                            <br>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                        </div>
                    </form>
                </div>
        </div>
    @endif

    @if($cAdd)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="mb-12">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='enviar'>
                        <div class="mb-4"><span>Crear nuevo cluster</span></div>
                        <div class="mb-4 ml-4">
                            <div>
                                <x-label class="w-full" value="Nombre del cluster"/>
                                <x-input class="w-full" wire:model='name' required/><br>
                            </div>
                                
                                <br>
        
                            <div class="flex items-center space-x-4">
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" wire:click="set('cAdd', false)">Cancelar</button>
                                <br>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click="set('cAdd', false)">Agregar</button>
                                
                            </div>
                        </div>
                    
                    </form>
                </div>
        </div>

    @endif
    
</div>
