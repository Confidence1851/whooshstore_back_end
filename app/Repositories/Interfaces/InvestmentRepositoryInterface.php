<?php

namespace App\Repositories\Interfaces;

interface InvestmentRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Investment
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Investment by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Investments.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Investment.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Investment.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
