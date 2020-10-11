<?php

use app\models\TestModel;
use XCPhp\db;

(new TestModel())->where(array('Id=0'))->update(array('Name' => 'asteryond'));