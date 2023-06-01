<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
<div>この履歴のデータに戻しますか</div>
    <?php echo Form::open(array('action' => 'note/restoration', 'method' => 'post')); ?>

    <div><?php echo $result[0]['version_at']; ?></div>
    <div><?php echo $result[0]['version_content']; ?></div>
    <div>
        <?php echo Html::anchor(Uri::create('note/page', array(), array('noteid' => $result[0]['note_id'])), '戻る'); ?>
    </div>
    <div>
        <?php echo Form::hidden('confirm', 'ok'); ?>
        <?php echo Form::hidden('note_id', $result[0]['note_id']); ?>
        <?php echo Form::hidden('version_id', $result[0]['version_id']); ?>
        <?php echo Form::submit('submit', '復元する'); ?>
    </div>
    
    <?php echo Form::close(); ?>
</body>
</html>