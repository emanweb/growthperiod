<?php
/*
Template Name: Solutions
*/
get_header('', ["headerClasses" => "header--dark"]);
?> 
	<main class="main">
      <section class="solutions">
        <div class="solutions__light"></div>
        <div class="solutions__arrows" data-aos="fade-in" data-aos-duration="2000"><img src="<?php echo get_template_directory_uri(); ?>/images/arrows-right-2.svg" alt=""></div>
        <div class="container">
          <div class="solutions__header" data-aos="fade-in">
            <h2 class="h3"><?php echo get_the_content(); ?></h2>
          </div>
		  <?php
			$args = array(  
				'post_type' => 'casestudies',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'ignore_sticky_posts' => false,
				'orderby' => 'date', 
				'order' => 'ASC', 
			);  
			
			if(!empty(get_sub_field('casestudies'))){
				$args['post__in'] = get_sub_field('casestudies');
				$args['orderby'] = 'post__in';
			}
			
			$loop = new WP_Query( $args ); 
			$string = '';
			if($loop->have_posts() ): ?>
          <div class="solutions__list">
		  <?php
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			$itemsinrow = ceil($totalpost/3);
			//echo $totalpost."---".$itemsinrow;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
           <?php if($latest_article == 1) { ?> <div class="solutions__list-row"> <?php } ?>
			<a class="solutions__list-item <?php if(check_using_ip_address() =='popup') { ?>popup-link<?php } ?>" data-caseurl="<?php echo get_the_permalink(); ?>" href="<?php if(check_using_ip_address() =='popup') { echo "#";  } else { echo get_the_permalink(); } ?>" <?php if(check_using_ip_address() =='popup') { ?>data-popup="#popupSolution12"<?php } ?>>
			
                <div class="solutions__list-image">
                  <?php 
					if(get_post_thumbnail_id( get_the_ID())){ ?> 
						<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'casestudy-thumb'); ?>" alt="<?php the_title(); ?>"/>
					<?php } ?>
                </div>
                <div class="solutions__list-data">
                  <div class="solutions__list-customer"><?php echo get_field('client_name'); ?></div>
                  <div class="solutions__list-title"><?php echo get_the_title(); ?></div>
                </div></a>
			<?php if($latest_article % $itemsinrow == 0) { ?> </div><div class="solutions__list-row"> <?php } ?>
			<?php 
			$latest_article++;
			endwhile; ?> 
           </div>
		  <?php endif; 
			wp_reset_query();
			?>
        </div>
      </section>
    </main>
<?php get_footer('', ["footerClasses" => ""]); 