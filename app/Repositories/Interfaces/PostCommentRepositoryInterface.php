<?php

namespace App\Repositories\Interfaces;

interface PostCommentRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new post comment
     *
     * @param int
     */
    public function store(array $post_comment_data);



    /**
     * Get's a post comment by it's ID
     *
     * @param int
     */
    public function get($post_comment_id);

    /**
     * Get's all post comments.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a post comment.
     *
     * @param int
     */
    public function delete($post_comment_id);

    /**
     * Updates a post comment.
     *
     * @param int
     * @param array
     */
    public function update($post_comment_id, array $post_comment_data);
}
