<?php view('todo', 'include/page-top.htm.php');?>
<div class="container-md pt-5 justify-content-center">
    <form onsubmit="onSubmitAuth(this); return false;" class="container-sm pt-5 auth-width">
        <div class="mb-3">
            <label for="formControl-Login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="formControl-Login">
        </div>
        <div class="mb-3">
            <label for="formControl-Password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="formControl-Password">
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>
    </form>
</div>
<?php view('todo', 'include/page-bottom.htm.php');?>