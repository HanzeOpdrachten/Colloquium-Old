<?php
/**
 * UpdateProfileRequest
 * @author       Robert
 */
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Auth;

/**
 * Class UpdateProfileRequest
 * @package App\Http\Requests
 */
class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'current_pw' => 'required|min:6|max:255',
            'new_password' => 'min:6|confirmed|max:255'
        ];
    }
}