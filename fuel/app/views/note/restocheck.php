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
    <h1>この履歴のデータに戻しますか</h1>
    <?php echo Form::open(array('action' => 'note/restoration', 'method' => 'post')); ?>

    <div class="container">
        <div class="my-4">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <p>この履歴の日時 : </p>
                <div class="text-centor">
                    <p class="fs-3"><?php echo $result[0]['version_at']; ?></p>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <p>復元する内容 : </p>
                    <div class="text-centor">
                        <p class="fs-4"><?php echo $result[0]['version_content']; ?></p>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-3"></div>
            <div class="col-6">
                <span class="button-left">
                    <?php echo Html::anchor(Input::referrer(), '<i class="bi bi-arrow-return-left"></i>&emsp;戻る', array('type' => 'button', 'class' => 'btn btn-secondary')); ?>
                </span>
                <span class="button-right">
                    <?php echo Form::hidden('confirm', 'ok'); ?>
                    <?php echo Form::hidden('note_id', $result[0]['note_id']); ?>
                    <?php echo Form::hidden('version_id', $result[0]['version_id']); ?>
                    <?php echo Form::button('submit', '復元する', array('class' => 'btn btn-primary btn-lg')); ?>
                </span>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    
    <?php echo Form::close(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>