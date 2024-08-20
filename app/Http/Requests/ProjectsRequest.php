<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
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
                'completionDate' =>'required'
            ];
        }
        public function messages():array
        {
            return[
                'title.required'=>'Campo título é obrigatório.',
                'description.required'=>'Obrigatório a descrição do projeto.',
                'completionDateDate'=>'Digite uma data de conclusão do projeto.'
            ];
        }
}
