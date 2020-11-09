<?php

namespace App\Repositories\Interfaces;

interface SettingRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    // /**
    //  * Create`s new Setting
    //  *
    //  * @param int
    //  */
    // public function store(array $data);


    // /**
    //  * Get's a Setting by it's ID
    //  *
    //  * @param int
    //  */
    // public function get($id);

    /**
     * Get's all Settings.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Setting.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Setting.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
