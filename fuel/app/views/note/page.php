<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ノートアプリ</title>
</head>

<body>
    <?php echo Form::open(array('action' => 'note/save', 'method' => 'post')); ?>
    <div><?php echo Html::anchor('note/home', 'ホーム'); ?></div>
    <br>
    <!-- 設定メニュー -->
    <article>
        <div><?php echo '名前：' . Auth::get('user_name'); ?></div>
        <div><?php echo Auth::get('email'); ?></div>
        <div><?php echo Html::anchor('user/change_name', '名前の変更'); ?></div>
        <div><?php echo Html::anchor('user/change_pass', 'パスワードの変更'); ?></div>
        <div><?php echo Html::anchor('user/logout', 'ログアウトする'); ?></div>
        <div><?php echo Html::anchor('user/delete', 'アカウント削除'); ?></div>
    </article>
    <br>
    <div>
        <?php echo Form::label('', 'title'); ?>
        <?php echo Form::input('title', $result[0]['title']); ?>
        <?php echo '作成者 : ' . $result[0]['user_name']; ?>
        更新日時
    </div>
    <article>
        <div>
            <!-- タグ表示 -->
            <?php if ($result[0]['tag_name'] !== null) : ?>
                <?php $tag_name = explode(',', $result[0]['tag_name']); ?>
                    <?php foreach ($tag_name as $name) : ?>
                        <?php echo '#' .$name; ?>
                        <?php echo Html::anchor(Uri::create('note/delete_tag', array(), array('tagname' => $name, 'noteid' => $current_note)), 'X'); ?>
                    <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div>
            <?php echo Form::label('', 'tag'); ?>
            <?php echo Form::input('tag', '', array('placeholder' => '#新しいタグを追加')); ?>
        </div>
        <div>
            <?php echo isset($tag_error) ? $tag_error : ''; ?>
        </div>
    </article>
    <div>
        <!-- ノートメニュー -->
        <?php echo Html::anchor('note/create', '新規ノート作成'); ?> 
        <?php echo Html::anchor(Uri::create('note/delete', array(), array('noteid' => $current_note)), 'このノートを削除する'); ?>
        <?php echo Html::anchor(Uri::create('note/restoration', array(), array('noteid' => $current_note)), '変更履歴から復元する'); ?>
        <?php echo Form::submit('submit', '保存'); ?>
        文字設定メニュー
        <br>
        <?php echo Form::label('共有しない', 'share'); ?>
        <?php echo Form::radio('share', 0, ($result[0]['share_flag'] ? false : true)); ?>

        <?php echo Form::label('共有する', 'share'); ?>
        <?php echo Form::radio('share', 1, ($result[0]['share_flag'] ? true : false)); ?>
    </div>
    <div>
        <?php if($result[0]['share_flag']): ?>
            <?php echo '共有URL : ' .Uri::create('note/browse', array(), array('noteid' => $current_note)); ?>
        <?php endif; ?> 
    </div>
    <br>
    <div>
        <?php echo (isset($error)) ? $error : ''; ?>
        <?php echo (isset($result_version)) ? $result_version : ''; ?>
        <?php echo (isset($result_save)) ? $result_save : ''; ?>
    </div>
    <div>
        <?php echo Form::textarea('content', $result[0]['content'], array('rows' => 55, 'cols' => 200)); ?>
        <?php echo Form::hidden('note_id', $result[0]['note_id']); ?>
    </div>
    <?php echo Form::close(); ?>
</body>

</html>