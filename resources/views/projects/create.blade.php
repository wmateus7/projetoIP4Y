<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projetos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-between">
                        <h1 class="mb-0">Cadastrar</h1>
                        <a href="{{ route('project.index') }}" class="btn btn-primary btn-sm">Listar</a>
                    </div>
                    <hr />
                    <div class="col-12">
                        <x-alert/>
                    </div>
                    <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                      
                        @csrf

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="title" class="font-bold mt-3">Titulo do projeto</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}" />
                            </div>
                            <div class="col-12">
                                <label for="description" class="font-bold mt-3">Descrição</label>
                                <textarea class="form-control" cols="4" value="{{ old('title') }}" id="description" name="description"></textarea>
                            </div>
                            <div class="col-md-4 col-sm-12">
                               <label for="completionDate" class="font-bold mt-3">Data do conclusão</label> 
                               <input class="form-control mt-2" type="date" id="completionDate" name="completionDate" value="{{old('completionDate')}}"/>
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
