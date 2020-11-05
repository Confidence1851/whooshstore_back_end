<?php

namespace App\Repositories\Interfaces;

interface ActivityRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Activity
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Activity by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Activitys.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Activity.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Activity.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
