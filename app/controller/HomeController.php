<?php

class HomeController extends Controller
{

    public function __construct()
    {
//        parent::__contruct();
//        echo "inside HomeController\n";
        $this->view = new HomeView();
    }

    public function run()
    {
        $this->view->render();
    }

}
