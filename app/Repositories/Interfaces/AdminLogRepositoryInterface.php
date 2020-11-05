<?php

namespace App\Repositories\Interfaces;

interface AdminLogRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new AdminLog
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a AdminLog by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all AdminLogs.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a AdminLog.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a AdminLog.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
