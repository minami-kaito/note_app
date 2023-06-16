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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
    <?php echo Asset::css('style.css'); ?>
    <title>ノートアプリ</title>
</head>

<body>
    <?php echo Form::open(array('action' => 'note/save', 'method' => 'post')); ?>
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
            <p class="input-group input-group-lg">
            <span class="input-group-text" id="inputGroup-sizing-lg">title</span>
                <?php echo Form::label('', 'title'); ?>
                <?php echo Form::input('title', $result[0]['title'], array('class' => "form-control", 'aria-label' => "Sizing example input", 'aria-describedby' => "inputGroup-sizing-lg")); ?>
                <?php echo '&emsp;作成者 : ' . $result[0]['user_name']; ?>
                <br>
                <?php echo '&emsp;更新日時 : ' .$result[0]['updated_at']; ?>
            </p>
            <p>
            <div class="mb-2">
                <!-- タグ追加 -->
                <?php echo Form::label('', 'tag'); ?>
                <?php echo Form::input('tag', '', array('placeholder' => '# でタグの追加')); ?>
                <div>
                <?php echo isset($tag_error) ? $tag_error : ''; ?>
                </div>
            </div>
                <div>
                <!-- タグ表示 -->
                <?php if ($result[0]['tag_name'] !== null) : ?>
                    <i class="bi bi-tags-fill"></i>
                    <?php $tag_name = explode(',', $result[0]['tag_name']); ?>
                        <?php foreach ($tag_name as $name) : ?>
                            <?php echo '<span class="badge rounded-pill bg-secondary">' .$name;?>
                            &nbsp;
                            <?php echo Html::anchor(Uri::create('note/delete_tag', array(), array('tagname' => $name, 'noteid' => $current_note)), '<i class="bi bi-x-circle"></i>'); ?>
                            </span>
                        <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </p>
            </div>
            <div class="col-3">
                <div class="mx-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <p>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#page-setting" aria-expanded="false" aria-controls="page-setting">
                        <i class="bi bi-gear"></i></br><span class="icon">&ensp;設定&ensp;</span>
                        </button>
                    </p>
                    <div class="collapse" id="page-setting">
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
    <!-- ノートメニュー -->
    <div class="container">
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#note-menu" aria-expanded="false" aria-controls="note-menu">
                <i class="bi bi-list"></i>
                <div class="small">メニュー</div>
            </button>
                <div class="collapse" id="note-menu">
                <div class="card card-body">
                <div class="note-menu"><?php echo Html::anchor('note/create', '新規ノート作成'); ?> </div>
                <div class="note-menu"><?php echo Html::anchor(Uri::create('note/delete', array(), array('noteid' => $current_note)), 'このノートを削除する'); ?></div>
                <div class="note-menu"><?php echo Html::anchor(Uri::create('note/restoration', array(), array('noteid' => $current_note)), '変更履歴から復元する'); ?></div>
                </div>
                </div>
        </div>               
        <div class="col-8">
            文字設定メニュー
            <?php echo Form::button('submit', '<i class="bi bi-pencil-square"></i><div class="small">&nbsp;保存&nbsp;</div>', array('class' => "btn btn-success")); ?>
        </div>
        <div class="col-2">
            <?php if ($result[0]['share_flag'] === 0) : ?>
                <div class="lock">
                <i class="bi bi-lock"></i><span class="share-text">プライベート</span>
                </div>
            <?php elseif ($result[0]['share_flag'] === 1) : ?>
                <div class="unlock">
                <i class="bi bi-unlock"></i><span class="share-text">共有中</span>
                </div>
            <?php endif; ?>
            <div class="share-switch">
            <div class="form-check form-switch">
                <?php echo Form::hidden('share', 0); ?>
                <?php echo Form::label('共有する', 'share', array('class' => 'form-check-label', 'for' => 'flexSwitchCheckDefault')); ?>
                <?php echo Form::input('share', 1, array('class' => 'form-check-input', 'type' => 'checkbox', 'id' => 'flexSwitchCheckDefault', ($result[0]['share_flag'] ? 'checked' : ''))); ?>
            </div>
            </div>
            <div class="mt-2">
            <div class="share-url">
                <?php if($result[0]['share_flag']): ?>
                <?php echo Form::hidden('copy', Uri::create('note/browse', array(), array('noteid' => $current_note)), array('data-bind' => 'value: textToCopy', 'id' => 'myInput')); ?>
                <?php echo Form::button('copy', 'URLをコピー', array('class' => 'btn btn-outline-info rounded-pill', 'data-bind' => 'click: copyText')); ?>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
    </div>

    <div class="text-center">
        <?php echo (isset($error)) ? $error : ''; ?>
        <?php echo (isset($result_version)) ? $result_version : ''; ?>
        <?php echo (isset($result_save)) ? $result_save : ''; ?>
    </div>

    <div class="mx-4">
        <label for="exampleFormControlTextarea1" class="form-label"></label>
        <?php echo Form::textarea('content', $result[0]['content'], array('class' => 'form-control', 'id' => 'exampleFormControlTextarea1', 'rows' => 35)); ?>
        <?php echo Form::hidden('note_id', $result[0]['note_id']); ?>
    </div>
    <?php echo Form::close(); ?>
    <script src="https://unpkg.com/notie"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js"></script>
    <?php echo Asset::js('copy.js', array('type' => 'module')); ?>
</body>

</html>