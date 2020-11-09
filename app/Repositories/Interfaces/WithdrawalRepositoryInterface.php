<?php

namespace App\Repositories\Interfaces;

interface WithdrawalRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Withdrawal
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Withdrawal by it's ID
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
     * Get's all Withdrawals.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Withdrawal.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Withdrawal.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
