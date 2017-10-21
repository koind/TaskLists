<div class="container">
	<div class="row">
		<br>
		<?php foreach ($errors as $error): ?>

	    <div class="alert alert-danger">
	        <?php echo $error->getMessage(); ?>
	    </div>

		<?php endforeach; ?>

		<br>
		<a class="btn btn-info" href="/task/add">Вернуться назад</a>
	</div>
</div>


