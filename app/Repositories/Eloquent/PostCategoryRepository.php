<?php

namespace App\Repositories;

use App\Models\BlogPostCategory as Category;
use App\Repositories\Interfaces\PostCategoryRepositoryInterface;

class PostCategoryRepository implements PostCategoryRepositoryInterface
{

    /**
     * Create new post category
     *
     * @param int
     * @return collection
     */
    public function store(array $post_category_data)
    {
        return category::create($post_category_data);
    }



    /**
     * Get's a post category by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($category_id)
    {
        return Category::find($category_id);
    }

    /**
     * Get's all post categories.
     *
     * @return mixed
     */
    public function all()
    {
        return Category::paginate(20);
    }

    /**
     * Deletes a post category.
     *
     * @param int
     */
    public function delete($category_id)
    {
        $data = Category::destroy($category_id);
        return $data;
    }

    /**
     * Updates a post category.
     *
     * @param int
     * @param array
     */
    public function update($category_id, array $post_category_data)
    {
        $data =  Category::find($category_id);
        $data->update($post_category_data);
        return $data;
    }
}
