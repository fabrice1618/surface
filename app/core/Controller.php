<?php

class Controller
{
    const EXIT_DONE = 0;
    const EXIT_REDIRECT = 1;

    protected $view;

    public $exit_code = null;
//    public $exit_data = null;
    public $redirect_path = '';


    protected function exitDone()
    {
        $this->exit_code = self::EXIT_DONE;
    }

    protected function exitRedirect( string $sRedirectPath )
    {
        $this->exit_code = self::EXIT_REDIRECT;
        $this->redirect_path = $sRedirectPath;
    }

}
