<?php

namespace App;
use App\Comment;
use App\CommentReply;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function check_reply($id)
    {
        $comment = CommentReply::where('comment_id', $id)->get();
        return $comment->count();
    }

    public static function get_reply($id)
    {
        $reply = CommentReply::where('comment_id', $id)->first();
        return $reply->reply;
    }

    public function get_ReplyByID($id)
    {
        $reply = CommentReply::where('comment_id', $id)->first();
        return $reply;
    }

   
}
