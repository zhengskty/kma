	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>
<a href="<?php the_permalink() ?>"><img src="<?php echo wp_catch_first_image('m'); ?>" alt="" width="200px"  height="200px"></a>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->




</article><!-- #post-## -->
<?php endwhile ; ?>
<?php endif;?>


		</main><!-- .site-main -->
	</div><!-- .content-area -->
	






<?php if(have_posts()): while(have_posts()):the_post();  ?>
<h1 class="title"><?php the_title(); ?></h1>



<div class="content">
<?php the_content(); ?>
</div>
<div id="article-tag">
<?php the_tags('<strong>标签：</strong> ', ' , ' , ''); ?>
</div>
<?php endwhile ; ?>
<?php endif;?>
</div>



<!-- 调用第一张图片代码 -->
<a href="<?php the_permalink() ?>"><img src="<?php echo wp_catch_first_image('m'); ?>" alt="" width="200px"  height="200px"></a>





<?php 
    $sticky = get_option('sticky_posts'); 
    rsort( $sticky );//对数组逆向排序，即大ID在前 
    $sticky = array_slice( $sticky, 0, 5);//输出置顶文章数，请修改5，0不要动，如果需要全部置顶文章输出，可以把这句注释掉 
    query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) ); 
    if (have_posts()) :while (have_posts()) : the_post();     
?> 
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></li> 
<?php    endwhile; endif; ?> 
</ul>