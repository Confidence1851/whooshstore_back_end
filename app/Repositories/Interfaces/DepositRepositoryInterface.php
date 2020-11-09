<?php

namespace App\Repositories\Interfaces;

interface DepositRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Deposit
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Deposit by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Deposits.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Deposit.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Deposit.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
