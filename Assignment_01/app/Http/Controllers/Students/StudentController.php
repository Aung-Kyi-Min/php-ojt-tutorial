<?php

namespace App\Http\Controllers\Students;
use App\Contracts\Services\StudentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Models\Major;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{


    private $studentService;

    public function __construct(StudentServiceInterface $studentServiceInterface) {
        $this->studentService = $studentServiceInterface;
    }

    public function index(){
        $students = $this->studentService->getStudents();
        //$majors = Major::select('id', 'name')->get();
        $students = Student::with('major')->get();

        return view('students.index', ['students' => $students]);
    }

    public function create(){
        $majors = Major::select('id', 'name')->get();
        return view('Students.create', compact('majors'));
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

        return view('Students.edit',compact('student','majors','students'));
    }


    public function update(StudentUpdateRequest $request , $id){
        $this->studentService->updateStudent($request->only([
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]), $id);

        return redirect()->route('students.index')->with('message','Student updated Successfully...');
    }

    public function destroy($id){
        $this->studentService->deleteStudentById($id);
        return response()->json(['status'=>'Student data deleted successfully...']);
    }
}
