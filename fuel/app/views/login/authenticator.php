<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <div>以下のQRコードをGoogle authenticatorで読み取り、コードを取得してください</div>
    <div>
        <?php echo '<img src="'.$qrcodeurl.'" /><br><br>'; ?>
    </div>
    <br>
    <div>取得した6桁のコードを入力してください</div>
    <?php echo Form::open('user/reset'); ?>
    <div>
        <?php echo Form::label('', 'onecode'); ?>
        <?php echo Form::input('onecode'); ?>
    </div>
    <?php if(isset($error)){echo $error;} ?>
    <div>
        <?php echo Form::submit('submit', '認証する'); ?>
    </div>
    <br>
    <div>
        <?php echo Html::anchor('user/reset', '生成し直す'); ?>
    </div>
    <?php echo Form::close(); ?>
</body>
</html>