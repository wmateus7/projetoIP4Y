<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="fa-solid fa-list-check mr-2"></i> {{ __('Tarefas') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-end mb-4">

                        <a href="{{ route('task.create') }}" class="btn btn-primary sm">Cadastrar</a>

                    </div>
                    <div class="col-12">
                        <x-alert />
                    </div>
                    <div class=" mb-12 row">
                        <div class="col-sm-12">
                            <form>
                                <div class="row">
                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label" for="status_id">Status</label>
                                        <select name="status_id" id="status_id" class="form-control">
                                            <option value="" disabled selected>Selecione</option>
                                            @forelse ($status as $st)
                                                <option value="{{ $st->id }}">{{ $st->description }} </option>
                                            @empty
                                                <option value="" disabled selected>Não possui registros</option>
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label" for="dateInit">Data Início</label>
                                        <input type="date" class="form-control" name="dateInit" id="dateInit" />
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="form-label" for="dateEnd">Data Final</label>
                                        <input type="date" class="form-control" name="dateEnd" id="dateEnd" />
                                    </div>
                                    <div class="col-md-3 col-sm-12 mt-3 pt-3">
                                        <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
                                        <a href="#" class="btn btn-warning btn-sm">Limpar</a>
                                        <a href="{{ route('task.generatePdf') }}" class="btn btn-warning btn-sm">Gerar
                                            PDF</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div>

                </div>

                <table class="table  table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="d-none d-md-table-cell">ID</th>
                            <th>Titulo</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Expira em:</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td class="align-middle d-none d-md-table-cell">{{ $task->id }}</td>
                                <td class="align-middle">{{ $task->title }}</td>
                                <td class="align-middle">{{ $task->status_id }}</td>
                                <td class="align-middle d-none d-md-table-cell">
                                    {{ \Carbon\Carbon::parse($task->expiredDate)->format('d/m/Y') }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('task.show', ['task' => $task->id]) }}" type="button"
                                            class="btn btn-secondary btn-sm me-1">Visualizar</a>
                                        <a href="{{ route('task.edit', ['task' => $task->id]) }}" type="button"
                                            class="btn btn-primary btn-sm me-1">Alterar</a>
                                        <form action="{{ route('task.destroy', ['task' => $task->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm me-1" type="submit"
                                                onclick="return confirm('Deseja realmente excluir este registro?')">Excluir</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="align-middle">
                                <p style="color:red">Nenhuma tarefa cadastrada</p>
                            </td>
                        @endforelse

                    </tbody>
                </table>

                {{-- {{$tasks->link()}}  --}}
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
