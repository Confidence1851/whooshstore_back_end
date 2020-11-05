<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new post
     *
     * @param int
     */
    public function store(array $data);


    /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
