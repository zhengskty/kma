<?php get_header();?>







 <div class="main">
<?php
    $post_num = 10; // 显示文章的数量.
    $args=array(
    'post_status' => 'publish',
    'paged' => $paged,
    'ignore_sticky_posts' => 1,
    'posts_per_page' => $post_num
    );
    query_posts($args);
    // 主循环
    if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
   <div class="aritcle" >
    <div class="article-block">
    <div class="author clear">

 	<?php echo get_avatar(get_the_author_meta('ID')); ?>
  <?php the_author_posts_link(); ?>
        </div>
        <a href="/article/118995170" target="_blank" class='contentHerf' >
<div class="content">
<span>天气热了，周末奶奶不顾我的反对，把女儿带去剪头发。回来我惊呆了，一长发飘飘的小仙女，成了头盖西瓜皮。<br/>第二天幼儿园回来，我问女儿，大家有没问你怎么剪这么短。<br/>女儿说，没有。大家都不认识我了…</span>
</div>
</a>
   
   </div>
 评论数量：<?php echo zfunc_comments_users($post->ID); ?>
     </div>
<?php endwhile; else: endif; wp_reset_query();?>

 </div>

<?php
    the_posts_pagination( array(
        'prev_text'          =>上页,
        'next_text'          =>下页,
        'before_page_number' => '<span class="meta-nav screen-reader-text">第 </span>',
        'after_page_number' => '<span class="meta-nav screen-reader-text"> 页</span>',
    ) );
?>



<style>
.article-block{
	background-color: #fff;
    clear: both;
    padding: 18px 20px;
}
.author{
    min-height: 40px;
	margin: 0 0 17px;
}
.author a, .author span {
    float: left;
    font-size: 14px;
    font-weight: 700;
    line-height: 35px;
}
.author img {
    float:left;
    width: 35px;
    height: 35px;
    border-radius: 35px;
    padding: 0;
    margin-right: 10px;
}
    .article .contentHerf {
    display: block;
}
.content {
    margin-bottom: 10px;
    font-size: 16px;
    line-height: 1.8;
    word-wrap: break-word;
    color: #333;
}
</style>







































<?php get_footer();?>

