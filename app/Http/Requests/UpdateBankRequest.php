<?php

namespace App\Http\Requests;

use App\Models\Bank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_edit');
    }

    public function rules()
    {
        return [
            'property_id' => [
                'required',
                'integer',
            ],
            'number'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'name'        => [
                'required',
            ],
            'cardholder'  => [
                'string',
                'required',
            ],
        ];
    }
}