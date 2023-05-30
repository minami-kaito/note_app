<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <h1>履歴の復元</h1> 
    <?php foreach($versions as $ver) : ?>
        <div>
            <?php echo Html::anchor(Uri::create('note/restoration', array(),
             array('verid' => $ver['version_id'], 'noteid' => $ver['note_id'])), $ver['version_at']); ?>
        </div>
        <div>
            <?php echo $ver['version_content']; ?>
        </div>
        <br>
        <br>
    <?php endforeach; ?>
    <div>
        <?php echo Html::anchor(Uri::create('note/page', array(), array('noteid' => $note_id)), '戻る'); ?>
    </div>
</body>
</html>