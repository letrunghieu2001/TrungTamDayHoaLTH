<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ReportComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'report_comments';

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created_id');
    }

    public function user_comment()
    {
        return $this->belongsTo(User::class, 'user_comment_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
