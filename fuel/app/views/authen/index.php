<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <?php echo Form::open('authenticator/check'); ?>
    <div>メールアドレスを入力してください</div>
    <div>
        <?php echo Form::label('', 'email'); ?>
        <?php echo Form::input('email'); ?>
    </div>
    <div>アプリに表示されている6桁のコードを入力してください</div>
    <div>
        <?php echo Form::label('', 'onecode'); ?>
        <?php echo Form::input('onecode'); ?>
    </div>
    <?php echo isset($error) ? $error : ''; ?>
    <div>
        <?php echo Html::anchor('user/index', 'ホームに戻る'); ?>
        <?php echo Form::submit('submit', '認証する'); ?>
    </div>
    <?php echo Form::close(); ?>
</body>
</html>