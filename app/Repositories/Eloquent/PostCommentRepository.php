<?php

namespace App\Repositories;

use App\Models\BlogPostComment as Comment;
use App\Repositories\Interfaces\PostCommentRepositoryInterface;

class PostCommentRepository implements PostCommentRepositoryInterface
{

    /**
     * Create new post comment
     *
     * @param int
     * @return collection
     */
    public function store(array $comment_data)
    {
        return Comment::create($comment_data);
    }



    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($comment_id)
    {
        return Comment::find($comment_id);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        return Comment::paginate(20);
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($comment_id)
    {
        return Comment::destroy($comment_id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($comment_id, array $comment_data)
    {
        $data = Comment::find($comment_id);
        $data->update($comment_data);
        return $data;
    }
}
