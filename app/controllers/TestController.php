<?php

namespace app\controllers;
use XCPhp\base\Controller;

class TestController extends Controller
{
    public function index()
    {
        $this->render();
    }
    public function phpinfo()
    {
        $this->render();
    }
}