<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>

<body>
    <?php echo Form::open(array('action' => 'note/search', 'method' => 'get')); ?>
    <div><?php echo Html::anchor('note/home', 'ホーム'); ?></div>
    <div>
        <?php echo Form::input('search'); ?>
        <?php echo Form::submit('submit', '検索'); ?>
    </div>
    <div><?php echo isset($search_empty) ? $search_empty : ''; ?></div>
    <br>
    <!-- 設定メニュー -->
    <article>
        <div><?php echo '名前：' . Auth::get('user_name'); ?></div>
        <div><?php echo isset($result_name) ? $result_name : ''; ?></div>
        <div><?php echo 'ユーザーID : ' .Auth::get('user_id'); ?></div>
        <div><?php echo Auth::get('email'); ?></div>
        <div><?php echo Html::anchor('user/change_name', '名前の変更'); ?></div>
        <div><?php echo Html::anchor('user/change_pass', 'パスワードの変更'); ?></div>
        <div><?php echo Html::anchor('authenticator/change', '認証の設定'); ?></div>
        <div><?php echo Html::anchor('user/logout', 'ログアウトする'); ?></div>
        <div><?php echo Html::anchor('user/delete', 'アカウント削除'); ?></div>
    </article>
    <br>
    <div>
        <?php echo isset($delete_result) ? $delete_result : ''; ?>
    </div>
    <br>
    <div><?php echo Html::anchor('note/create', '新規ノート作成'); ?></div>
    <div>1ページ目</div>
    <div>
        <!-- ノートリスト表示 -->
        <?php if (isset($result)) : ?>        
            <?php foreach ($result as $note_list) : ?>
            <li>
                <?php echo Html::anchor(Uri::create('note/page', array(), array('noteid' => $note_list['note_id'])), $note_list['title']); ?>
                <!-- タグ表示 -->
                <?php if($note_list['tag_name'] !== null) : ?>
                    <?php $tag_name = explode(',', $note_list['tag_name']); ?>
                    <?php foreach ($tag_name as $name) : ?>
                        <?php echo '#' .$name; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <?php echo Html::anchor(Uri::create('note/browse', array(), array('noteid' => $note_list['note_id'])), '閲覧モード'); ?>
                <?php echo $note_list['updated_at']; ?>
                <?php echo Html::anchor(Uri::create('note/delete', array(), array('noteid' => $note_list['note_id'])), '削除する'); ?>
            </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <br>
    <div>1/3ページ</div>
    <?php echo Form::close(); ?>
</body>
</html>