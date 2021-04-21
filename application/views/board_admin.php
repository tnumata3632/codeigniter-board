<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniterを使った掲示板 管理ページ</title>
    <?php echo link_tag('style.css'); ?>
</head>
<body>
<h1>ひと言掲示板 管理ページ</h1>
<?php if( !empty($error_message) ): ?>
	<ul class="error_message">
		<?php foreach( $error_message as $value ): ?>
			<li>・<?php echo $value; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
<hr>
<section>

<?php if ($this->session->admin_login): ?>

<form method="get" action="<?php echo site_url('download'); ?>">
    <select name="limit">
        <option value="">全て</option>
        <option value="10">10件</option>
        <option value="30">30件</option>
    </select>
    <input type="submit" name="btn_download" value="ダウンロード">
</form>

<?php if( !empty($message_array) ): ?>
<?php foreach( $message_array as $value ): ?>
<article>
    <div class="info">
        <h2><?php echo html_escape($value['view_name']); ?></h2>
        <time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
    </div>
    <p><?php echo nl2br(html_escape($value['message'])); ?></p>
</article>
<?php endforeach; ?>
<?php endif; ?>
<form method="get" action="<?php echo site_url('logout'); ?>">
    <input type="submit" name="btn_logout" value="ログアウト">
</form>

<?php else: ?>

<form method="post">
    <div>
        <label for="admin_password">ログインパスワード</label>
        <input id="admin_password" type="password" name="admin_password" value="">
    </div>
    <input type="submit" name="btn_submit" value="ログイン">
</form>

<?php endif; ?>

</section>
</body>
</html>