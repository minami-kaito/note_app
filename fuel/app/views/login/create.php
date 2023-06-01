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
    <?php echo Asset::css('style.css'); ?>
    <title>ノートアプリ</title>
</head>
<body>
    <?php echo Form::open(array('action' => 'user/create', 'method'=>'post')); ?>
    <svg class="bd-placeholder-img mw-100" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Max-width 100%"></svg>
    <div class="container">

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>アカウント作成</h1>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('ユーザー名', 'user_name', array('for' => "val1", 'class' => "form-label")); ?>
                <?php echo Form::input('user_name', '', array('class' => 'form-control', 'id' => 'val1')); ?>
                <?php echo isset($error_user_name) ? $error_user_name : ''; ?>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('メールアドレス', 'email', array('for' => "val2", 'class' => "form-label")); ?>
                <?php echo Form::input('email', '', array('class' => 'form-control', 'id' => 'val2')); ?>
                <?php echo isset($error_email) ? $error_email : ''; ?>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('', 'email_check', array('for' => "val3", 'class' => "form-label")); ?>
                <?php echo Form::input('email_check', '', array('class' => 'form-control', 'id' => 'val3', 'placeholder'=>'メールアドレスの確認')); ?>
                <?php echo isset($error_email) ? $error_email : ''; ?>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('パスワード', 'password', array('for' => "val4", 'class' => "form-label")); ?>
                <?php echo Form::password('password', '', array('class' => 'form-control', 'id' => 'val4')); ?>
                <?php echo isset($error_password) ? $error_password : ''; ?>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php echo Form::label('', 'password_check', array('for' => "val5", 'class' => "form-label")); ?>
                <?php echo Form::password('password_check', '', array('class' => 'form-control', 'id' => 'val5', 'placeholder' => 'パスワードを再入力')); ?>
                <?php echo isset($error_password) ? $error_password : ''; ?>
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
                <?php echo isset($result) ? $result : ''; ?>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-2">
                <div class="text-centor">
                    <?php echo Html::anchor('user/index', '戻る', array('class' => 'btn btn-primary')); ?>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-2">
            <div class="text-centor">
            <?php echo Form::submit('submit', '作成する', array('class' => 'btn btn-primary')); ?>
            </div>
            </div>
            <div class="col-2"></div>
        </div>
        </div> 
    </div>
    <?php echo Form::close(); ?>
</body>
</html>