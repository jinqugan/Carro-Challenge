<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\FormRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Factory as ValidationFactory;

class ReactionRequest extends FormRequest
{
    private $validationFactory;

    public function __construct(ValidationFactory $validationFactory)
    {
        $this->validationFactory = $validationFactory;
    }

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
            'post_id' => 'required|integer|exists:posts,id|author',
            'like' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'post_id.required' => trans('post.post_id_required'),
            'post_id.exists' => trans('post.post_not_found'),
            'post_id.author' => trans('post.cant_like_your_post'),
            'like.required' => trans('post.like_required'),
            'like.boolean' => trans('post.like_must_be_boolean'),
        ];
    }

    /**
     * Add custom validation rules
     */
    public function validationFactory()
    {
        $this->validationFactory->extend(
            'author',
            function ($attribute, $value, $parameters) {
                $post = Post::find($this->get('post_id'));

                if ($this->user()->id  == $post['author_id']) {
                    return false;
                }

                return true;
            },
            /** error msg handle here */
            ''
        );
    }
}
