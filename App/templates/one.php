<?php
  require __DIR__ . '/../../config.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12"><br>
			<div class="thumbnail" style="padding: 10px;">
				<br>
				<!-- Preview Image -->
				<img class="img-fluid rounded" src="<?php echo $task->img; ?>" alt="img" style=" max-width: 100%; ">

				<!-- Title -->
				<h3>Автор: <?php echo $task->name; ?></h3>
				<hr>
				<p>E-mail: <?php echo $task->email; ?></p>
				<hr>
				<p>Статус: <?php echo STATUS[$task->status]; ?></p>
				<hr>
				<p>Задача: <?php echo $task->text; ?></p>
				<hr>
				<a class="btn btn-primary" href="/">Перейти на главную страницу</a>
			</div>
		</div>
	</div>
</div>