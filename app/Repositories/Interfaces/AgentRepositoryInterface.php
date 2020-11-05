<?php

namespace App\Repositories\Interfaces;

interface AgentRepositoryInterface
{

    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Create`s new Agent
     *
     * @param int
     */
    public function create(array $attributes);


    /**
     * Get's a Agent by it's ID
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
     * Get's all Agents.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a Agent.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a Agent.
     *
     * @param int
     * @param array
     */
    public function update($id, array $attributes);
}
