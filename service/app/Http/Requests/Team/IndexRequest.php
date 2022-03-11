<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules()
    {
        return [
            'number_of_teams' => ['sometimes', 'numeric']
        ];
    }
}
