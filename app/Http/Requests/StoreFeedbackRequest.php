<?php

namespace App\Http\Requests;

use App\Models\Feedback;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feedback_create');
    }

    public function rules()
    {
        return [
            'user_id'        => [
                'required',
                'integer',
            ],
            'transaction_id' => [
                'required',
                'integer',
            ],
            'rating'         => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}