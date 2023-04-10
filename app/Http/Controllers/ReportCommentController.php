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
        $reportComments = ReportComment::query()
        ->join('comments','comments.id','=','report_comments.comment_id')
        ->join('posts','posts.id','=','comments.post_id')
        ->select('*','report_comments.id as reportcomment_id','posts.id as post_id')
        ->with('comment','user_created','user_comment')
        ->latest('report_comments.created_at')
        ->paginate(9);
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
    public function destroyReport(ReportComment $reportcomment)
    {
        $reportcomment->delete();
        return back()->with('succes', 'Báo cáo đã được xóa');
    }
}
