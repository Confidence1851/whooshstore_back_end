<?php

namespace App\Repositories;

use App\Models\BlogPost as Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{

    /**
     * Create`s new post
     *
     * @param int
     * @return collection
     */
    public function store(array $post_data)
    {
        return Post::create($post_data);
    }


    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($post_id)
    {
        return Post::find($post_id);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        return Post::paginate(20);
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($post_id)
    {
        return Post::destroy($post_id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($post_id, array $post_data)
    {
        $data = Post::find($post_id);
        $data->update($post_data);
        return $data;
    }
}
