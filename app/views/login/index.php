
<form class="form-login" action="/login" method="post" name="Login">
    <img class="mb-4" src="/images/xc_logo.png" width="72" height="72" alt="xckj" style="text-align: center">
    <h1 class="h3 mb-3 font-weight-normal">请登录</h1>
    <div class="form-group">
        <label for="userName" class="sr-only">用户名</label>
        <input class="form-control" id="userName" type="text" placeholder="输入用户名" name="userName" value="<?php echo $userName?>" required autofocus>
    </div>
    <div class="form-group">
        <label for="userPass" class="sr-only">密码</label>
        <input type="password" class="form-control" id="userPass" placeholder="密码" name="passwd"  required>

    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="rememberMe" name="r" value="true" >
        <label class="form-check-label" for="rememberMe">记住我</label>
    </div>
    <button type="submit" class="btn btn-primary btn-block">登录</button>
</form>
