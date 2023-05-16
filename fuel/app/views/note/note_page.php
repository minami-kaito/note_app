<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <?php echo Form::open(array('action' => 'note/create', 'method'=>'post')); ?>
    <?php $result = DB::select('title', 'content')->from('notes')->as_assoc()->execute();
    <div>
        <?php echo Form::label('', 'title'); ?>
        <?php echo Form::input('title', ''); ?>
        <?php echo '作成者：' .Auth::get('user_name'); ?>
        更新日時
        設定メニュー
    </div>
    <div>タグエリア</div>
    <div>
        メニューアイコン, 
        <?php echo Form::submit('submit', '保存'); ?> 
        文字設定メニュー, 
        共有メニュー
    </div>
    <br>
    <div>
        <?php if(isset($aiueo)){echo $aiueo;} ?>
    </div>
    <div>
        <?php echo Form::textarea('content', '', array('rows' => 55, 'cols' => 200)); ?>
    </div>
    <?php echo Form::close(); ?>
</body>
</html>