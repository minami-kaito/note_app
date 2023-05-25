<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>

<body>
    <h1>パスワードの変更</h1>
    <?php echo Form::open(array('action' => 'user/change_pass', 'method' => 'post')); ?>
        <article>
            <div>新しいパスワードを入力してください</div>
            <div><?php echo Form::label('', 'password'); ?></div>
            <div><?php echo Form::password('password', '', array('placeholder' => '新しいパスワード')); ?></div>
            <div><?php echo Form::password('password_check', '', array('placeholder' => '新しいパスワードを再入力')); ?></div>
        </article>
        <div>
            <?php echo Html::anchor(Input::referrer(), '戻る'); ?>
            <?php echo Form::submit('submit', '変更する'); ?>
        </div>
        <div><?php echo isset($error) ? $error : ''; ?></div>
    
    <?php echo Form::close(); ?>
</body>

</html>