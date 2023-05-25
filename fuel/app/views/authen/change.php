<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
<div>あなたの現在のシークレットキーは以下のQRコードで登録されています。
    必要であればGoogle authenticatorで読み取り、コードを取得してください</div>
    <div>
        <?php echo isset($qrcodeurl) ? '<img src="'.$qrcodeurl.'" /><br><br>' : ''; ?>
        <?php echo isset($result) ? $result : ''; ?>
    </div>
    <br>
    <div>アプリに表示されている6桁のコードを入力してください</div>
    <?php echo Form::open('authenticator/test'); ?>
    <div>
        <?php echo Form::label('', 'onecode'); ?>
        <?php echo Form::input('onecode'); ?>
    </div>
    <div>
        <?php echo Form::submit('submit', '認証テスト'); ?>
    </div>
    <br>
    <div>
        <?php echo Html::anchor('authenticator/reset', 'QRコードを新しく生成する'); ?>
    </div>
    <?php echo Form::close(); ?>
    <br>
    <div><?php echo Html::anchor('note/home', 'ホームに戻る'); ?></div>
</div>
</body>
</html>