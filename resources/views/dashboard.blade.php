<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-house mr-2"></i>  {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
                    <div class="card" >
                        <div class="card-body">
                          <h5 class="card-title">Sistema de Gerenciamento de tarefas</h5>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
