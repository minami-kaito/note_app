<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>

<body>
    <h1>アカウント情報のリセット</h1>
    <?php echo Form::open(array('action' => 'user/reset', 'method' => 'post')); ?>
    
        <article>
            <?php echo Form::hidden('email', $email); ?>
            新しいパスワードを入力してください
            <?php echo Form::label('', 'password'); ?>
            <?php echo Form::password('password', '', array('placeholder' => '新しいパスワード')); ?><br>
            <?php echo Form::password('password_check', '', array('placeholder' => '新しいパスワードを再入力')); ?>
        </article>
        <div>
            <?php echo Html::anchor('user/index', 'ホームに戻る'); ?>
            <?php echo Form::submit('submit', '変更する'); ?>
        </div>
        <div><?php echo isset($error) ? $error : ''; ?></div>
    
    <?php echo Form::close(); ?>
</body>

</html>