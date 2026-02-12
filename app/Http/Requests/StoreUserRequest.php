<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreUserRequest extends FormRequest
// {
//     public function authorize(): bool
//     {
//         return true;
//     }

//     public function rules(): array
//     {
//         return [
//             'name'    => 'required|string|max:255',
//             'email'   => 'required|email|unique:users,email',
//             'mobile'  => 'required|digits:10|unique:users,mobile',
//             'role_id' => 'required|exists:roles,id',
//         ];
//     }
// }

 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Status;
 
class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
 
public function rules(): array
{
    return [
        'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z]+(?: [A-Za-z]+)*$/'],
        'email' => ['required', 'email', 'regex:/^[\w._%+-]+@gmail\.com$/i', 'unique:users,email'],
        'mobile' => ['required', 'digits:10', 'regex:/^[6-9][0-9]{9}$/'],
        // 'status' => ['sometimes', Rule::in(array_column(Status::cases(), 'value'))],
    ];
}
 
 
}
