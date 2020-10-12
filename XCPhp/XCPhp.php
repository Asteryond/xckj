<?php
namespace XCPhp;


defined('CORE_PATH') or define('CORE_PATH', __DIR__);

class XCPhp{
    protected  $config = array();

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        //
        //echo $_SERVER['REQUEST_URI'];
        spl_autoload_register(array($this, 'loadClass'));
        $this->setDbConfig();
        $this->route();
    }

    public function setDbConfig()
    {
        if ($this->config['db'])
        {
            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['dbname']);
            define('DB_USER', $this->config['db']['login']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }

    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();

        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url,0,$position);
        $url = trim($url, '/');
        if ($url)
        {
            $urlArray = explode('/',$url);
            $urlArray = array_filter($urlArray);
            //获取控制器名
            $controllerName = ucfirst($urlArray[0]);
            //获取动作名
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;
            //获取参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();

        }
        $controller = 'app\\controllers\\' . $controllerName . 'Controller';

        if(!class_exists($controller)){
            exit($controller . "控制器不存在");
        }
        if(!method_exists($controller, $actionName)){
            exit($actionName . "方法不存在");
        }

        $dispatch = new $controller($controllerName,$actionName);
        call_user_func_array(array($dispatch, $actionName),$param);
    }

    //自动加载类
    public function loadClass($className)
    {
        $classMap = $this->classMap();
        if(isset($classMap[$className]))
        {
            $file = $classMap[$className];
        }
        else if (strpos($className, '\\') !==false)
        {
            $file = APP_PATH . str_replace('\\','/',$className) . '.php';
            if(!is_file($file)){
                return;
            }
        }
        else{
            return;
        }
        include $file;
    }


    protected function classMap()
    {
        return [
            'XCPhp\base\Controller' => CORE_PATH . '/base/Controller.php',
            'XCPhp\base\Model' => CORE_PATH . '/base/Model.php',
            'XCPhp\base\View' => CORE_PATH . '/base/View.php',
            'XCPhp\db\Db' => CORE_PATH . '/db/Db.php',
            'XCPhp\db\Sql' => CORE_PATH . '/db/Sql.php',
        ];
    }
}