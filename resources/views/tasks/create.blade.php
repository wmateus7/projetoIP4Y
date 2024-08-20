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
                        <h1 class="mb-0">Cadastrar</h1>
                        <a href="{{ route('task.index') }}" class="btn btn-primary btn-sm">Listar</a>
                    </div>
                    <hr />
                    <div class="col-12">
                        <x-alert/>
                    </div>
                    <form action="{{route('task.store')}}" method="POST" enctype="multipart/form-data">
                      
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
                                <label for="title" class="font-bold mt-3">Titulo da tarefa</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('name') }}" />
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="project_id" class="font-bold mt-3">Vinculado ao projeto</label>

                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="" disabled selected>Selecione</option>
                                    @forelse ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }} </option>
                                    @empty
                                        <option value="" disabled selected>Não possui registros</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="description" class="font-bold mt-3">Descrição</label>
                                <textarea class="form-control" cols="4" value="{{ old('name') }}" id="description" name="description"></textarea>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="status_id" class="font-bold mt-3">Status</label>

                                <select name="status_id" id="status_id" class="form-control">
                                    <option value="" disabled selected>Selecione</option>
                                    @forelse ($selectStatus as $status)
                                        <option value="{{ $status->id }}">{{ $status->description }} </option>
                                    @empty
                                        <option value="" disabled selected>Não possui registros</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="user_id" class="font-bold mt-3">Usuário responsável</label>

                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" disabled selected>Selecione</option>
                                    @forelse ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} </option>
                                    @empty
                                        <option value="" disabled selected>Não possui registros</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12">
                               <label for="expiredDate" class="font-bold mt-3">Data do vencimento</label> 
                               <input class="form-control mt-2" type="date" id="expiredDate" name="expiredDate" value="{{old('expiredDate')}}"/>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success mt-4 md:w-28 lg:w-28 w-full">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
