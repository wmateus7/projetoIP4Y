<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tarefas') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-between">
                        <div>
                        <h1 class="mb-0">Detalhes</h1>
                    </div>
                    <div>
                        <a href="{{ route('project.index')}}" class="btn btn-primary sm">Listar</a>
                         <a href="{{  route('project.edit', ['project'=>$project->id]) }}" class="btn btn-warning sm">Editar</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <x-alert/>
                    </div>
                    <dl class="row">
                        <dt class="col-sm-2">ID</dt>
                        <dd class="col-sm-9">{{ $project->id }}</dd>
    
                        <dt class="col-sm-2">Descrição</dt>
                        <dd class="col-sm-9">{{ $project->description }}</dd>

                        <dt class="col-sm-2">Conclusão em:</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($project->completionDate)->format('d/m/Y H:i:s') }}</dd>
    
    
                        <dt class="col-sm-2">Cadastrado em:</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($project->created_at)->format('d/m/Y H:i:s') }}</dd>
    
                        <dt class="col-sm-2">Alterado em:</dt>
                        <dd class="col-sm-9"> {{ \Carbon\Carbon::parse($project->updated_at)->format('d/m/Y H:i:s') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

