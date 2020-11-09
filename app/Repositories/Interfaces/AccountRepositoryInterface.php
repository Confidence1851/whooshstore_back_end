<?php

namespace App\Repositories\Interfaces;

interface AccountRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Account
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Account by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's a Model by it's ID and returns error on failure
     *
     * @param int
     * @return Model
     */
    public function findorfail($id);

    /**
     * Get's all Accounts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Account.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Account.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
