<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface EloquentRepositoryInterface
 * @package App\Repsitories
 */

 interface EloquentRepositoryInterface
 {

    /**
     * @param array attributes
    * @return Model
    */

    public function create(array $attributes);

    /**
     * @param array attributes
    * @return Model
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
     * Get's all Model.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Model.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Model.
     *
     * @param int
     * @param array attributes
     */
    public function update($id, array $attributes);
 }
