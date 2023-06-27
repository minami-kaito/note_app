<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Lexical Playground" />
    <?php echo Asset::css('sanitize.css'); ?>
    <link rel="apple-touch-icon" sizes="180x180" href="data:image/png;base64,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" />
    <link rel="icon" type="image/png" sizes="32x32" href="data:image/png;base64,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" />
    <link rel="icon" type="image/png" sizes="16x16" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABp1BMVEUzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzMzM1NTUxMTEwMDAuLi5NTU2ysrK8vLylpaU/Pz8yMjI4ODhbW1tjY2NiYmJxcXGnp6fc3NyWlpZgYGA2NjZHR0fa2tro6Off3t3f393f397d3d3c3NuhoKDFxcWvr6/T09NAQEBISEje3t6EhYhVYXdYZoBeY2x+fn59fXxaX2pvdH7GxsWPj4/X19dBQUHd3dxwdHtHaqxMdsNda4W/vry7urhVZoVpepjGxcOHh4dxdHpEYppKb7BNb61NZI5OZpJKbKtpd5HGxcSIiIhydXpSaZNbdqdOa59DXYpEXo5NaZ1weo3FxcR7e3uxsK7KycZsdYZKdMBJcrtyeYacm5nDw8OSkpJ4eHiAf39sbnJlbn5lbX1rbXCUlJTY2NhGRkbS0tLl5eXf39/g4ODh4N+hoaGsrKzLy8tSUlJRUVFmZma0tLTk5ORWVlY0NDRKSkqdnZ2jo6OTk5M9PT3////m2rllAAAAF3RSTlMFYNf92mQG7O9n1t38/tjfZfFrZt7gB5WyoRIAAAABYktHRIxsC9JDAAAAB3RJTUUH5QMHEToutLF4CQAAANxJREFUGNNjYGBkYhaHAmYWVjYGRnYYV0JCQpyDk4FLXFIKBKRlZOXkFRS5GXiUlFVAQFVNXUNTS5uXQVFHV0/fwNDIyNjE1MzcQpFB0tLK2sbWzt7B0cnZxdUNJODu4enl7ePr5x8QCBEwCgoOCQ0Lj4iMioYKxMTGxSckJiWnQAU0UtPSMzKzsnNyoVqs8vILCouKS+xNS8uAAorlFZVVVdU1NUa1pnX1CooMPNoyDSDQ2NTcUtvaxsvAJy4JBlLtHZ1d3Yr8DAIcMM8BRcUFhRjYhEXE4UBUSAwABoU3nzKJncsAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjEtMDMtMDdUMTc6NTg6NDYrMDE6MDCYwSvTAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIxLTAzLTA3VDE3OjU4OjQ2KzAxOjAw6ZyTbwAAAFd6VFh0UmF3IHByb2ZpbGUgdHlwZSBpcHRjAAB4nOPyDAhxVigoyk/LzEnlUgADIwsuYwsTIxNLkxQDEyBEgDTDZAMjs1Qgy9jUyMTMxBzEB8uASKBKLgDqFxF08kI1lQAAAABJRU5ErkJggg==" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
    <link rel="stylesheet" href="/../../../../public/assets/lexical/main.a2d3ee50.css">
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
                            <?php echo '<i class="bi bi-x-circle" type="button" onclick="delete_tag(&#39;'.$name.'&#39;)"></i>'; ?>
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
        <div class="col-9">
        <span class="mx-3"><?php echo Html::anchor('note/create', '新規ノート作成', array('class' => 'btn btn-outline-primary')); ?></span> 
        <span class="mx-3"><?php echo Html::anchor(Uri::create('note/delete', array(), array('noteid' => $current_note)), 'このノートを削除する', array('class' => 'btn btn-outline-primary')); ?></span> 
        <span class="mx-3"><?php echo Html::anchor(Uri::create('note/restoration', array(), array('noteid' => $current_note)), '変更履歴から復元する', array('class' => 'btn btn-outline-primary')); ?></span> 
        </div>
        <div class="col-3">
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

    <div class="m-3">
        <div id="root"></div>
        <?php echo Form::hidden('content', $result[0]['content'], array('id' => 'lexical_text')); ?>
        <?php echo Form::hidden('note_id', $result[0]['note_id']); ?>
    </div>
    <?php echo Form::close(); ?>
    <script src="https://unpkg.com/notie"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/knockout/2.3.0/knockout-min.js"></script>
    <?php echo Asset::js('copy.js', array('type' => 'module')); ?>
    <script type="module" crossorigin src="./../../../../public/assets/lexical/main.ef29de94.js"></script>
    <script>
    function delete_tag(value) {
        const params = { // 渡したいパラメータをJSON形式で書く
            tagname: value,
            noteid: <?php echo $current_note; ?>,
        };
        const query_params = new URLSearchParams(params); 
        fetch('http://localhost/public/api/delete_tag.json?' + query_params)
        .then(async (response)=>{
            console.log('response : ',await response.json());
        }).catch((error)=>{
            console.log('error : ', error);
        });
    }
    function handleButtonClick(value) {
      console.log(value);
    }
    </script>
</body>

</html>
