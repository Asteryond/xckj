
<form class="form-login" action="/register" method="post" name="Register">
    <img class="mb-4" src="/images/xc_logo.png" width="72" height="72" alt="xckj" style="text-align: center">
    <h1 class="h3 mb-3 font-weight-normal">注册</h1>
    <div class="form-group">
        <label for="userName" class="sr-only">用户名</label>
        <input class="form-control" id="userName" type="text" placeholder="输入用户名" name="userName" required autofocus>
    </div>
    <div class="form-group">
        <label for="userPass" class="sr-only">密码</label>
        <input type="password" class="form-control" id="userPass" placeholder="密码" name="passwd"  required>

    </div>
    <div class="form-group">
        <label for="userPass" class="sr-only">确认密码</label>
        <input type="password" class="form-control" id="userPass" name="userPassConfirm" placeholder="确认密码" required>
    </div>
    <label for="email" class="sr-only">邮箱</label>
    <div class="form-group">
        <input type="email" class="form-control" id="email" placeholder="邮箱" name="email" required>
    </div>

    <label for="team" class="sr-only">团队</label>
    <div class="form-group">
        <input type="text" class="form-control" id="team" placeholder="团队" name="team" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">注册</button>
</form>
