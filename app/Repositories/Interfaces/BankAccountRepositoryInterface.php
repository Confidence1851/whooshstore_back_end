<?php

namespace App\Repositories\Interfaces;

interface BankAccountRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new BankAccount
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a BankAccount by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all BankAccounts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a BankAccount.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a BankAccount.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
