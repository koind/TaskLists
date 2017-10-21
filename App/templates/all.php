<?php
  require __DIR__ . '/../../config.php';
?>

<?php foreach ($tasks as $task): ?>

    <div class="container">
        <div class="bs-example" data-example-id="thumbnails-with-custom-content"> 
            <div class="row"> 
                <div class="col-sm-12 col-md-12"> 
                    <div class="thumbnail"> <img alt="100%x200" src="<?php echo $task->img; ?>" data-holder-rendered="true" style="height: 200px; display: block;"> 
                        <div class="caption"> 
                            <h3>ФИО: <?php echo $task->name; ?></h3>
                            <hr> 
                            <p>E-mail: <?php echo $task->email; ?></p>
                            <hr>
                            <p>Статус: <?php echo STATUS[$task->status]; ?></p>
                            <hr>
                            <p>Задача: <?php echo $task->text; ?></p>
                            <hr> 
                            <p>
                                <a href="/admin/change/?id=<?php echo $task->id; ?>" class="btn btn-primary" role="button">Редактировать</a>
                            </p> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
    </div>

<?php endforeach; ?>