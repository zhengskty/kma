<?php
/**
* Author: Ashuwp!!!
* Author url: http://www.ashuwp.com
* Version: 5.0
**/

require get_template_directory() . '/framework/ashuwp_framework_core.php'; //加载ashuwp_framework框架
require get_template_directory() . '/framework/config-example.php'; //加载配置数据，config-example.php为配置范例。
require_once(TEMPLATEPATH . '/simple-img.php');
register_nav_menu("top-nav", __("导航菜单", "main"));
//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
/*编辑器添加分页按钮*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}

/*激活友情链接后台*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );   


/**
 * 禁用：移除 WordPress 4.2 中前台自动加载的 emoji 脚本
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
 
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}
//修复 WordPress 找回密码提示“抱歉，该key似乎无效”

function reset_password_message( $message, $key ) {
 if ( strpos($_POST['user_login'], '@') ) {
 $user_data = get_user_by('email', trim($_POST['user_login']));
 } else {
 $login = trim($_POST['user_login']);
 $user_data = get_user_by('login', $login);
 }
 $user_login = $user_data->user_login;
 $msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
 $msg .= network_site_url() . "\r\n\r\n";
 $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
 $msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
 $msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
 $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
 return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);

//搜索结果排除所有页面
function search_filter_page($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','search_filter_page');


/**调用文章第一张图片**/
function wp_catch_first_image($image_size = '') {  
    global $post, $posts;  
        $first_img = '';  
        ob_start();  
        ob_end_clean();  
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);  
        $first_img = $matches [1] [0];
        return $first_img;  
}


// timthumb输出缩略图地址
function post_thumbnail_src(){
	global $post;
	if( $values = get_post_custom_values("thumbnail") ) { //输出自定义域图片地址
		$values = get_post_custom_values("thumbnail");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){ //如果有特色缩略图，则输出缩略图地址
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
	} else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$post_thumbnail_src = $matches [1] [0]; //获取该图片 src
		if(empty($post_thumbnail_src)){
			$post_thumbnail_src = get_bloginfo('template_url')."/images/no-image.jpg"; //如果日志中没有图片，则显示默认图片
		}
	};
	echo $post_thumbnail_src;
}

// 注册css与js
function kma_scripts() {
	// Add custom style, used in the main stylesheet.
		wp_enqueue_style( 'kma-style', get_stylesheet_uri() );
	wp_enqueue_style( 'kma-ie', get_template_directory_uri() . '/css/ie.css', array( 'kma-style' ), '20160816' );

}
add_action( 'wp_enqueue_scripts', 'kma_scripts' );

//调用评论
function zfunc_comments_users($postid=0,$which=0) {
 $comments = get_comments('status=approve&type=comment&post_id='.$postid); //获取文章的所有评论
 if ($comments) {
 $i=0; $j=0; $commentusers=array();
 foreach ($comments as $comment) {
 ++$i;
 if ($i==1) { $commentusers[] = $comment->comment_author_email; ++$j; }
 if ( !in_array($comment->comment_author_email, $commentusers) ) {
 $commentusers[] = $comment->comment_author_email;
 ++$j;
 }
 }
 $output = array($j,$i);
 $which = ($which == 0) ? 0 : 1;
 return $output[$which]; //返回评论人数
 }
 return 0; //没有评论返回0
}

// 为WordPress后台文章列表添加缩略图
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
// for post and page
add_theme_support('post-thumbnails', array( 'post','page' ) );
function fb_AddThumbColumn($cols) {
  $cols['thumbnail'] = __('Thumbnail');
  return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
  $width = (int) 160;
  $height = (int) 160;
  if ( 'thumbnail' == $column_name ) {
    // thumbnail of WP 2.9
    $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
    // image from gallery
    $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
    if ($thumbnail_id)
      $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
    elseif ($attachments) {
      foreach ( $attachments as $attachment_id => $attachment ) {
        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
      }
    }
    if ( isset($thumb) && $thumb ) {
      echo $thumb;
    } else {
      echo __('None');
    }
  }
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}