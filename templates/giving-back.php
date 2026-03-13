<?php
/*
Template Name: Giving Back
*/
get_header('', ["headerClasses" => "header--dark"]);
?> 
    <?php while ( have_posts() ) : the_post(); ?>
	<main class="main">
      <section class="giving-back">
        <div class="container giving-back__container giving-back__container--header">
          <div class="giving-back__header" data-aos="fade-in">
            <div class="giving-back__light"></div>
            <h2 class="h2" data-aos="fade-in"><?php the_title(); ?></h2>
            <div class="giving-back__description" data-aos="fade-in"><?php echo get_the_content(); ?></div>
          </div>
        </div>
		<?php
		    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(  
				'post_type' => 'givingbackcp',
				'post_status' => 'publish',
				'posts_per_page' => 10,
				'paged' => $paged,
				'orderby' => 'date', 
				'order' => 'DESC', 
			);  
			
			$loop = new WP_Query( $args ); 
			$string = '';
			if($loop->have_posts() ): ?>
        <div class="container giving-back__containerr giving-back__container--list">
          <div class="giving-back__list">
		    <?php
			$popup ='';
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
            <div class="giving-back__list-item" data-aos="fade-in">
              <a class="giving-back__list-logo" <?php if(!empty(get_field('external_url'))) { ?>href="<?php echo get_field('external_url')['url']; ?>"<?php } ?> <?php if(!empty(get_field('external_url'))) { ?> target="<?php echo get_field('external_url')['target']; ?>"<?php } ?>>
                <?php 
				if(get_post_thumbnail_id( get_the_ID())){ ?> 
					<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" width="233" />
				<?php } ?>
              </a>
              <a class="giving-back__list-description" <?php if(!empty(get_field('external_url'))) { ?>href="<?php echo get_field('external_url')['url']; ?>"<?php } ?> <?php if(!empty(get_field('external_url'))) { ?> target="<?php echo get_field('external_url')['target']; ?>"<?php } ?>>
              <?php the_content(); ?>
              <div class="giving-back__list-trigger">[...]</div></a>
            </div>
			<?php endwhile; ?>
           </div>
          <?php if (function_exists("wpgrowth_numeric_posts_nav")) {
			  echo wpgrowth_numeric_posts_nav($loop->max_num_pages);
			  } ?>
        </div>
		<?php endif; 
			wp_reset_query();
			?>
      </section>
    </main>
	<?php endwhile; ?>
<?php get_footer('', ["footerClasses" => "footer--white"]) ?>