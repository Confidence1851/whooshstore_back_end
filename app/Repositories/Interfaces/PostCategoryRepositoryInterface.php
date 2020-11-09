<?php

namespace App\Repositories\Interfaces;

interface PostCategoryRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new post category
     *
     * @param int
     */
    public function store(array $post_category_data);



    /**
     * Get's a post category by it's ID
     *
     * @param int
     */
    public function get($post_category_id);

    /**
     * Get's all post categories.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a post category.
     *
     * @param int
     */
    public function delete($post_category_id);

    /**
     * Updates a post category.
     *
     * @param int
     * @param array
     */
    public function update($post_category_id, array $post_category_data);
}
