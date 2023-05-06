<?php

namespace App\Http\Controllers\Students;

use App\Contracts\Services\StudentServiceInterface;
use App\Exports\ExportStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Imports\ImportStudent;
use App\Models\Major;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    private $studentService;

    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentService = $studentServiceInterface;
    }

    public function index()
    {
        $students = $this->studentService->getStudents();
        $student = Student::with('major')->get();

        return view('students.index', ['students' => $students, 'student' => $student]);
    }

    public function create()
    {
        $majors = Major::select('id', 'name')->get();
        return view('students.create', compact('majors'));
    }

    public function store(StudentCreateRequest $request)
    {
        $this->studentService->createStudent($request->only([
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]));

        if ($this->isOnline()) {

            $mail_data = [
                'recipient' => 'galaxyfighter1000@gmail.com',
                'fromEmail' => $request->email,
                'fromName' => $request->name,
                'subject' => 'Student Create ',
                'body' => 'U have created account successfully...',
            ];

            Mail::send('email_template', $mail_data, function ($message) use ($mail_data) {
                $message->from($mail_data['recipient'], $mail_data['fromName']);
                $message->to($mail_data['fromEmail']);
                $message->subject($mail_data['subject']);
            });

            return redirect()->route('students.index')->with('message', 'Student Created Successfully...');
        } else {
            return redirect()->route('students.index')->with('error', 'Check Your Connection...');
        }
    }

    public function edit($id)
    {
        $student = $this->studentService->getStudentById($id);
        $majors = Major::select('id', 'name')->get();
        $students = Student::with('major')->get();

        return view('students.edit', compact('student', 'majors', 'students'));
    }

    public function isOnline($site = "https://youtube.com/")
    {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        $this->studentService->updateStudent($request->only([
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]), $id);

        return redirect()->route('students.index')->with('message', 'Student Updated Successfully...');
    }

    public function destroy($id)
    {
        $this->studentService->deleteStudentById($id);
        return response()->json(['status' => 'Student data deleted successfully...']);
    }

    public function importView()
    {
        return view('students.upload');
    }

    public function import(Request $request)
    {
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
