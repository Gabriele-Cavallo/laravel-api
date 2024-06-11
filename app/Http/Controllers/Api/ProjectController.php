<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with('type', 'technologies')->paginate(5);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug){
        $project = Project::where('slug', '=', $slug)->with('type', 'technologies')->first();

        $data = [
            'success' => false,
            'error' => 'No project with this slug'
        ];

        if($project){
            $data = [
                'success' => true,
                'project' => $project
            ];
        }

        return response()->json($data);
    }
}
