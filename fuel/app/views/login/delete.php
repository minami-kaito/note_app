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
    <?php echo Form::open(array('action' => 'user/delete', 'method'=>'post')); ?>
    <svg class="bd-placeholder-img mw-100" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Max-width 100%"></svg>
    <div class="container">

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>以下のアカウントを削除しますか?</h1>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="text-centor">
                <p class="fs-4">名前 : <?php echo Auth::get('user_name'); ?></p>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="text-centor">
                <?php echo Form::hidden('email', Auth::get('email')); ?>
                <p class="fs-4">メールアドレス : <?php echo Auth::get('email'); ?></p>
                </div>
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
    
        <div class="mb-3">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-2">
                <div class="text-centor">
                    <?php echo Html::anchor('note/home', '戻る', array('class' => 'btn btn-primary')); ?>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-2">
            <div class="text-centor">
            <?php echo Form::submit('submit', '削除する', array('class' => 'btn btn-primary')); ?>
            </div>
            </div>
            <div class="col-2"></div>
        </div>
        </div>
    </div>
    </body>
</html>