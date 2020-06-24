<?php
include_once 'header.php';
include_once 'DataBase.php';
?>
<body>
<div class="container">
    <div class="row justify-content-center text-center">
        <div class="col-lg-9">
            <h1 >Список постов</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Добавить запись</button>
        </div>
    </div>
    <div class="row">
        <?php
        $db =  DataBase::getDB();
        $posts = $db->Select('posts');
        foreach ($posts AS $post) {
        ?>
        <div class="col-lg-4">
            <div class="card mb-4 mt-5 shadow-lg">
                <img class="card-img-top"  src="https://via.placeholder.com/200x125?text=<?php echo $post['title']?>">
                <div class="card-body">
                    <div class="card-text">
                        <p> <?php echo $post['content'] ?> </p>
                    </div>
                    <button class="btn btn-danger" data-id="<?php echo $post['id'];?>"> Удалить пост</button>
                </div>
            </div>
        </div>
    <?php }?>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Новый пост</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="index.php" method="post">
            <div class="modal-body">

                    <div class="form-group">
                        <label for="title" class="col-form-label">Название</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-form-label">Сообщение</label>
                        <textarea class="form-control" id="content" name="content"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button class="btn btn-primary" type="submit" name="submit">Отправить пост</button>
            </div>
            </form>
        </div>
    </div>
</div>

</body>

<?php
if(isset($_POST['submit']))
{
    $value = array();
    if(isset($_POST['title']) && isset($_POST['content']))
    {
        $value['title'] = $_POST['title'];
        $value['content'] = $_POST['content'];
        $db->Insert('posts', $value);
        exit("<meta http-equiv='refresh' content='0; url= /index.php'>");
    }
}

