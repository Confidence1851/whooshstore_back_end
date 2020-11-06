<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    //VIEWS CONTROLLERS

    /**
     * function for index view
    */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Contact Us View
     */
    public function contactus()
    {
        # code...
    }

    /**
     * Freq asked questions view
     */
    public function faq(){
        # code...
    }

    /**
     * Terms and Conditions view
     */
    public function terms(){
       # code...
    }

    /**
     * privacy policy view
     */
    public function privacypolicy(){
        # code...
    }


    //Functions

    /**
     * read file path controller
    */
    public function read_file($path)
    {
        //return getFileFromPrivateStorage(decrypt($path));
    }

}
