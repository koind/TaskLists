<div class="container">
  <div class="card card-login mx-auto col-md-4 col-md-offset-4">
    <div class="card-header">
      <h3 class="text-center"><b>Авторизация</b></h3>
    </div>
    <div class="card-body">
      <form action="/admin/login" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1">Введите логин</label>
          <input type="text" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Логин" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Введите пароль</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Войти</button>
      </form><br>
      <div class="text-center">
        <?php if (!empty($errors)): ?>
        <p class="alert alert-dismissible alert-danger">
          <button class="close" type="button" data-dismiss="alert">×</button>
        <?php echo $errors; ?>
        </p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>