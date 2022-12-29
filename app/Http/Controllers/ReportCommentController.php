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
    }
    public function store(CreateReportCommentRequest $request, Comment $comment)
    {
        $input = $request->reportComment;
        $reportComment = ReportComment::create([
            'id' => $comment->id,
            'reason' => $input,
            'user_id' => Auth::user()->id,
            'comment_id' => $comment->id
        ]);
        return response()->json();
    }
}
