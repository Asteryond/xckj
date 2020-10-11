<?php


namespace app\controllers;

use XCPhp\base\Controller;

class LoginController extends Controller
{

    public function index()
    {
        if(isset($_POST['userName']) && isset($_POST['passwd']))
        {

        }
        $this->assign('title', '登录');
        $this->render();
    }



}