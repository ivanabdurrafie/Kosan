<?php

namespace App\Http\Requests;

use App\Models\Room;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRoomRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('room_create');
    }

    public function rules()
    {
        return [
            'name'        => [
                'string',
                'required',
            ],
            'property_id' => [
                'required',
                'integer',
            ],
            'capacity'    => [
                'string',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'price'       => [
                'numeric',
                'required',
            ],
            'stock'       => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}