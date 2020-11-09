<?php

namespace App\Repositories\Interfaces;

interface NewsLetterSubscriberRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new NewsLetterSubscriber
     *
     * @param int
     */
    public function store(array $data);


    /**
     * Get's a NewsLetterSubscriber by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all NewsLetterSubscribers.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a NewsLetterSubscriber.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a NewsLetterSubscriber.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
