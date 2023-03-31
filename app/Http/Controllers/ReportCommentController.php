<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReportCommentRequest;
use App\Models\Comment;
use App\Models\ReportComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportCommentController extends Controller
{
    public function index()
    {
        $reportComments = ReportComment::query()->with('comment','user_created','user_comment')->latest()->paginate(9);
        return view('pages.reportcomment-management.index', compact('reportComments'));
    }
    public function store(CreateReportCommentRequest $request, Comment $comment)
    {
        $input = $request->reportComment;
        $reportComment = ReportComment::create([
            'reason' => $input,
            'user_created_id' => Auth::user()->id,
            'comment_id' => $comment->id,
            'user_comment_id' => $comment->user->id
        ]);
        return response()->json();
    }
    public function destroy(ReportComment $reportcomment)
    {
        $reportcomment->delete();
        Comment::where('id', $reportcomment->comment->id)->delete();
        return back()->with('succes', 'Bình luận đã được xóa');
    }
}
