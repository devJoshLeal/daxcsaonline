<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public $apiData = array(
        'status'    => 'success',
        'code'      => 200,
        'message'   => '',
        'data'      => array(),
        'errors'    => array()
    );
}
