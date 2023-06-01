<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>
<body>
    <h1>ノートの検索結果</h1>
    <div>
    <?php echo Form::open(array('action' => 'note/search', 'method' => 'get')); ?>
    <div><?php echo Html::anchor('note/home', 'ホーム'); ?></div>
    <div>
        <?php echo Form::input('search'); ?>
        <?php echo Form::submit('submit', '検索'); ?>
    </div>
    <div>
        <?php echo '検索ワード：' .$search_text; ?>
    </div>
    <br>
    <!-- 設定メニュー -->
    <article>
        <div><?php echo '名前：' . Auth::get('user_name'); ?></div>
        <div><?php echo Auth::get('email'); ?></div>
        <div><?php echo Html::anchor(Uri::create('user/change', array(), array('item' => 'name')), '名前の変更'); ?></div>
        <div><?php echo Html::anchor(Uri::create('user/change', array(), array('item' => 'password')), 'パスワードの変更'); ?></div>
        <div><?php echo Html::anchor('user/logout', 'ログアウトする'); ?></div>
        <div><?php echo Html::anchor('user/delete', 'アカウント削除'); ?></div>
    </article>
    <br>
    <div>1ページ目</div>
    <div>
        <?php foreach($result as $result) : ?>
            <li>
            <?php echo Html::anchor(Uri::create('note/page', array('id' => $result['note_id']), array('noteid' => ':id')), $result['title']); ?>
            <?php echo '  '; ?>
            <div>
            <!-- タグ表示 -->
            <?php if ($result['tag_name'] !== null) : ?>
                <?php $tag_name = explode(',', $result['tag_name']); ?>
                    <?php foreach ($tag_name as $name) : ?>
                        <?php echo '#' .$name; ?>
                    <?php endforeach; ?>
            <?php endif; ?>
            </div>
            <?php echo Html::anchor(Uri::create('note/browse', array('id' => $result['note_id']), array('noteid' => ':id')), '閲覧モード'); ?>
            <?php echo $result['updated_at']; ?>
            <?php echo Html::anchor(Uri::create('note/delete', array('id' => $result['note_id']), array('noteid' => ':id')), '削除する'); ?>
            </li>
        <?php endforeach; ?>
    </div>
    <br>
    <div>1/3ページ</div>
    <?php echo Form::close(); ?>
</body>
</html>