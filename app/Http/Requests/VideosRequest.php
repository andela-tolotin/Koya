<?php

namespace Koya\Http\Requests;

class VideosRequest extends Request
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
            'youtubeID'   => ['required'],
            'title'       => ['required'],
            'description' => ['required'],
            'category'    => ['required'],
        ];
    }
}
