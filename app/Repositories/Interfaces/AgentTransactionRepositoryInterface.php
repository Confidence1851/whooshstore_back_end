<?php

namespace App\Repositories\Interfaces;

interface AgentTransactionRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new AgentTransaction
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a AgentTransaction by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all AgentTransactions.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a AgentTransaction.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a AgentTransaction.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
