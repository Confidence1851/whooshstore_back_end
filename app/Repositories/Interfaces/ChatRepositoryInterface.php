<?php

namespace App\Repositories\Interfaces;

interface ChatRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Chat
     *
     * @param int
     */
    public function store(array $data);


    /**
     * Get's a Chat by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all Chats.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Chat.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Chat.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
