<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <div class="d-flex justify-content-end mb-4">
            <input wire:model.live='buscar' type="text" class="form-control" placeholder="Buscar por nombre...">
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Turno
                    </th>
                    <th scope="col" class="px-6 py-3">
                        acción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Condominio
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Caseta
                    </th>
                
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>

            @foreach($users as $user)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$user->name}} {{$user->last_name}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$user->turn}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$user->action}}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->cluster->name ?? 'No asignado' }}
                    </th>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->stand->number ?? 'No asignado' }}
                    </th>

                    <td class="px-6 py-4">
                        <div></div>
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click='eliminar({{$user->id}})'>Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
