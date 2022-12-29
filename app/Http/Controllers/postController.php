<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostData;
use App\Models\Selected_specialization;
use App\Models\Selected_special_need;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(Request $request) {

        $page = $request->input('page');
        $selectedSpecialization = $request->input('selectedSpecialization');
        $selectedSpecial_need = $request->input('selectedSpecial_need');

        $selectedEducation_level = $request->input('selectedEducation_level');
        $selectedCity = $request->input('selectedCity');
        $selectedEducational_institution = $request->input('selectedEducational_institution');
        $selectedForm_of_education = $request->input('selectedForm_of_education');
        $barrierFree = $request->input('barrierFree');        

        $posts = new PostData();

        if($selectedSpecial_need && $selectedSpecial_need != -1) {
            $selectedSpecial_need = Selected_special_need::where('special_needs_id', $selectedSpecial_need)->pluck('post_data_id')->toArray();
            $posts = $posts->whereIn('post_data_id', $selectedSpecial_need);
        }
        if($selectedSpecialization && $selectedSpecialization != -1) {
            $selectedSpecialization = Selected_specialization::where('specialization_id', $selectedSpecialization)->pluck('post_data_id')->toArray();
            $posts = $posts->whereIn('post_data_id', $selectedSpecialization);
        }


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

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'imgUrl' => 'required',
            'address' => 'required',
            'coords' => 'required',

            'selectedSpecialization' => 'required',
            'selectedEducation_level' => 'required',
            'selectedCity' => 'required',
            'selectedEducational_institution' => 'required',
            'selectedForm_of_education' => 'required',
            'selectedSpecial_need' => 'required',
            'barrierFree' => 'required',
        ]);
        $input = $request->all();
        
        $createdPost = Post::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'content' => $input['content'],
        ]);
        $postId = $createdPost->id;

        PostData::create([
            'post_data_id' => $postId,

            'image' => $input['imgUrl'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'coords' => $input['coords'],
            'education_level' => $input['selectedEducation_level'],
            'city' => $input['selectedCity'],
            'educational_institution' => $input['selectedEducational_institution'],
            'form_of_education' => $input['selectedForm_of_education'],
            'the_presence_of_a_barrier_free_environment' => $input['barrierFree'] === true || $input['barrierFree'] == 'true',
        ]);

        foreach($input['selectedSpecialization'] as $selectedSpecialization) {
            Selected_specialization::create([
                'post_data_id' => $postId,
                'specialization_id' => $selectedSpecialization
            ]);
        }
        foreach($input['selectedSpecial_need'] as $selectedSpecial_need) {
            Selected_special_need::create([
                'post_data_id' => $postId,
                'special_needs_id' => $selectedSpecial_need
            ]);
        }
        return response()->json(true);
    }
}
