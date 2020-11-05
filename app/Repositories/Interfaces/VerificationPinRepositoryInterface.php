<?php

namespace App\Repositories\Interfaces;

interface VerificationPinRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new VerificationPin
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a VerificationPin by it's ID
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
     * Get's all VerificationPins.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a VerificationPin.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a VerificationPin.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
