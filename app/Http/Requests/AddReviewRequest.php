<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddReviewRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'advertisement_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'score' => 'required|integer|max:5',
            'name' => Auth::check() ? 'nullable' : 'required|string|max:255',
        ];
    }
}
