<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <h1>アカウント情報の変更</h1>
    <?php echo Form::open(array('action' => 'user/change', 'method'=>'post')); ?>
    <div>
        <?php echo Form::label('', 'reset'); ?>
        <?php echo Form::checkbox('reset_email', 'メールアドレスを変更する'); ?>
    </div>
    <div>
        <?php echo Form::label('', 'email'); ?>
        <?php echo Form::input('email', '', array('placeholder'=>'メールアドレス')); ?><br>
        <?php echo Form::input('email_check', '', array('placeholder'=>'メールアドレスの確認')); ?>
    </div>
    <br>
    <div>
        <?php echo Form::label('', 'reset'); ?>
        <?php echo Form::checkbox('reset_password', 'パスワードを変更する'); ?>
    </div>
    <div>
        <?php echo Form::label('', 'password'); ?>
        <?php echo Form::password('password', '', array('placeholder'=>'パスワード')); ?><br>
        <?php echo Form::password('password_check', '', array('placeholder'=>'パスワードの確認')); ?>
    </div>
    <br>
    <div>
        <?php echo Html::anchor('user/index', 'ホームに戻る'); ?>
        <?php echo Form::submit('submit', '変更する'); ?>
    </div>
    <?php echo Form::close(); ?>
</body>
</html>