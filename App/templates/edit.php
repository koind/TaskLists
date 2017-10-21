<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="container">
	<div class="row">
		<img src="https://dr0wv9n0kx6h5.cloudfront.net/20be1aad62c5902b003fc2dbdc837ab43fab3c28/content/03-blog/137-wunderlist-folders-quick-add-android-lollipop/01@2x.png" style=" max-width: 50%; display: block; margin: 20px auto; ">
		<h1 class="text-center"><b>Редактирование задачи</b></h1><br><br>
	</div>
	<div class="row">
		<div class="panel panel-default">
		    <div class="panel-heading">
		        * - можно редактировать
		    </div>
		    <div class="panel-body">
		        <div class="row">
		            <div class="col-lg-12">
		                <form role="form" action="/admin/save" method="post">
		                	<div class="form-group">
		                        <img src="<?php echo $task->img; ?>" style="max-width: 100%;display: block;margin: 0 auto;" alt="img">
		                    </div><hr>
		                    <div class="form-group">
		                        <label>ФИО:</label>
		                        <p><?php echo $task->name; ?></p>
		                    </div><hr>
		                    <div class="form-group">
		                        <label>E-mail:</label>
		                        <p><?php echo $task->email; ?></p>
		                    </div><hr>
		                    <div class="form-group">
		                        <label>* Текст задачи:</label>
		                        <textarea class="form-control input-lg" id="text" name="text" required rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"><?php echo $task->text; ?></textarea>
		                    </div><hr>

		                    <div class="form-group">
		                        <label>* Статус задачи:</label>
		                        <input type="checkbox" id="toggle-event" data-toggle="toggle" data-on="Выполнено" data-off="Не выполнено" value="">
		                    	<input type="hidden" id="inputItem" name="status" value="" required>

		                    </div><hr>

		                    <input type="hidden" name="id" value="<?php echo $task->id; ?>" required>

		                    <!-- Trigger the modal with a button -->
		                    <a href="/admin" class="btn btn-primary pull-left">Вернутся назад</a>
		                    <button type="submit" class="btn btn-success pull-right">Редактировать</button>

		                </form>
		            </div>
		        </div>
		        <!-- /.row (nested) -->
		    </div>
		    <!-- /.panel-body -->
		</div>
	</div>
</div>

<script>
  $(function() {
  	$('#toggle-event').bootstrapToggle('<?php echo (0 == $task->status) ? 'off' : 'on'; ?>');
  	$('#inputItem').attr('value', <?php echo (0 == $task->status) ? 'false' : 'true'; ?>);

    $('#toggle-event').change(function() {
      $("#inputItem").attr('value', $(this).prop('checked'));
    });
  });
</script>