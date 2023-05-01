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
use PDO;

use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{


    private $studentService;

    public function __construct(StudentServiceInterface $studentServiceInterface) {
        $this->studentService = $studentServiceInterface;
    }

    public function index(){
        $students = $this->studentService->getStudents();
        $student = Student::with('major')->get();

        return view('students.index', ['students' => $students, 'student' => $student]);
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

        if($this->isOnline()){

            $mail_data = [
                'recipient' => 'galaxyfighter1000@gmail.com',
                'fromEmail' => $request->email,
                'fromName' => $request->name,
                'subject' => 'Student Create ',
                'body' => 'U have created account successfully...'
            ];

            Mail::send('email_template', $mail_data, function ($message) use ($mail_data) {
                $message->from($mail_data['recipient'], $mail_data['fromName']);
                $message->to($mail_data['fromEmail']);
                $message->subject($mail_data['subject']);
            });

            return redirect()->route('students.index')->with('message','Student Created Successfully...');

        }else{
            return redirect()->route('students.index')->with('error','Check Your Connection...');
        }
    }

    public function edit($id){
        $student = $this->studentService->getStudentById($id);
        $majors = Major::select('id', 'name')->get();
        $students = Student::with('major')->get();

        return view('Students.edit',compact('student','majors','students'));
    }

    public function isOnline($site = "https://youtube.com/"){
        if(@fopen($site,"r")){
            return true;
        }else {
            return false;
        }
    }


    public function update(StudentUpdateRequest $request , $id){
        $this->studentService->updateStudent($request->only([
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]), $id);

        return redirect()->route('stundents.index')->with('message','Student Updated Successfully...');
    }

    public function destroy($id){
        $this->studentService->deleteStudentById($id);
        return response()->json(['status'=>'Student data deleted successfully...']);
    }


    public function importView(){
        return view('Students.upload');
    }

    public function import(Request $request){
        Excel::import(new ImportStudent, $request->file('file')->store('files'));
        return redirect()->back()->with('message','File Imported Successfully...');
    }

public function exportStudents()
{
    $StudentData = Student::with('major')->get();

    $headers = [
        'Content-Type' => 'student/csv',
        'Content-Disposition' => 'attachment; filename="students.csv"',
    ];

    return response()->streamDownload(function () use ($StudentData) {
        $handle = fopen('php://output', 'w');

        fputcsv($handle, [
            'ID',
            'name',
            'majors',
            'phone',
            'email',
            'address',
        ]);

        foreach ($StudentData as $row) {
            fputcsv($handle, [
                $row->id,
                $row->name,
                $row->major->name,
                $row->phone,
                $row->email,
                $row->address,
            ]);
        }

        fclose($handle);
    }, 200, $headers);
}

}
