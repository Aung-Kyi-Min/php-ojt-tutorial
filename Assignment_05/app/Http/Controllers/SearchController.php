<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Major;
//use Illuminate\Http\DB;
use Illuminate\Support\Facades\DB;
use App\Services\StudentService;
use App\Contracts\Services\StudentServiceInterface;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    function search(Request $request){

        $name = $request->input('search');

        $results = Student::query()
        ->with('major')
        ->where('name', 'LIKE', "%$name%")
        ->orWhere('majors','LIKE',"%$name%")
        ->orWhere('phone','LIKE',"%$name%")
        ->orWhere('email','LIKE',"%$name%")
        ->orWhere('address','LIKE',"%$name%")
        ->paginate(2);

        return view('Students.search', compact('results'));
    }
}
