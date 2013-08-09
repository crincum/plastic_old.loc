<?php get_header();?>
<script type="text/javascript">
	$('document').ready(function(){
		$('.entry').hide();
		$('.title').click(function(){
			$(this).next().slideToggle();
			return (false);
		});
	});
</script>
<div id="main">
	<div id="content">
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	        <div class="flower"></div><div class="post" id="post-<?php the_ID(); ?>">
            <h2 class="title"><a href="#" rel="bookmark" class="typeface-js" style="font-family: ArtScript;"><?php the_title(); ?></a></h2>
	<div class="entry">
              <?php the_content(); ?>
              <?php wp_link_pages(); ?>
      	</div>
      
	        </div>
      <?php endwhile; else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
      <?php endif; ?>
      <p align="center"><?php posts_nav_link(' - ','&#171; Newer','Older &#187;') ?></p>
	</div>
</div>
  <?php get_footer();
?>