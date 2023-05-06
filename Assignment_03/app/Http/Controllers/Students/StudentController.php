<?php

namespace App\Http\Controllers\Students;
use App\Contracts\Services\StudentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\StudentImportRequest;
use App\Models\Student;
use App\Models\Major;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStudent;
use Illuminate\Http\Request;
use App\Exports\ExportStudent;
use App\Models\User;
use GuzzleHttp\Psr7\Message;

class StudentController extends Controller
{


    private $studentService;

    public function __construct(StudentServiceInterface $studentServiceInterface) {
        $this->studentService = $studentServiceInterface;
    }

    public function index(){
        $students = $this->studentService->getStudents();
        $student = Student::with('major')->get();

        return view('students.index', ['students' => $students, 'student' => $student]);    }

    public function create(){
        $majors = Major::select('id', 'name')->get();
        return view('students.create', compact('majors'));
    }

    public function store(StudentCreateRequest $request){
        $this->studentService->createStudent($request->only([
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]));

        return redirect()->route('students.index')->with('message','Student Created Successfully...');
    }

    public function edit($id){
        $student = $this->studentService->getStudentById($id);
        $majors = Major::select('id', 'name')->get();
        $students = Student::with('major')->get();

        return view('students.edit',compact('student','majors','students'));
    }


    public function update(StudentUpdateRequest $request , $id){
        $this->studentService->updateStudent($request->only([
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]), $id);

        return redirect()->route('students.index')->with('message','Student Updated Successfully...');
    }

    public function destroy($id){
        $this->studentService->deleteStudentById($id);
        return response()->json(['status'=>'Student data deleted successfully...']);
    }


    public function importView(){
        return view('students.upload');
    }

    public function import(Request $request){
        Excel::import(new ImportStudent, $request->file);
        return redirect()->back()->with('message', 'File Imported Successfully...');
    }

    public function exportStudents()
    {
        return Excel::download(new ExportStudent(), 'students.xlsx');
    }

    public function search(Request $request){

        $name = $request->input('search');

        if($name == ''){
            $results = [];
            return view('students.search',compact('results'));

        }else {

        $results = DB::table('students')
                ->select('students.id','students.name','students.phone','students.email','students.address','majors.name as major')
                ->join(DB::raw('majors'), 'majors.id', '=', 'students.majors')
                ->where('students.name', 'LIKE', "%$name%")
                ->orWhere('majors.name','LIKE',"%$name%")
                ->orWhere('students.phone','LIKE',"%$name%")
                ->orWhere('students.email','LIKE',"%$name%")
                ->orWhere('students.address','LIKE',"%$name%")

                ->paginate(3);

        return view('students.search', compact('results'));

    }

}

}
