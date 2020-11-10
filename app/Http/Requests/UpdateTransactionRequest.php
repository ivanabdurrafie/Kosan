<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('transaction_edit');
    }

    public function rules()
    {
        return [
            'user_id'   => [
                'required',
                'integer',
            ],
            'room_id'   => [
                'required',
                'integer',
            ],
            'check_in'  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'check_out' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}