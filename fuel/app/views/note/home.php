<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <div><?php echo Html::anchor('system/home', 'ホーム'); ?></div>
    <div><?php echo Form::input('text'); ?></div>
    <br>
    <div><?php echo Html::anchor('note/create', '新規ノート作成'); ?></div>
    <div>1ページ目</div>
    <div>ここにノート一覧テーブル</div>
    <div><?php echo Html::anchor('note/page_edit', 'ノート編集'); ?></div>

    <br>
    <div>1/3ページ</div>
    <?php if(!empty($aiueo)){echo $aiueo;} ?>
    <div><?php echo Html::anchor('user/logout', 'ログアウトする'); ?></div>
    <div><?php echo $this->user['email']; ?></div>

</body>
</html>