<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestTask;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    protected $tasks;

    public function __construct(Task $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->tasks->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FormRequestTask  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequestTask $request)
    {
        $formData = $request->all();

        $task = [
            'description' => $formData['description'],
        ];

        return response()->json($this->tasks->create($task), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FormRequestTask  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRequestTask $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json($this->tasks->destroy($id), 200);
    }
}
