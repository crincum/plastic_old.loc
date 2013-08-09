<!-- You can start editing here. -->

<?php if ('open' == $post-> comment_status) : ?>

<h3 id="respond">Задайте вопрос хирургу</h3>
<?if (isset($_REQUEST['ispost'])) : //check normal comment except trackback and pingback?>
	<ol id="commentlist">
		<?php $count = 0;
		/*foreach ($comments as $comment) :*/?>
			<span class="authorlink">Спасибо, за вопрос.</span>&nbsp;<?php comment_type('', '(via Trackback)', '(via Pingback)'); ?>
			<div>Мы расмотрим его в ближайщее время и свяжемся с Вами по указанному электронному адресу.</div>

			<div>Дополнительные способы связи вы можете найти на странице <a href="/contacts">Контакты</a></div>

		<?php /*endforeach;*/ /* end for each comment */ ?>

	</ol>
<?endif;?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<div for="author">Ваше имя:</div><input type="text" class="textbox" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />

<div class="cleardiv"></div>

<div for="email">Ваш e-mail:</div><input type="text" class="textbox" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />

<div class="cleardiv"></div>

<p>Текст вопроса:</p>
<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
<div class="cleardiv"></div>
<p>
  <input name="submit" type="submit" id="submit" tabindex="5" value="Отправить" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // if you delete this the sky will fall on your head ?>