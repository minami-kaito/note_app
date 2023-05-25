<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <h1>ログイン</h1>
    <?php echo Form::open('user/login'); ?>
    <div>
        <?php echo Form::label('', 'email'); ?>
        <?php echo Form::input('email', '', array('placeholder'=>'メールアドレス')); ?>
    </div>
    <br>
    <div>
        <?php echo Form::label('', 'password'); ?>
        <?php echo Form::password('password', '', array('placeholder'=>'パスワード')); ?>
    </div>
    <div>
        <?php echo Html::anchor('user/reset', 'パスワードを忘れた場合'); ?>
    </div>
    <div><?php echo isset($login_error) ? $login_error : '<br>'; ?></div>
    <div><?php echo isset($result) ? $result : '<br>'; ?></div>
    <div><?php echo Form::submit('submit', 'ログインする'); ?></div>
    <br>
    <br>
    <div>
        <?php echo Html::anchor('user/create', 'アカウントを作成する'); ?>
    </div>
    <?php echo Form::close(); ?>
</body>
</html>