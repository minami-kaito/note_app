<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('sanitize.css'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <?php echo Asset::css('style.css'); ?>
    <title>ノートアプリ</title>
</head>

<body>
    <?php echo Form::open(array('action' => 'user/change_pass', 'method' => 'post')); ?>
    <svg class="bd-placeholder-img mw-100" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Max-width 100%"></svg>
    <div class="container">

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>パスワードの変更</h1>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('', 'password', array('for' => "val1", 'class' => "form-label")); ?>
                <?php echo Form::password('password', '', array('class' => 'form-control', 'id' => 'val1', 'placeholder' => '新しいパスワードを入力してください')); ?>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('', 'password_check', array('for' => "val2", 'class' => "form-label")); ?>
                <?php echo Form::password('password_check', '', array('class' => 'form-control', 'id' => 'val2', 'placeholder' => '新しいパスワードを再入力')); ?>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="text-center">
                <?php echo isset($error) ? $error : ''; ?>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        </div>

        <div class="container">
        <div class="row align-items-center">
            <div class="col-3"></div>
            <div class="col-6">
                <span class="button-left">
                    <?php echo Html::anchor('note/home', '<i class="bi bi-arrow-return-left"></i>&emsp;戻る', array('type' => 'button', 'class' => 'btn btn-secondary')); ?>
                </span>
                <span class="button-right">
                    <?php echo Form::button('submit', '変更する', array('class' => 'btn btn-primary btn-lg')); ?>
                </span>
            </div>
            <div class="col-3"></div>
            </div>
        </div>
        </div>
    </div>   
    <?php echo Form::close(); ?>
</body>

</html>