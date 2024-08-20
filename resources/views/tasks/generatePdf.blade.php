<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório</title>
</head>

<body style="font-size: 12px;">
    <h2 style="text-align: center">Relatório</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th class="d-none d-md-table-cell">ID</th>
                <th>Titulo</th>
                <th>Status</th>
                <th class="d-none d-md-table-cell">Expira em:</th>
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

                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma tarefa encontrado!</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</body>

</html>
