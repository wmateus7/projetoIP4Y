
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-chalkboard-user mr-2"></i>    {{ __('Projetos ') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-between">
                        <h1 class="mb-0">Usuários vinculados ao projeto: {{$project->title}}</h1>
                        <a href="{{ route('project.index')}}" class="btn btn-primary sm mb-4">Listar</a>
                    </div>
                    <div class="col-12">
                        <x-alert/>
                    </div>
                    <table class="table  table-striped table-hover table-bordered">
                        <thead >
                            <tr>
                                <th>Nome</th>
                                <th>Tarefa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td class="align-middle">{{$user->userName}}</td>
                                <td class="align-middle">{{$user->titleTask}}</td>
                            </tr> 
                            @empty
                            <td class="align-middle"><p style="color:red">Nenhum projeto cadastrado</p></td>
                            @endforelse 
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

