<?php

namespace App\Repositories\Interfaces;

interface ReferralRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Referral
     *
     * @param int
     */
    public function create(array $data);


    /**
     * Get's a Referral by it's ID
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
     * Get's all Referrals.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Referral.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Referral.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
