<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'enseignement_id' => 'bail|required',
            'contrat_id' => 'bail|required',
            'session1' => 'bail|required',
            'cc' => 'bail|required',
            'session2' => 'bail|required'
        ];
    }
}
