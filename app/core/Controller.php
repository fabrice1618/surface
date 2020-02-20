<?php

class Controller
{
    const EXIT_DONE = 0;
    const EXIT_REDIRECT = 1;

    protected $view;

    public $exit_code = null;
    public $exit_data = null;
    public $redirect_path = '';
    public $http_response_code = 200;


}
