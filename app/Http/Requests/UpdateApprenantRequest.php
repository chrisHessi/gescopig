<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Apprenant;

class UpdateApprenantRequest extends FormRequest
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
            'nom' => 'bail|required|max:250',
            'prenom' => 'bail|required|max:250',
            'sexe' => 'bail|required|max:25',
            'tel' => 'bail|required',
            'dateNaissance' => 'date',
            'lieuNaissance' => 'bail|required',
            'nationalite' => 'bail|required',
            'region' => 'bail|required',
            'civilite' => 'bail|required',
            'email' => 'bail|required|email',
            'quartier' => 'bail|required',
            'diplome' => 'bail|required',
            'situation_professionnelle' => 'bail|required',
            'addresse' => '',
            'etablissement_provenance' => 'bail|required',
        ];
    }
}
