<?php

namespace App\Repositories\Interfaces;

interface CountryStateRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new CountryState
     *
     * @param int
     */
    public function create(array $data);


    /**
     * Get's a CountryState by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all CountryStates.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a CountryState.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a CountryState.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
