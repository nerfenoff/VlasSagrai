<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostData;
use App\Models\Selected_specialization;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(Request $request) {

        $page = $request->input('page');
        $selectedSpecialization = $request->input('selectedSpecialization');
        
        $selectedEducation_level = $request->input('selectedEducation_level');
        $selectedCity = $request->input('selectedCity');
        $selectedEducational_institution = $request->input('selectedEducational_institution');
        $selectedForm_of_education = $request->input('selectedForm_of_education');
        $barrierFree = $request->input('barrierFree');        

        $posts = new PostData();
        if($selectedEducation_level && $selectedEducation_level != -1) {
            $posts = $posts->where('education_level', $selectedEducation_level);
        }
        if($selectedCity && $selectedCity != -1) {
            $posts = $posts->where('city', $selectedCity);
        }
        if($selectedEducational_institution && $selectedEducational_institution != -1) {
            $posts = $posts->where('educational_institution', $selectedEducational_institution);
        }
        if($selectedForm_of_education && $selectedForm_of_education != -1) {
            $posts = $posts->where('form_of_education', $selectedForm_of_education);
        }

        if($barrierFree && $barrierFree != -1 && $barrierFree != 'false') {
            $posts = $posts->where('the_presence_of_a_barrier_free_environment', $barrierFree);
        }

        $perPage = 5;
        $posts = $posts->paginate($perPage, ['*'], 'page', $page);
        
        $pages = ceil($posts->total() / $perPage);
        $posts = PostsResource::collection($posts);
        // $pages = 2;
        return response()->json([
            'data' => $posts,
            'pages' => $pages
        ]);
    }

    public function singlePost(Request $request) {
        $id = $request->input('id');
        $post = PostData::join('posts', 'posts.id', '=', 'posts_data.post_data_id')->where('posts_data.id', $id)->first();
        
        $selected_specializations = Selected_specialization::where('post_data_id', $post->post_data_id)->get();
        $post->selected_specializations = $selected_specializations;
        
        // post_data_id
        // dd($post);
        return response()->json($post);
    }
}
