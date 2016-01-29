<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 29/01/2016
 * Time: 16:55
 */

namespace Koya\Repositories;


use Koya\Comment;

class CommentRepository
{

    public function __construct(Comment $comment)
    {
        $this->comment  = $comment;
    }

    public function save($data)
    {
        return $this->comment->create($data);
    }

    public function getAll()
    {
        return $this->comment->with('user')->with('video')->get();
    }

}