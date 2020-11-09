<?php

namespace App\Repositories\Interfaces;

interface CountryRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Country
     *
     * @param int
     */
    public function create(array $data);


    /**
     * Get's a Country by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Countries.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Country.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Country.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
