<?php

namespace App\Repositories\Interfaces;

interface ErrorLogRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Errorlog
     *
     * @param int
     */
    public function create(array $data);


    /**
     * Get's a Errorlog by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Errorlogs.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Errorlog.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Errorlog.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
