<?php

namespace App\Http\Controllers\Majors;
use App\Contracts\Services\MajorServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\MajorCreateRequest;
use App\Http\Requests\MajorUpdateRequest;

/**
 * This is major Controller.
 * This will handle major CRUD processing.
 */
class MajorController extends Controller
{
    /**
     * major interface
     */
    private $majorService;

    /**
     * Create a new controller instance.
     * @param majorServiceInterface $majorServiceInterface
     * @return void
     */
    public function __construct(MajorServiceInterface $majorServiceInterface)
    {
        $this->majorService = $majorServiceInterface;
    }

    /**
     * Show major list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $major = $this->majorService->getMajors();

        return view('majors.index', compact('major'));
    }

    /**
     * Create major
     *
     * @return View create major
     */
    public function create()
    {
        return view('majors.create');
    }

    /**
     * Save major
     *
     * @param \App\Http\Requests\majorCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajorCreateRequest $request)
    {

        $major = $this->majorService->createMajor($request->only([
            'name',
        ]));
        return response()->json(['major'=>$major,'msg' => 'Created Successfully...'],200);
    }

    /**
     * Edit major
     *
     * @param int $id post id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $major = $this->majorService->getMajorById($id);

        return view('majors.edit', compact('major'));
    }

    /**
     * Update major
     *
     * @param  \App\Http\Requests\majorCreateRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MajorUpdateRequest $request, $id)
    {
        $this->majorService->updateMajor($request->only([
            'name',
        ]), $id);

        return response()->json(['msg' => 'Update Success'],200);
    }

    /**
     * Delete major by id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->majorService->deleteMajorById($id);
        return response()->json(['status'=>'Student data deleted successfully...']);
    }
}
