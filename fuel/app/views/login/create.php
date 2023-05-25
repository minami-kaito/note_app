<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <h1>アカウント作成</h1>
    <?php echo Form::open(array('action' => 'user/create', 'method'=>'post')); ?>
    <div>
        <?php echo Form::label('', 'user_name'); ?>
        <?php echo Form::input('user_name', '', array('placeholder'=>'名前')); ?>
    </div>
    <br>
    <div>
        <?php echo Form::label('', 'email'); ?>
        <?php echo Form::input('email', '', array('placeholder'=>'メールアドレス')); ?><br>
        <?php echo Form::input('email_check', '', array('placeholder'=>'メールアドレスの確認')); ?>
    </div>
    <br>
    <div>
        <?php echo Form::label('', 'password'); ?>
        <?php echo Form::password('password', '', array('placeholder'=>'パスワード')); ?><br>
        <?php echo Form::password('password_check', '', array('placeholder'=>'パスワードの確認')); ?>
    </div>
    <?php echo isset($error) ? $error : '<br>'; ?>
    <?php echo isset($result) ? $result : '<br>'; ?>
    <div>
        <?php echo Html::anchor('user/index', '戻る'); ?>
        <?php echo Form::submit('submit', '作成する'); ?>
    </div>
    <?php echo Form::close(); ?>
</body>

</html>