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
                <?php echo Form::input('title', $result[0]['title'], array('class' => "form-control", 'aria-label' => "Sizing example input", 'aria-describedby' => "inputGroup-sizing-lg", 'disabled' => '')); ?>
                <?php echo '&emsp;作成者 : ' . $result[0]['user_name']; ?>
                <br>
                <?php echo '&emsp;更新日時 : ' .$result[0]['updated_at']; ?>
            </p>
            <p>
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

    <!-- ノートメニュー -->
    <div class="container">
        <div class="row">
            <div class="col-2"></div>               
            <div class="col-8"></div>
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
            </div>
        </div>
    </div>
            
    <div class="m-4">
        <label for="exampleFormControlTextarea1" class="form-label"></label>
        <?php echo Form::textarea('content', $result[0]['content'], array('class' => 'form-control', 'id' => 'exampleFormControlTextarea1', 'rows' => 35, 'disabled')); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>