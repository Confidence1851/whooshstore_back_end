<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{

    /**
     * Get Model instance
     *
     * @param int
     */
    public function model();

    /**
     * Generates unique account number for new users
     *
     * @param int
     */
    public function generate_account_no();

    /**
     * Generates a new pin and stores it ther return pin
     *
     * @param int
     */
    public function verification_pin($id = null);

    /**
     * Get's logged in User
     *
     * @param int
     */
    public function user();


    /**
     * Get's a User by it's ID
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
     * Get's all Users.
     *
     * @return mixed
     */
    public function all();

    /**
     * Create`s new User
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Deletes a User.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a User.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
