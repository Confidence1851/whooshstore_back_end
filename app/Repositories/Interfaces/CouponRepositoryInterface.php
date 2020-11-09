<?php

namespace App\Repositories\Interfaces;

interface CouponRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Coupon
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Coupon by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Coupons.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Coupon.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Coupon.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
