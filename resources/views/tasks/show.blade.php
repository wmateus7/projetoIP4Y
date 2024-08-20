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
                        <a href="{{ route('task.index')}}" class="btn btn-primary sm">Listar</a>
                         <a href="{{ route('task.edit',['task'=> $task->id])}}" class="btn btn-warning sm">Editar</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <x-alert/>
                    </div>
                    <dl class="row">
                        <dt class="col-sm-2">ID</dt>
                        <dd class="col-sm-9">{{ $task->id }}</dd>
    
                        <dt class="col-sm-2">Descrição</dt>
                        <dd class="col-sm-9">{{ $task->description }}</dd>
    
                        <dt class="col-sm-2">Status</dt>
                        <dd class="col-sm-9">{{ $task->statusDescr }}</dd>

                        <dt class="col-sm-2">Usuário responsável</dt>
                        <dd class="col-sm-9">{{ $task->userName }}</dd>

                        <dt class="col-sm-2">Projeto vinculado</dt>
                        <dd class="col-sm-9">{{ $task->titleProject }}</dd>

                        <dt class="col-sm-2">Expira em:</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($task->expiredDate)->format('d/m/Y H:i:s') }}</dd>
    
    
                        <dt class="col-sm-2">Cadastrado em:</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i:s') }}</dd>
    
                        <dt class="col-sm-2">Alterado em:</dt>
                        <dd class="col-sm-9"> {{ \Carbon\Carbon::parse($task->updated_at)->format('d/m/Y H:i:s') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
