<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GradesExport;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\ExamSession;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {

        // get all exams
        $exams = Exam::with('lesson', 'classroom')->get();

        return inertia('Admin/Reports/Index', [
            'exams' => $exams,
            'grades' => []
        ]);
    }

    public function filter(Request $request) {

        $this->validate($request, [
            'exam_id' => 'required',
        ]);

        // get all exams
        $exams = Exam::with('lesson', 'classroom')->get();

        // get exam
        $exam = Exam::with('lesson', 'classroom')
                ->where('id', $request->exam_id)
                ->first();

        if($exam) {

            // get exam session
            $exam_session = ExamSession::where('exam_id', $exam->id)->first();

            // get grades
            $grades = Grade::with('student', 'exam.classroom', 'exam.lesson', 'exam_session')
                    ->where('exam_id', $exam->id)
                    ->where('exam_session_id', $exam_session->id)
                    ->get();
        } else {
            $grades = [];
        }

        return inertia('Admin/Reports/Index', [
            'exams' => $exams,
            'grades' => $grades
        ]);
    }
    
    public function export(Request $request) {

        //get exam
        $exam = Exam::with('lesson', 'classroom')
                ->where('id', $request->exam_id)
                ->first();

        //get exam session
        $exam_session = ExamSession::where('exam_id', $exam->id)->first();

        //get grades / nilai
        $grades = Grade::with('student', 'exam.classroom', 'exam.lesson', 'exam_session')
                ->where('exam_id', $exam->id)
                ->where('exam_session_id', $exam_session->id)        
                ->get();

        return Excel::download(new GradesExport($grades), 'grade : '.$exam->title.' — '.$exam->lesson->title.' — '.Carbon::now().'.xlsx');
    }
}
