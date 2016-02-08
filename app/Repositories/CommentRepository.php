<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 29/01/2016
 * Time: 16:55.
 */
namespace Koya\Repositories;

use Koya\Comment;

/**
 * Class CommentRepository.
 */
class CommentRepository
{
    /**
     * Loads dependencies via DI container
     * CommentRepository constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Saves a new comments.
     *
     * @param $data
     *
     * @return static
     */
    public function save($data)
    {
        return $this->comment->create($data);
    }

    /**
     * Gets all comments with user and video eager loaded.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->comment->with('user')->with('video')->get();
    }

    /**
     * Gets a comment by ID.
     *
     * @param $comment_id
     *
     * @return mixed
     */
    public function getCommentByID($comment_id)
    {
        return $this->comment->with('user')->where('id', $comment_id)->get()->first();
    }
}
