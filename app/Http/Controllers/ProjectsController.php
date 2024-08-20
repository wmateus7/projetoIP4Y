<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectsRequest;
use App\Models\Projects;
use App\Models\Tasks;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class ProjectsController extends Controller
{
    public function index()
    {
        //Todos os projetos listados
        $projects = Projects::orderBy('created_at', 'DESC')->paginate(10);
        return view('projects.index', ['projects' => $projects]);
    }

    public function showUsers(Projects $project){
         //Está chamando os dados da task t
            //selecionando os usuários u e sua descrição da tarefa
            $taskSelected = DB::table('tasks AS t')
                ->leftJoin('users AS u', 'u.id', '=', 't.user_id')
                ->select('t.project_id AS project', 'u.name AS userName', 't.title As titleTask')
                ->where('t.project_id', $project->id)
                ->get();
        return view('projects.showUsers', ['users'=>$taskSelected, 'project'=>$project]);
    }

    public function create()
    {
        //Chamando tela para cadastro
        return (view('projects.create'));
    }

    public function store(ProjectsRequest $request)
    {
        //Validação dos campos
        $request->validated();
        //Iniciando o POST
        DB::beginTransaction();
        try {
            Projects::create([
                'title' => $request->title,
                'description' => $request->description,
                'completionDate' => $request->completionDate
            ]);
            //Se deu certo, faz o commit e rediredciona para a página listar com a mensagem
            DB::commit();
            return redirect()->route('project.index')->with('success', 'Projeto criado com sucesso!');
        } catch (Exception $e) {
            //Em caso de erro, faz rollback, volta para o formulário com a mensagem e salva no arquivo LOG
            DB::rollBack();
            Log::warning('Erro ao cadastrar projeto', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Projeto não foi criado. Verifique os dados!');
        }
    }
    public function show(Projects $project)
    {
            $projectDetail = Projects::where('id', $project->id)->first();
            return view('projects.show', ['project' => $projectDetail]);
     
    }
    public function edit(Projects $project)
    {
        $projectDetail = Projects::where('id', $project->id)->first();
        return view('projects.edit', ['project' => $projectDetail]);
    }

    public function update(ProjectsRequest $request, Projects $project)
    {
        $request->validated();
        try {
            $project->update([
                'title' => $request->title,
                'description' => $request->description,
                'completionDate' => $request->completionDate
            ]);
            return redirect()->route('project.index')->with('success', 'Projeto alterado com sucesso!');
               } catch (Exception $e) {

            Log::warning('Erro ao alterar projeto', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Projeto não foi alterado. Verifique os dados!');
        }
    }
    public function destroy(Projects $project)
    {
        //Excluir registro
        try {
            $project->delete();
            return redirect()->route('task.index')->with('success', 'Projeto excluído com sucesso!');
        } catch (Exception $e) {

            Log::warning('Erro ao excluir projeto', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Erro: Projeto não foi excluído!');
        }
    }
}
