<?php

namespace App\Repositories\Interfaces;

interface AdvertRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Advert
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Advert by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Adverts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Advert.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Advert.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
