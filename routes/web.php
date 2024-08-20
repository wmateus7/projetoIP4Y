<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::get("/", [AuthenticatedSessionController::class, 'create'])->name('auth.login');
   
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function () {
   //Tasks
    //Listar todos as tarefas
    Route::get("/index-tasks", [TasksController::class, 'index'])->name('task.index');
    //Exibir tela detalhes da tarefa
    Route::get("/show-task/{task}", [TasksController::class, 'show'])->name('task.show');
    //Exibir tela criação da tarefa
    Route::get("/create-task", [TasksController::class, 'create'])->name('task.create');
    //Ação do cadastro da tarefa
    Route::post("/store-task", [TasksController::class, 'store'])->name('task.store');
    //Exibir tela alterar da tarefas
    Route::get("/edit-task/{task}", [TasksController::class, 'edit'])->name('task.edit');
    
    //Ação da alteração da tarefa
    Route::put("/update-task/{task}", [TasksController::class, 'update'])->name('task.update');
    //Exclusão de uma tarefa
    Route::delete("/destroy-task/{task}", [TasksController::class, 'destroy'])->name('task.destroy');
        //Gerar PDF
        Route::get("/generate-pdf", [TasksController::class, 'generatePdf'])->name('task.generatePdf');

    //Projects
    //Listar todos os projetos
    Route::get("/index-projects", [ProjectsController::class, 'index'])->name('project.index');
    //Exibir tela detalhes de um projeto
    Route::get("/show-project/{project}", [ProjectsController::class, 'show'])->name('project.show');
    //Exibir colaboradores de um projeto
    Route::get("/show-project-users/{project}", [ProjectsController::class, 'showUsers'])->name('project.showUsers');
    //Exibir tela criação de um projeto
    Route::get("/create-project", [ProjectsController::class, 'create'])->name('project.create');
    //Ação do cadastro de um projeto
    Route::post("/store-project", [ProjectsController::class, 'store'])->name('project.store');
    //Exibir tela alterar da tarefas
    Route::get("/edit-project/{project}", [ProjectsController::class, 'edit'])->name('project.edit');
    //Ação da alteração do projeto
    Route::put("/update-project/{project}", [ProjectsController::class, 'update'])->name('project.update');
    //Exclusão de um projeto
    Route::delete("/destroy-project/{project}", [ProjectsController::class, 'destroy'])->name('project.destroy');


});

require __DIR__ . '/auth.php';
