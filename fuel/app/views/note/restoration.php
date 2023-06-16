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
    <h1>履歴の復元</h1>

    <!-- 上部メニュー -->
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-3">
                <div class="mx-4">
                    <?php echo Html::anchor('note/home', '<i class="bi bi-house"></i></br><span class="icon">ホーム</span>', array('class' => 'btn btn-outline-secondary')); ?>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-3">
                <div class="mx-4">
                <div class="d-flex flex-row-reverse bd-highlight">
                <div class="p-2 bd-highlight">
                    <p>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
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

     <!-- 履歴一覧 -->
    <div class="container">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="note-center">履歴の日時</th>
          <th scope="col" class="note-center">内容</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($versions)): ?>
            <?php foreach ($versions as $ver): ?>
        <tr>
          <td>
            <?php echo Html::anchor(Uri::create('note/restoration', array(), array('verid' => $ver['version_id'], 'noteid' => $ver['note_id'])), $ver['version_at']); ?>
          </td>
          <td>
            <div class="version-content">
            <?php echo $ver['version_content']; ?>
            </div>
        </td>
        </tr>
            <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    </div>
    </div>
    <div class="m-5">
        <?php echo Html::anchor(Uri::create(Input::referrer(), array()), '<i class="bi bi-arrow-return-left"></i>&emsp;戻る', array('type' => 'button', 'class' => 'btn btn-secondary')); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>