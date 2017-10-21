<?php
  session_start();

  require __DIR__ . '/../../config.php';
  $path = trim($_SERVER['REQUEST_URI'], '/');
  $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Список задач</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo PATH['LAYOUTS']; ?>css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php if (('task' == $path) || empty($path)): ?>
    <link href="<?php echo PATH['LAYOUTS']; ?>css/jquery.bootgrid.css" rel="stylesheet">
    <script src="<?php echo PATH['LAYOUTS']; ?>js/jquery.bootgrid.min.js"></script>
    <?php endif; ?>

    <?php if ('task/add' == $path): ?>
    <script src="<?php echo PATH['LAYOUTS']; ?>js/js-valid.js"></script>
    <?php endif; ?>
</head>
<body class="navbar-bottom">

<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">TaskLists</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">TaskLists</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/task/add">Добавить задачу</a></li>
          <?php if (empty($user->login)): ?>
          <li><a href="/admin/login">Войти</a></li>
          <?php else: ?>
          <li>
            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user->login; ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/admin"><i class="glyphicon glyphicon-home"></i> Админка</a></li>
              <li><a href="/admin/logout"><i class="glyphicon glyphicon-log-out"></i> Выход</a></li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

<main>
  <?php echo $content; ?>
</main>

<footer class="navbar navbar-default navbar-fixed-bottom footer">
  <p class="navbar-text pull-left">© <?php echo date('Y', time()); ?> - TaskLists</p>
</footer>

</body>
</html>