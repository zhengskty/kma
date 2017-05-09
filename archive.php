<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	 <!-- Start the Loop. -->
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 	<!-- Display the Title as a link to the Post's permalink. -->

 	<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>


 	<!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->

 	<small><?php the_time('F jS, Y'); ?> by <?php the_author_posts_link(); ?></small>


 	<!-- Display the Post's content in a div box. -->

 	<div class="entry">
 		
 	</div>


 	<!-- Display a comma separated list of the Post's Categories. -->

 	<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>
 	</div> <!-- closes the first div box -->


 	<!-- Stop The Loop (but note the "else:" - see next line). -->

 <?php endwhile; else : ?>


 	<!-- The very first "if" tested to see if there were any Posts to -->
 	<!-- display.  This "else" part tells what do if there weren't any. -->
 	<p><?php _e( '没有文章' ); ?></p>


 	<!-- REALLY stop The Loop. -->
 <?php endif; ?>
	
<?php
    the_posts_pagination( array(
        'prev_text'          =>上页,
        'next_text'          =>下页,
        'before_page_number' => '<span class="meta-nav screen-reader-text">第 </span>',
        'after_page_number' => '<span class="meta-nav screen-reader-text"> 页</span>',
    ) );
?>

	
	
	
	
	
	


<?php get_footer(); ?>
