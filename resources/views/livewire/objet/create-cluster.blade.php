<div>


    <x-button class="blue-600 m-4" wire:click='agregar()'>Crear nuevo condominio</x-button>

    <input wire:model.live='buscar' type="text" class="form-control" placeholder="Buscar por nombre...">

    <div class="d-flex justify-content-end mb-4">
        <x-button class="blue-600 m-4" wire:click="generarReportePDFCluster">Generar Reporte PDF</x-button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre del condominio
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
        <div class="d-flex justify-content-center">
            {{ $clusters->links() }}
        </div>
    </div>

    
    @if($cEdit)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-6 w-110">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='editar'>
                        <div class="mb-4"><span>Editar condominio:</span></div>
                        <div>
                        <x-label class="w-full" for="name" value="Nombre del condominio"/>
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
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-white shadow rounded-lg p-6 w-110">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='enviar'>
                        <div class="mb-4"><span>Crear nuevo condominio</span></div>
                        <div class="mb-4 ml-4">
                            <div>
                                <x-label class="w-full" value="Nombre del condominio"/>
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
        </div>

    @endif

    @if($reportClust)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
        <div class="bg-white shadow rounded-lg p-6 w-96">
            <x-label for="cluster_id" value="Seleccionar condominio para Reporte PDF" />
            
            <select wire:model="selectedClusterId" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" fill="none" viewBox="0 0 10 6">
                <option value="" disabled>Seleccione un consominio</option>
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
