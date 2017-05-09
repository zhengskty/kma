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

<img src="<?php bloginfo('template_url');?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=150&w=200&zc=1" alt="<?php the_title(); ?>" class="thumbnail"/>
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->




</article><!-- #post-## -->
<?php endwhile ; ?>
<?php endif;?>


		</main><!-- .site-main -->
	</div><!-- .content-area -->
	
<?php
    the_posts_pagination( array(
        'prev_text'          =>上页,
        'next_text'          =>下页,
        'before_page_number' => '<span class="meta-nav screen-reader-text">第 </span>',
        'after_page_number' => '<span class="meta-nav screen-reader-text"> 页</span>',
    ) );
?>

	
	
	
	
	
	
	
	
	
	<a href="<?php the_permalink() ?>"><img src="<?php echo wp_catch_first_image('m'); ?>" alt="" width="200px"  height="200px"></a>
	
	<style>

	/** 等于或大于550px正常模式 **/
@media screen and (min-width: 550px) {
    .pagination {
        float: right;
    }
    .pagination a, .pagination a:visited {
        float: left;
        background: #fff;
        margin: 0 5px 10px 0;
        padding: 8px 11px;
        line-height: 100%;
        border: 1px solid #ebebeb;
        border-radius: 2px;
    }
    .pagination .current, .pagination .dots {
        background: #fff;
        float: left;
        margin: 0 5px 0 0;
        padding: 8px 11px;
        line-height: 100%;
        border: 1px solid #ebebeb;
        border-radius: 2px;
    }
    .pagination span.pages {}
    .pagination span.current, .pagination a:hover {
        background: #0088cc;
        color: #fff;
        border: 1px solid #0088cc;
    }
    .screen-reader-text, .pages  {
        display: none;
    }
}
/** 等于或小于550px用于移动设备 **/
@media screen and (max-width: 550px) {
    .pagination {
        background: #fff;
        border: 1px solid #ebebeb;
        border-radius: 2px;
    }
    .pagination .nav-links {
        min-height: 30px;
        position: relative;
        text-align: center;
    }
    .pagination .current .screen-reader-text {
        position: static !important;
    }
    .screen-reader-text {
        height: 1px;
        overflow: hidden;
        position: absolute !important;
    }
    .page-numbers {
        display: none;
        line-height: 25px;
        padding: 5px;
    }
    .pagination .page-numbers.current {
        text-transform: uppercase;
    }
    .pagination .current {
        display: inline-block;
    }
    .pagination .prev,
    .pagination .next {
        background: #0088cc;
        color: #fff;
        display: inline-block;
        height: 29px;
        line-height: 29px;
        overflow: hidden;
        padding: 2px 8px;
        position: absolute;
        border: 1px solid #0088cc;
    }
    .pagination .next {
        border-radius: 0 2px 2px 0
    }
    .pagination .prev {
        border-radius: 2px 0 0 2px;
    }
    .pagination .prev a,
    .pagination .next a{
        color: #fff;
        line-height: 20px;
        padding: 0;
        display: inline-block;
    }
    .pagination .prev {
        left: 0;
    }
    .pagination .prev:before {
        left: -1px;
    }
    .pagination .next {
        right: 0;
    }
    .pagination .next:before {
        right: -1px;
    }
}
</style>
	
	

<?php get_sidebar(); ?>
<?php get_footer(); ?>
