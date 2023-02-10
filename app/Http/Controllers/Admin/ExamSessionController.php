<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Models\ExamSession;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get exam_sessions
        $exam_sessions = ExamSession::when(request()->q, function($exam_sessions) {
            $exam_sessions = $exam_sessions->where('title', 'like', '%'. request()->q . '%');
        })->with('exam.classroom', 'exam.lesson', 'exam_groups')->latest()->paginate(5);

        // append query string to pagination links
        $exam_sessions->appends(['q' => request()->q]);

        // render with inertia
        return inertia('Admin/ExamSessions/Index', [
            'exam_sessions' => $exam_sessions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get exams
        $exams = Exam::all();

        // render with inertia
        return inertia('Admin/ExamSessions/Create', [
            'exams' => $exams,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'title' => 'required',
            'exam_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        // create exam_session
        ExamSession::create([
            'title' => $request->title,
            'exam_id' => $request->exam_id,
            'start_time' => date('Y-m-d H:i:s', strtotime($request->start_time)),
            'end_time' => date('Y-m-d H:i:s', strtotime($request->end_time)),
        ]);

        // redirect
        return redirect()->route('admin.exam_sessions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get exam_session
        $exam_session = ExamSession::with('exam.classroom', 'exam.lesson')->findOrFail($id);

        // get relation exam_groups with pagination
        $exam_session->setRelation('exam_groups', $exam_session->exam_groups()->with('studen.classroom')->paginate(5));


        // render with inertia
        return inertia('Admin/ExamSessions/Show', [
            'exam_session' => $exam_session,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get exam_session
        $exam_session = ExamSession::findOrFail($id);

        // get exams
        $exams = Exam::all();

        // render with inertia
        return inertia('Admin/ExamSessions/Edit', [
            'exam_session' => $exam_session,
            'exams' => $exams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamSession $exam_session)
    {
        // valite request
        $request->validate([
            'title' => 'required',
            'exam_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        // update exam_session
        $exam_session->update([
            'title' => $request->title,
            'exam_id' => $request->exam_id,
            'start_time' => date('Y-m-d H:i:s', strtotime($request->start_time)),
            'end_time' => date('Y-m-d H:i:s', strtotime($request->end_time)),
        ]);

        // redirect
        return redirect()->route('admin.exam_sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get exam_session
        $exam_session = ExamSession::findOrFail($id);

        // delete exam_session
        $exam_session->delete();

        // redirect
        return redirect()->route('admin.exam_sessions.index');
    }
}
