<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlayerRequest extends FormRequest
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
        $nameRules = [
            'required',
            'max:200',
        ];
        $player = $this->route()->parameter('player');
        if ($player) {
            $nameRules[] = Rule::unique('players')->ignore($player);
        } else {
            $nameRules[] = 'unique:players';
        }
        return [
            'name' => $nameRules
        ];
    }
}
