<?php

namespace Modules\Architect\Http\Requests\Tools\SiteList;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteListRequest extends FormRequest
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
            'name' => 'required',
            'identifier' => 'required',
        ];
    }
}
