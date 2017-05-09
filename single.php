<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage kma
 * @since kma 1.0
 */

get_header(); ?>


<div>

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













<?php comments_template(); ?>  

<?php get_footer(); ?>
