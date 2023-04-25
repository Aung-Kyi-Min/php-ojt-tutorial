<?php
namespace App\Http\Controllers\Task;

use App\Contracts\Services\TaskServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;


/**
 * This is Task Controller.
 * This will handle task CRUD processing.
 */
class TaskController extends Controller
{
    /**
     * task interface
     */
    private $taskService;

    /**
     * Create a new controller instance.
     * @param TaskServiceInterface $taskServiceInterface
     * @return void
     */
    public function __construct(TaskServiceInterface $taskServiceInterface)
    {
        $this->taskService = $taskServiceInterface;
    }

    /**
     * Show task list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskService->getTasks();

        return view('tasks', compact('tasks'));
    }

    /**
     * Create task
     *
     * @return View create task
     */
    public function create()
    {
        return view('tasks');
    }

    /**
     * Save task
     *
     * @param \App\Http\Requests\TaskCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        $this->taskService->createTask($request->only([
            'name',
        ]));

        return redirect()->route('tasks.index')->with('message','Task Created Successfully...');
    }

    /**
     * Show task by id
     *
     * @return View create task
     */
    public function show($id)
    {
        $task = $this->taskService->getTaskById($id);

        return view('tasks.show', compact('task'));
    }


    /**
     * Delete task by id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->taskService->deleteTaskById($id);

        return response()->json(['status'=>'Student data deleted successfully...']);
    }
}
