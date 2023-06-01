<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <div><?php echo Html::anchor('note/home', 'ホーム'); ?></div>
    <div>
        <?php echo $result[0]['title']; ?>
        <?php echo '作成者 : ' .$result[0]['user_name']; ?>
        <?php echo '更新日時 : ' .$result[0]['updated_at']; ?>
    </div>
    <article>
        <div> 
            <!-- タグ表示 -->
            <?php if ($result[0]['tag_name'] !== null) : ?>
                <?php $tag_name = explode(',', $result[0]['tag_name']); ?>
                    <?php foreach ($tag_name as $name) : ?>
                        <?php echo '#' .$name; ?>
                    <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </article>
    <article>
    <?php $content = nl2br($result[0]['content']); ?>
    <?php echo $content; ?>
    </article>
</body>
</html>