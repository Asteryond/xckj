<?php


namespace app\controllers;


use app\models\RegisterModel;
use XCPhp\base\Controller;

class RegisterController extends Controller
{
    private $userName;
    private $passwd;
    private $email;
    private $team;

    public function index()
    {
        $this->userName = $_POST['userName'];
        $this->passwd = $_POST['passwd'];
        $this->email = $_POST['email'];
        $this->team = $_POST['team'];

        if (isset($this->userName) && isset($this->passwd) && isset($this->email) && isset($this->team))
        {
            (new RegisterModel())->regis($this->userName,$this->passwd,$this->email,$this->team);
        }

        $this->assign('title','注册');
        $this->render();
    }
}