<?php

namespace App\Repositories\Interfaces;

interface NotificationRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Notification
     *
     * @param int
     */
    public function create(array $data);


    /**
     * Get's a Notification by it's ID
     *
     * @param int
     */
    public function find($id);

    /**
     * Get's all Notifications.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Notification.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Notification.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data);
}
