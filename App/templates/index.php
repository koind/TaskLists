<?php
  require __DIR__ . '/../../config.php';
?>

<div class="jumbotron">
    <h1>Достигайте большего, <br>каждый день.</h1>
    <p>Следите за всеми своими задачами через TaskLists это лучший <br>способ оставаться организованным в любом месте и в любое время.</p>
</div>

<div class="table-responsive">  
     <table id="employee_data" class="table table-striped table-bordered">  
          <thead>  
               <tr>  
                    <th data-column-id="id" data-type="numeric" data-sortable="false">№</th>
                    <th data-column-id="img" data-formatter="img" data-sortable="false">Картинка</th>
                    <th data-column-id="name">ФИО</th>
                    <th data-column-id="email">E-mail</th>
                    <th data-column-id="text" data-sortable="false">Текст задачи</th>
                    <th data-column-id="status">Статус</th>  
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Подробнее</th> 
               </tr>  
          </thead>  
          <tbody> 
            <?php foreach ($tasks as $task): ?>
            <tr> 
                <td><?php echo $task->id; ?></td>
                <td><?php echo $task->img; ?></td>
                <td><?php echo $task->name; ?></td>
                <td><?php echo $task->email; ?></td>
                <td><?php echo (6 >= count($text = explode(' ', $task->text))) ? $task->text : $text[0] . ' ' . $text[1]  . ' ' . $text[2] . '...'; ?></td>   
                <td><?php echo STATUS[$task->status]; ?></td>
                <td></td>
            </tr>
            <?php endforeach; ?>
          </tbody>  
     </table>  
</div>  

<script>  
    $("#employee_data").bootgrid({
        rowCount: [3], 
        columnSelection: false,
        formatters: {
            "commands": function(column, row)
            {
                return "<a href=\"/task/one/?id=" + row.id +"\">Перейти</a>";
            }, 
            "img": function(column, row)
            {
                return "<img src=\"" + row.img +"\" width=\"150\">";
            }
        }
    });
</script>


