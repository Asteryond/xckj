<?php

namespace app\models;

use XCPhp\base\Model;

class RegisterModel extends Model
{
    protected $table = 'User';

    public function regis($name, $passwd, $email, $team)
    {
        $this->add(array('Name'=>$name,
            'Email' => $email,
            'Password'=>md5(md5($passwd)),
            'Team'=>$team));
    }
}