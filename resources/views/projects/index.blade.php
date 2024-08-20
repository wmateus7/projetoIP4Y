
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-chalkboard-user mr-2"></i>    {{ __('Projetos / Admin') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-end">
                        <a href="{{ route('project.create')}}" class="btn btn-primary sm mb-4">Cadastrar</a>
                    </div>
                    <div class="col-12">
                        <x-alert/>
                    </div>
                 
                    <table class="table  table-striped table-hover table-bordered">
                        <thead >
                            <tr>
                                <th class="d-none d-md-table-cell">ID</th>
                                <th>Titulo</th>
                                <th class="d-none d-md-table-cell">Expira em:</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                            <tr>
                                <td class="align-middle d-none d-md-table-cell">{{$project->id}}</td>
                                <td class="align-middle">{{$project->title}}</td>
                                <td class="align-middle d-none d-md-table-cell">{{\Carbon\Carbon::parse($project->completionDate)->format('d/m/Y H:i')}}</td>
                                <td class="align-middle">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('project.show', ['project'=>$project->id]) }}" type="button" class="btn btn-secondary btn-sm me-1">Visualizar</a>
                                    <a href="{{ route('project.edit', ['project'=>$project->id]) }}" type="button" class="btn btn-primary btn-sm me-1">Alterar</a>
                                    <a href="{{ route('project.showUsers', ['project'=>$project->id]) }}" type="button" class="btn btn-info btn-sm me-1">Colaboradores</a>
                                   
                                    <form action="{{ route('project.destroy', ['project' => $project->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm me-1" type="submit" onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</button>
                                    </form>
                                </div>    
                                </td> 
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
