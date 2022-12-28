<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Education_level;
use App\Models\Educational_institution;
use App\Models\Form_of_education;
use App\Models\Specializations;


class characteristicsController extends Controller
{
    public function index() {
        $city = City::all();
        $education_level = Education_level::all();
        $educational_institution = Educational_institution::all();
        $form_of_education = Form_of_education::all();
        $specializations = Specializations::all();
        

        return json_encode(
            [
                'education_levels' => $education_level,
                'citys' => $city,
                'educational_institutions' => $educational_institution,
                'form_of_educations' => $form_of_education,
                'specializations' => $specializations
            ]
        );
    }
}
