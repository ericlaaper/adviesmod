<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreKlantensRequest extends FormRequest
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
            'voornaam' => 'min:3|max:15|required',
            'achternaam' => 'min:2|max:50|required',
            'email' => 'required|email|unique:klantens,email',
            'password' => 'min:7|max:100|required',
            'naam_id' => 'required',
            'geslacht' => 'required',
        ];
    }
}
