<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo Asset::css('sanitize.css'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <?php echo Asset::css('style.css'); ?>
    <title>ノートアプリ</title>
</head>

<body>
    <?php echo Form::open(array('action' => 'note/search', 'method' => 'get')); ?>
    <svg class="bd-placeholder-img mw-100" width="100%" height="30" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Max-width 100%"></svg>

    <!-- 上部メニュー -->
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-3">
                <div class="mx-4">
                    <?php echo Html::anchor('note/home', '<i class="bi bi-house"></i></br><span class="icon">ホーム</span>', array('class' => 'btn btn-outline-secondary')); ?>
                </div>
            </div>
            <div class="col-6">
            <div class="my-3">
                <div class="input-group mb-3">
                <?php echo Form::input('search', '', array('class' => 'form-control', 'aria-describedby' => "button-addon2", 'placeholder' => 'タイトル, タグで検索')); ?>
                <?php echo Form::button('submit', '<i class="bi bi-search"></i>', array('class' => "btn btn-outline-secondary", 'type' => 'submit', 'id' => "button-addon2")); ?></span>
            </div>
            <p class="text-center">
                <?php echo isset($search_empty) ? $search_empty : ''; ?>
                <?php echo isset($delete_result) ? $delete_result : ''; ?>
            </p>
            </div>
            </div>
            <div class="col-3">
                <div class="mx-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <p>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-gear"></i></br><span class="icon">&ensp;設定&ensp;</span>
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <!-- 設定メニュー -->
                        <div class="setting-menu">
                        <div><?php echo '名前：' . Auth::get('user_name'); ?></div>
                        <div><?php echo isset($result_name) ? $result_name : ''; ?></div>
                        <div><?php echo Auth::get('email'); ?></div>
                        <br>
                        <div><?php echo Html::anchor('user/change_name', '名前の変更'); ?></div>
                        <div><?php echo Html::anchor('user/change_pass', 'パスワードの変更'); ?></div>
                        <div><?php echo Html::anchor('authenticator/change', '認証の設定'); ?></div>
                        <div><?php echo Html::anchor('user/logout', 'ログアウトする'); ?></div>
                        <br>
                        <div><?php echo Html::anchor('user/delete', 'アカウント削除'); ?></div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="new-note">
                    <?php echo Html::anchor('note/create', '<i class="bi bi-file-earmark-plus"></i>&ensp;新規ノート作成', array('class' => 'btn btn-secondary')); ?>
                </div>
            </div>
            <div class="col-7"></div>
        </div>
    </div>

    <!-- ノート一覧 -->
    <div class="container">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="note-center">ノートタイトル</th>
          <th scope="col" class="note-center">閲覧のみ</th>
          <th scope="col" class="note-center">更新日時</th>
          <th scope="col" class="note-center">削除する</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($result)): ?>
            <?php foreach ($result as $note_list): ?>
        <tr>
          <td>
            <div class="note-title">
            <?php echo Html::anchor(Uri::create('note/page', array(), array('noteid' => $note_list['note_id'])), $note_list['title']); ?>
            <div class="tag-list">
                <!-- タグ表示 -->
                <?php if ($note_list['tag_name'] !== null): ?>
                    <?php $tag_name = explode(',', $note_list['tag_name']);?>
                    <?php foreach ($tag_name as $name): ?>
                        <?php echo '<span>#' . $name . '</span>'; ?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            </div>
          </td>
          <td class="note-center"><?php echo Html::anchor(Uri::create('note/browse', array(), array('noteid' => $note_list['note_id'])), '閲覧モード', array('class' => 'btn btn-outline-info')); ?></td>
          <td class="note-center"><?php echo $note_list['updated_at']; ?></td>
          <td class="note-center"><?php echo Html::anchor(Uri::create('note/delete', array(), array('noteid' => $note_list['note_id'])), '<i class="bi bi-trash"></i>'); ?></td>
        </tr>
            <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    </div>
    </div>

    <br>
    <?php echo Form::close(); ?>

    <div id="container"></div>
    
    <script>
        const js_array = JSON.parse('<?php echo json_encode($result); ?>');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Load React. -->
    <!-- Note: when deploying, replace "development.js" with "production.min.js". -->
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

    <!-- Load our React component. -->
    <?php echo Asset::js('home.js', array('type' => 'module')); ?>
</body>
</html>