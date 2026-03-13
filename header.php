<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package growthperiod
 */

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php is_front_page() ? bloginfo('name') : wp_title(''); ?></title>
    <meta name="title" content="<?php is_front_page() ? bloginfo('name') : wp_title(''); ?>">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/images/favicons/android-chrome-96x96.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/images/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="<?php echo get_template_directory_uri(); ?>/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <?php wp_head(); ?>
  </head>
  <body class="preload">
    <header class="header <?php echo $args['headerClasses']; ?>">
      <div class="container header__container"><a class="logo logo--white" href="<?php echo site_url(); ?>">growth [period]</a>
        <div class="header__menu-outer">
          <div class="header__menu">
		    <?php if( have_rows('header_menu', 'option')): while( have_rows('header_menu', 'option') ) : the_row(); ?>
            <?php 
			if(!empty(get_sub_field('link'))) { 
				$linkid = '';
				if(get_sub_field('link')['url'] == '#contactsFormLinkMenu'){
					
					$linkid = 'id="contactsFormLinkMenu"';
				}
			?><div class="header__menu-item"><a class="header__menu-link <?php if(get_sub_field('link')['url'] == get_permalink(get_the_ID())) { ?>is-active<?php } ?>" href="<?php echo get_sub_field('link')['url']; ?>" <?php echo $linkid; ?>><?php echo get_sub_field('link')['title']; ?></a>
            </div>
			<?php } ?>
			<?php endwhile; endif;  ?>
           </div>
        </div>
        <div class="header__burger"><span></span><span></span></div>
      </div>
    </header>
