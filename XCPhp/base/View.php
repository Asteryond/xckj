<?php

namespace XCPhp\base;


use app\controllers\TestController;

class View
{
    protected array $variables = array();
    protected $_controller;
    protected $_action;

    public function __construct($controller, $action)
    {
       $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }

    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function render()
    {
        extract($this->variables);

        $defaultHeader = APP_PATH . 'app/views/header.php';
        $defaultFooter = APP_PATH .  'app/views/footer.php';

        $controllerHeader = APP_PATH . 'app/views/' . $this->_controller .'/header.php';
        $controllerFooter = APP_PATH . 'app/views/' . $this->_controller . '/footer.php';
        $controllerLayout = APP_PATH . 'app/views/' . $this->_controller . '/' . $this->_action . '.php';

        if (is_file($controllerHeader)){
            include ($controllerHeader);
        }else{
            include ($defaultHeader);
        }

        if(is_file($controllerLayout)){
            include ($controllerLayout);
        }else{
            echo $controllerLayout;
            echo "<h1>无法找到视图文件</h1>";
        }

        if(is_file($controllerFooter)){
            include ($controllerFooter);
        }else{
            include ($defaultFooter);
        }
    }
}