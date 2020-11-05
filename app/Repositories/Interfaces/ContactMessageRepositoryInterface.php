<?php

namespace App\Repositories\Interfaces;

interface ContactmessageRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Contactmessage
     *
     * @param int
     */
    public function store(array $data);


    /**
     * Get's a Contactmessage by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all Contactmessages.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Contactmessage.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Contactmessage.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
