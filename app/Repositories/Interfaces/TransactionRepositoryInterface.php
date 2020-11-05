<?php

namespace App\Repositories\Interfaces;

interface TransactionRepositoryInterface
{
    /**
     * Get Model instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Transaction
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Transaction by it's ID
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
     * Get's all Transactions.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Transaction.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Transaction.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
