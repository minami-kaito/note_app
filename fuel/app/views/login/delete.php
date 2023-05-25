<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <?php echo Form::open(array('action' => 'user/delete', 'method'=>'post')); ?>
    <h1>以下のアカウントを削除しますか？</h1>
    <br>
    <div><?php echo  isset($error) ? $error : ''; ?></div>
    <div>名前</div>
    <div><?php echo Auth::get('user_name'); ?></div>
    <div>メールアドレス</div>
    <div>
        <?php $current_email = Auth::get('email'); ?>
        <?php echo $current_email; ?>
        <?php echo Form::hidden('email', $current_email); ?>
    </div>
    <br>
    <br>
    <div><?php echo Html::anchor(Input::referrer(), '戻る'); ?></div>
    <div><?php echo Form::submit('submit', '削除する'); ?></div>
</body>
</html>