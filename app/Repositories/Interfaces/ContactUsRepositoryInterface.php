<?php

namespace App\Repositories\Interfaces;

interface ContactUsRepositoryInterface
{
    /**
     * Get's Model Instance
     *
     * @param int
     */
    public function model();


    /**
     * Store contact us form data
     *
     * @param int
     */
    public function store(array $pcontact_us_data);


}
