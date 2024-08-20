<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>'required',
            'description' =>'required',
            'status_id' =>'required',
            'project_id' =>'required',
            'user_id' =>'required',
            'expiredDate' =>'required'
        ];
    }
    public function messages():array
    {
        return[
            'title.required'=>'Campo título é obrigatório.',
            'description.required'=>'Obrigatório a descrição da tarefa.',
            'status_id.required'=>'Selecione um status para a tarefa.',
            'project_id.required'=>'Selecione um projeto para vínculo.',
            'user_id.required'=>'Selecione um usuário para a tarefa.',
            'expiredDate'=>'Digite uma data de expiração da tarefa.'
        ];
    }
}
