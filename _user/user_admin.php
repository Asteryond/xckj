
<?php
session_start();

?>
<?php
//注销
if (isset($_GET['action']) && $_GET['action'] == "logout"){
    session_destroy();
    header('content-type:text/html;charset=uft-8');
    header('location:user_login.php');
}
//防止直接被访问
if(!isset($_SESSION['userName'])) header("location:user_login.php");
session_destroy();
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="/css/asterui.css">
    <link rel="stylesheet" href="/css/dashboard.css">

    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>


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

    <title>用户</title>
</head>


<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
    <a class="navbar-brand" href="/index.php">
         <img src="/images/xc_logo.png" width="30" height="30" class="d-inline-block align-top" alt="" >
        管理
    </a>

    <ul class="navbar-nav flex-row">
        <li class="nav-item">
            <a href="#"> <img class="round_icon d-inline-block" src="/images/user.png" alt="用户" style="margin-right: 15px; CURSOR: pointer"></a>
        </li>
     <li class="nav-item">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
     </li>

    </ul>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">主页 <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item  dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="employerDropdownMenu" role="button" data-toggle="dropdown">
                    员工中心
                </a>
                <div class="dropdown-menu" aria-labelledby="employerDropdownMenu">
                    <a class="dropdown-item" href="#">排行榜</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="搜索" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="slidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            分数管理</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">分数管理</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary">导出</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        此周
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <div class="btn-group">
                        <button class="btn btn-primary">添加成员</button>
                        <button class="btn btn-danger">删除选中</button>
                    </div>
                    <button class="btn btn-info">修改选中</button>
                </div>

                <div class="col mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="team" >团队：</label>
                        </div>
                        <select class="custom-select" id="team"></select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary">筛选</button>
                        </div>
                    </div>

                </div>
                <div class="col mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label for="name"class="input-group-text">姓名：</label>
                        </div>
                        <input type="text" class="form-control" placeholder="姓名" id="name">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary">查找</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                排行
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                团队
                            </th>
                            <th>
                                总分
                            </th>
                            <th>
                                销售
                            </th>
                            <th>
                                招聘
                            </th>
                            <th>
                                宣传
                            </th>
                            <th>
                                会议
                            </th>
                            <th>
                                其他
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>
                            1
                        </td>
                        <td>
                            aster
                        </td>
                        <td>
                            西华
                        </td>
                        <td>
                            100
                        </td>
                        <td>
                            10
                        </td>
                        <td>
                            20
                        </td>
                        <td>
                            30
                        </td>
                        <td>
                            40
                        </td>
                        <td>
                            50
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>
                            2
                        </td>
                        <td>
                            tom
                        </td>
                        <td>
                            西华
                        </td>
                        <td>
                            10
                        </td>
                        <td>
                            10
                        </td>
                        <td>
                            20
                        </td>
                        <td>
                            30
                        </td>
                        <td>
                            40
                        </td>
                        <td>
                            50
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>


    </div>
</div>


</body>