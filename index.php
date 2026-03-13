<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package growthperiod
 */

get_header('', ["headerClasses" => "header--dark"]);
?>

	<main class="main">
      <section class="news">
        <div class="container news__container">
          <div class="news__header" data-aos="fade-in">
            <h1 class="h2"><span class="accent">Announcements</span> and&nbsp;news</h1>
          </div>
		  <?php
		    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(  
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 10,
				'paged' => $paged,
				'ignore_sticky_posts' => true,
				'orderby' => 'date', 
				'order' => 'ASC', 
			);  
			
			$loop = new WP_Query( $args ); 
			$string = '';
			if($loop->have_posts() ): ?>
          <div class="news__list">
		  <?php
			$popup ='';
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
            <div class="news__list-item" data-aos="fade-in">
              <div class="news__list-title"><?php echo get_the_title(); ?></div>
             <?php /* ?> <div class="news__list-date"><?php echo get_the_date(); ?></div><?php */ ?>
              <div class="news__list-announce"><?php echo excerpt_limit_growth(15); ?>... <a class="more" href="/<?php echo $post->post_name; ?>" data-popup="<?php echo $post->post_name; ?>">Learn More</a></div>
            </div>
			<?php 
			
			$popup .='<div class="popup popup--news" id="'.$post->post_name.'">
				<div class="popup__container">
				  <div class="popup__close">
					<svg class="icon" width="30" height="30" viewBox="0 0 30 30">
					  <use xlink:href="'.get_template_directory_uri().'/images/sprites/main.stack.svg#image-close"></use>
					</svg>
				  </div>
				  <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
					<div class="news-item">
					  <div class="news-item__title">
						<div class="h3">'.get_the_title().'</div>
					  </div>
					  <div class="news-item__date">'.get_the_date().'</div>
					  <div class="news-item__content">'.get_the_content().'</div>
					</div>
				  </div>
				</div>
			  </div>';
			endwhile; ?> 
            </div>
			<?php if (function_exists("wpgrowth_numeric_posts_nav")) {
				echo wpgrowth_numeric_posts_nav($loop->max_num_pages);
			  } ?>
		  <?php endif; 
			wp_reset_query();
			?>
        </div>
      </section>
      <?php echo $popup; ?>
    </main>

<?php
get_footer('', ["footerClasses" => "footer--white"]); 
