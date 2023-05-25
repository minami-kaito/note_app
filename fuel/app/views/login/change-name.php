<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>

<body>
    <h1>名前の変更</h1>
    <?php echo Form::open(array('action' => 'user/change_name', 'method' => 'post')); ?>
    <article>
        <div><?php echo '現在の名前：' . Auth::get('user_name'); ?></div>
        <br>
        <div>新しい名前を入力してください</div>
        <div><?php echo Form::label('', 'user_name'); ?></div>
        <div><?php echo Form::input('user_name', ''); ?></div>
    </article>
    <div><?php echo isset($error) ? $error : ''; ?></div>
    <div>
        <?php echo Html::anchor('note/home', '戻る'); ?>
        <?php echo Form::submit('submit', '変更する'); ?>
    </div>
    <?php echo Form::close(); ?>
</body>
</html>