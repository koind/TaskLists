<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img src="https://dr0wv9n0kx6h5.cloudfront.net/ae3a6740daad90be9c308b1cd6b73421c9014e69/content/03-blog/172-your-preview-of-microsoft-to-do/01@2x.png" style=" max-width: 50%; display: block; margin: 20px auto; ">
            
            <h1 class="text-center"><b>Добавить новую задачу</b></h1><br><br>

            <div class="panel panel-default">
                <div class="panel-heading">
                    * - поля обязательные для заполнения
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <form id="upload_image" class="live-preview-form" method="post" enctype="multipart/form-data">
                                    <hr>
                                    <label>* Выбрать изображение:</label><br> 
                                    <input type="file" accept=".jpg,.gif,.png,.jpeg" name="image_upload" id="image_upload" />
                                    <br>
                                    <p>Картинка должна соответствовать одному из следующих форматов: JPG/GIF/PNG</p>
                                    <br>
                                    <input type="submit" id="upload" class="btn btn-info" value="Загрузить" />
                                    <hr>
                                </form>
                            </div>


                            <form role="form" action="/task/create" method="post">
                                <div class="form-group">
                                    <label>* Введите ФИО:</label>
                                    <input class="form-control input-lg" id="name" type="text" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>* Введите E-mail:</label>
                                    <input class="form-control input-lg" id="email" type="text" name="email" required>
                                </div>
                
                                <div class="form-group">
                                    <label>* Введите текст задачи</label>
                                    <textarea class="form-control input-lg" id="text" name="text" required rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 74px;"></textarea>
                                </div>

                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-info" id="preView" data-toggle="modal" data-target="#myModal">Предварительный просмотр</button>

                                <!-- Modal -->
                                <div id="myModal" class="modal fade bd-example-modal-lg" role="dialog">
                                  <div class="modal-dialog modal-lg">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h4 class="modal-title">Предварительный просмотр</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="table-responsive">  
                                            <table id="employee_data" class="table table-striped table-bordered bootgrid-table" aria-busy="false">  
                                                  <thead>  
                                                       <tr>
                                                            <th data-column-id="img" class="text-left"><a class="column-header-anchor "><span class="text" >Картинка</span><span class="icon glyphicon "></span></a></th>
                                                            <th data-column-id="name" class="text-left"><a class="column-header-anchor sortable"><span class="text">ФИО</span><span class="icon glyphicon "></span></a></th>
                                                            <th data-column-id="email" class="text-left"><a class="column-header-anchor sortable"><span class="text">E-mail</span><span class="icon glyphicon "></span></a></th>
                                                            <th data-column-id="text" class="text-left"><a class="column-header-anchor "><span class="text">Текст задачи</span><span class="icon glyphicon "></span></a></th>
                                                        </tr>  
                                                  </thead>  
                                                  <tbody>
                                                    <tr data-row-id="0">
                                                        <td class="text-left"><img src="" id="preview" width="150"></td>
                                                        <input type="hidden" id="imgItem" name="img" value="">
                                                        <td class="text-left" id="Sname">Иванов Иван</td>
                                                        <td class="text-left" id="Semail">ivan@mail.ru</td>
                                                        <td class="text-left" id="Stext">Купить яблоки.</td>
                                                    </tr>
                                                    </tbody>  
                                             </table>  
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Редактировать</button>
                                        <button type="submit" class="btn btn-success">Добавить</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <!-- Modal -->

                            </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>

            <script>
                $(document).ready(function() {

                    $("#preView").click(function() {
                        var name = $.trim($("#name").val());
                        var email = $.trim($("#email").val());
                        var text = $.trim($("#text").val());
                        if (name == '' || email == '' || text == '') {
                            alert("Пожалуйста, заполните все поля!");
                            return false;
                        }
                        $("#Sname").text(name);
                        $("#Semail").text(email);
                        $("#Stext").text(text);

                        var re = new RegExp();
                        re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

                        if(!re.test(email)){
                           alert("Неправильный e-mail!");
                           return false;
                        }

                    });


                    $('#upload_image').on('submit', function(event) {

                        $('.live-preview-form').formValidation({
                            fields: {
                                image_upload: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Выберите изображение'
                                        },
                                        file: {
                                            extension: 'jpeg,jpg,png,gif',
                                            type: 'image/jpeg,image/png,image/gif',
                                            maxSize: 2097152,   // 2048 * 1024
                                            message: 'Выбранный файл не поддерживается'
                                        }
                                    }
                                }
                            }
                        });


                        event.preventDefault();
                        $.ajax({
                            url:"/task/load",
                            method:"POST",
                            data:new FormData(this),
                            contentType:false,
                            cache:false,
                            dataType:'text',
                            processData:false,
                                success:function(data){
                                    $('#preview').attr('src', data);
                                    $("#imgItem").attr('value', data);
                                }
                        })
                    });

                });
            </script>
        </div>
    </div>
</div>

