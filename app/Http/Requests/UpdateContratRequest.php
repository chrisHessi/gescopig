<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContratRequest extends FormRequest
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
            'apprenant_id' => 'bail|required|integer',
            'cycle_id' => 'bail|required|integer',
            'specialite_id' => 'bail|required|integer',
            'state' => 'bail|required'
        ];
    }
}
