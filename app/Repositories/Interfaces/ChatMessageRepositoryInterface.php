<?php

namespace App\Repositories\Interfaces;

interface ChatMessageRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new ChatMessage
     *
     * @param int
     */
    public function store(array $data);


    /**
     * Get's a ChatMessage by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all ChatMessages.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a ChatMessage.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a ChatMessage.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
