<?php

namespace App\Repositories\Interfaces;

interface FiatTransferRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new FiatTransfer
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a FiatTransfer by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all FiatTransfers.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a FiatTransfer.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a FiatTransfer.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
