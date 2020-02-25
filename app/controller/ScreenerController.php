<?php

class ScreenerController extends Controller
{

    public function __construct()
    {
//        parent::__contruct();
//        echo "inside HomeController\n";
        $this->view = new ScreenerView();
    }

    public function run()
    {
        $this->view->render();
    }

}
