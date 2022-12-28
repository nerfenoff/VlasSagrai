<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $post = Post::where('id', $this->post_data_id)->first();
        return [
            'id' => $this->id,
            'image' => $this->image,
            'phone' => $this->phone,
            'education_level' => $this->education_level,
            'city' => $this->city,
            'educational_institution' => $this->educational_institution,
            'the_presence_of_a_barrier_free_environment' => $this->the_presence_of_a_barrier_free_environment,
            'form_of_education' => $this->form_of_education,
            'address' => $this->address,
            'title' => $post->title,
            'description' => $post->description,
            'coords' => $this->coords
        ];
    }
}
