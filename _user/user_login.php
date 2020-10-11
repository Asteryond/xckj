<?php
session_start();

if (isset($_SESSION['userName'])){
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == true){
        //TODO 管理员界面
        //include "templates/user_admin.php";
        header('content-type:text/html;charset=uft-8');
        header('location:user_admin.php');
    }else{
        //TODO 用户界面
        header('content-type:text/html;charset=uft-8');
        header('location:user_common.php');
    }
}else{
    //TODO 未登录
    //header('content-type:text/html;charset=uft-8');
    //header('location:user_login.php');
}


$nameErr = $passErr = "";
$userName =  $userPass = "";

$config = require("../config/config.php");
require '../sql/ConnectMySQL.php';

$mySQlConnection = new ConnectMySQL(['host'=>$config['db']['hostname'],
    'login'=>$config['db']['login'],
    'pass'=>$config['db']['password'],
    'db'=>$config['db']['dbname']]);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(empty($_POST['userName']))
    {
        $nameErr = "请输入用户名";
    }else{
        //记住上次登陆的用户名
        $userName = $_POST['userName'];
    }

    if (empty($_POST['passwd']))
    {
        $passErr = "请输入密码";
    }else{
        $userPass = $_POST['passwd'];
    }

    if (!empty($_POST['userName']) && !empty($_POST['passwd']))
    {
        //TODO 登录
        $sql = "SELECT * FROM users WHERE xc_password='$userPass' AND xc_name='$userName'";
        $userInfo = $mySQlConnection->query($sql)->fetch_assoc();
        if (!empty($userInfo)){
            //TODO 登录成功;
            $_SESSION['userName'] = $userName;
            $_SESSION['admin'] = $userInfo['xc_admin'];

            header("Refresh:0");
            //echo $_SESSION['userName'];
        }else{
            $passErr = "账号或密码错误";
            $userPass = "";

        }
    }

}
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/asterui.css">

    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>用户</title>

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

    <link rel="stylesheet" href="/css/user_login.css">
</head>


<body class="text-center">


<form class="form-login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Login">
    <img class="mb-4" src="/images/xc_logo.png" width="72" height="72" alt="xckj" style="text-align: center">
    <h1 class="h3 mb-3 font-weight-normal">请登录</h1>
    <div class="form-group">
        <label for="userName" class="sr-only">用户名</label>
        <input class="form-control" id="userName" type="text" placeholder="输入用户名" name="userName" value="<?php echo $userName?>" required autofocus>
        <small class="text-danger"><?php echo $nameErr?></small>
    </div>
    <div class="form-group">
        <label for="userPass" class="sr-only">密码</label>
        <input type="password" class="form-control" id="userPass" placeholder="密码" name="passwd" value="<?php echo $userPass?>" required>

    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="rememberMe" name="r" value="true" >
        <label class="form-check-label" for="rememberMe">记住我</label>
    </div>
    <button type="submit" class="btn btn-primary btn-block">登录</button>
</form>

</body>