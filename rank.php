<?php
header("Content-Type:text/html;charset=utf-8");
?>

<?php
$uri = $_SERVER['REQUEST_URI'] ;

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
    <script src="/js/rank.js"></script>

    <title>员工中心</title>


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

</head>


<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top flex-md-nowrap shadow ">
    <a class="navbar-brand" href="#">
        <img src="/images/xc_logo.png" width="30" height="30" class="d-inline-block align-top" alt="" >
        员工中心
    </a>

    <ul class="navbar-nav flex-row">
        <li class="nav-item">
            <a href="/_user/user_login.php"> <img class="round_icon d-inline-block" src="/images/user.png" alt="用户" style="margin-right: 15px; CURSOR: pointer"></a>
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
            <li class="nav-item  active dropdown">
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


    <h5 style="text-align: center; margin:10px">排行榜</h5>

    <div class="table-responsive">
        <table class="table  table-bordered" id="memberRank">
            <thead class="thead-light ">
            <tr>
                <th scope="col"> #</th>
                <th scope="col"> 姓名 </th>
                <th scope="col"> 总分 </th>
                <th scope="col">团队 <div class="caret"></div></th>
            </tr>
            </thead>

            <tbody>
            <?php
            require_once 'getRank.php';
            $members = json_decode(getRank());
            $membersNum = count($members);
            for($i = 0; $i < $membersNum; $i++)
            {
                echo "<tr>";
                echo "<td>";
                echo  ($i + 1) <= 3 ? "<b>". ($i + 1) . "." ."</b>" : ($i + 1) . ".";
                echo"</td>";

                echo "<td>";
                echo "<a href='#' data-toggle='popover' title=''>". $members[$i]->name ."</a>";
                echo"</td>";

                echo "<td>";
                echo "<a href='#' data-toggle='modal' data-target='#myModal' ".
                    "id='{$members[$i]->id}'" ." onclick='showScore(this.id)'>" . $members[$i]->scores . "</a>";
                echo"</td>";

                echo "<td>";
                echo "<a href='#'>" .  $members[$i]->team . "</a>";
                echo"</td>";
                echo "</tr>";
            }
            ?>
            </tbody>

        </table>
    </div>


<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">加分项</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">

                    <tbody>
                        <tr>
                            <td>
                                销售加分
                            </td>
                            <td id="sp">
                                -
                            </td>
                        </tr>
                    <tr>
                        <td >
                            招聘加分
                        </td>
                        <td id="rp">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td>
                            宣传加分
                        </td>
                        <td id = "pp">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td>
                            会议加分
                        </td>
                        <td id="mp">
                            -
                        </td>
                    </tr>
                    <tr>
                        <td>
                            其它加分
                        </td>
                        <td id="op">
                            100
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>

        </div>
    </div>
</div>

</body>