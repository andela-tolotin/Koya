<?php

namespace Koya\Http\Requests;

use Koya\Http\Requests\Request;

class CommentsRequest extends Request
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
            'comment' => 'required',
            'video_id' => 'required'
        ];
    }
}
