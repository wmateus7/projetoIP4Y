<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Projects;
use App\Models\Status;
use App\Models\Tasks;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        //Capturado dados da tabela status em tasks e status para o combobox
        try {
            //dd($request);
            $status = Status::get();
            $tasks = Tasks::when($request->has('status_id'), function ($whenQuery)use($request){
                $whenQuery->where('status_id','=', $request->status_id);
            })
            ->when($request->filled('dateInit'), function ($whenQuery) use ($request){
                $whenQuery->where('expiredDate', '>=', \Carbon\Carbon::parse($request->dateInit)->format('Y-m-d'));
            })
            ->when($request->filled('dateEnd'), function ($whenQuery) use ($request){
                $whenQuery->where('expiredDate', '<=', \Carbon\Carbon::parse($request->dateEnd)->format('Y-m-d'));
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();
            
            return view('tasks.index', [
                'status_id'=>$request->status_id,
                'dateInit'=>$request->dateInit,
                'dateEnd'=>$request->dateEnd,
                "tasks" => $tasks, "status"=>$status]);
        } catch (Exception $e) {
            Log::warning('Erro ao listar tarefas', ['error' => $e->getMessage()]);
        }
    }
    public function create()
    {
        $status = Status::get();
        $users = User::get();
        $projects= Projects::get();
        return view('tasks.create', ['selectStatus' => $status, 'users'=>$users, 'projects'=>$projects]);
    }

    public function store(TasksRequest $request)
    {
        //Validação dos campos
        $request->validated();
        //Iniciando o POST
        DB::beginTransaction();
        try {
            Tasks::create([
                'title' => $request->title,
                'description' => $request->description,
                'status_id' => $request->status_id,
                'project_id' =>$request->project_id,
                'user_id' => $request->user_id,
                'expiredDate' => $request->expiredDate
            ]);
            //Se deu certo, faz o commit e rediredciona para a página listar com a mensagem
            DB::commit();
            return redirect()->route('task.index')->with('success', 'Tarefa cadastrada com sucesso!');
        } catch (Exception $e) {
            //Em caso de erro, faz rollback, volta para o formulário com a mensagem e salva no arquivo LOG
            DB::rollBack();
            Log::warning('Erro ao cadastrar tarefa', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Tarefa não foi cadastrada. Verifique os dados!');
        }
    }

    public function show(Tasks $task)
    {
        try {
            //Está chamando os dados da task t
            //encarregado da tarefa u
            //projeto que pertence p
            $taskSelected = DB::table('tasks AS t')
                ->leftJoin('status AS s', 's.id', '=', 't.status_id')
                ->leftJoin('users AS u', 'u.id', '=', 't.user_id')
                ->leftJoin('projects AS p', 'p.id', '=', 't.project_id')
                ->select('t.id', 't.title', 't.description', 't.expiredDate', 
                            't.status_id', 't.created_at', 't.updated_at', 
                            's.description AS statusDescr', 'u.name AS userName',
                            'p.title AS titleProject')
                ->where('t.id', $task->id)
                ->first();
            return view('tasks.show', ['task' => $taskSelected]);
        } catch (Exception $e) {
            Log::warning('Erro ao listar tarefas', ['error' => $e->getMessage()]);
        }
    }

    public function edit(Tasks $task)
    {
        $statusSelected = Status::where('id', $task->id)->first();
        $status = Status::get();
        $projects= Projects::get();
        $projectsSelected = Projects::where('id', $task->project_id)->first();
        $users= User::get();
        $usersSelected = User::where('id', $task->user_id)->first();

        return view('tasks.edit', [
            'task' => $task,
            'selectStatus' => $status,
            'statusSelected' => $statusSelected,
            'projects'=>$projects,
            'projectsSelected' => $projectsSelected,
            'users'=>$users,
            'usersSelected' => $usersSelected,]);
    }

    public function update(TasksRequest $request, Tasks $task)
    {
        $request->validated();
        try {
            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status_id' => $request->status_id,
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'expiredDate' => $request->expiredDate
            ]);
            return redirect()->route('task.index')->with('success', 'Tarefa alterada com sucesso!');
        } catch (Exception $e) {

            Log::warning('Erro ao alterar tarefa', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Tarefa não foi alterada. Verifique os dados!');
        }
    }
    public function destroy(Tasks $task)
    {
        //Excluir registro
        try {
            $task->delete();
            return redirect()->route('task.index')->with('success', 'Tarefa excluída com sucesso!');
        } catch (Exception $e) {

            Log::warning('Erro ao alterar tarefa', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Tarefa não foi alterada. Verifique os dados!');
        }
    }

    public function generatePdf(Request $request)
    {
          // Recuperar os registros do banco dados

        // Recuperar e pesquisar os registros do banco dados
        $tasks = Tasks::when($request->has('status_id'), function ($whenQuery)use($request){
            $whenQuery->where('status_id','=', $request->status_id);
        })
        ->when($request->filled('dateInit'), function ($whenQuery) use ($request){
            $whenQuery->where('expiredDate', '>=', \Carbon\Carbon::parse($request->dateInit)->format('Y-m-d'));
        })
        ->when($request->filled('dateEnd'), function ($whenQuery) use ($request){
            $whenQuery->where('expiredDate', '<=', \Carbon\Carbon::parse($request->dateEnd)->format('Y-m-d'));
        })
        ->orderByDesc('created_at')
        ->get();

        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = PDF::loadView('tasks.generatePdf', ['tasks' => $tasks])->setPaper('a4', 'portrait');

        // Fazer o download do arquivo
        return $pdf->download('report.pdf');
    }
}
