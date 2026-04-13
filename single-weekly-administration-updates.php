<?php
/**
 * The template for displaying Weekly Administration Updates posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package growthperiod
 */

get_header('', ["headerClasses" => "header--dark"]);
?>
<main class="main">
      <section class="admin-update-intro">
        <div class="container admin-update-intro__container">
          <div class="admin-update-intro__info" data-aos="fade-in">
            <?php if(get_field('client_name')) { ?><div class="admin-update-intro__info-date"><?php echo get_field('client_name'); ?></div><?php } ?>
            <div class="admin-update-intro__info-title">
              <h1 class="h3"><?php echo get_the_title(); ?></h1>
            </div>
          </div>
          <div class="admin-update-intro__image" data-aos="fade-in">
            <?php 
			if(get_post_thumbnail_id( get_the_ID())){ ?> 
				<picture><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>"/></picture>
			<?php } ?>
          </div>
        </div>
      </section>
	  <?php 
	  $blockarray = array('first', 'second', 'third', 'fourth');
	  $blockcount = 0;
	  if( have_rows('content_area') ): while( have_rows('content_area') ): the_row(); ?>
      <?php if( get_row_layout() == 'case_study_info_section' ): ?>
      <section class="admin-update-info">
        <div class="container admin-update-info__container">
          <div class="admin-update-info__list">
			<?php if( have_rows('content_list') ): while( have_rows('content_list') ): the_row(); ?>
            <div class="admin-update-info__list-item admin-update-info__list-item--<?php echo $blockarray[$blockcount]; ?>" data-aos="fade-in">
              <h3 class="h3"><?php echo get_sub_field('title'); ?></h3>
              <div class="admin-update-info__list-content"><?php echo get_sub_field('description'); ?></div>
            </div>
			<?php 
			$blockcount++;
			endwhile; endif; ?>
          </div>
        </div>
      </section>
	  <?php elseif( get_row_layout() == 'client_review_section' ): ?>
      <section class="admin-update-review" data-aos="fade-in">
        <div class="admin-update-review__light"></div>
        <div class="container admin-update-review__container">
          <div class="admin-update-review__quotes">
            <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-quotes"></use>
            </svg>
          </div>
          <div class="admin-update-review__text"><?php echo get_sub_field('quote'); ?></div>
          <div class="admin-update-review__owner"><?php echo get_sub_field('owner'); ?></div>
          <div class="admin-update-review__company"><?php echo get_sub_field('company'); ?></div>
        </div>
      </section>
	  <?php elseif( get_row_layout() == 'other_case_studies' ): ?>
      <section class="admin-updates admin-updates--other">
        <div class="container admin-updates__container">
          <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
		  <?php
			$args = array(  
				'post_type' => 'weekly-administration-updates',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'ignore_sticky_posts' => false,
				'orderby' => 'date', 
        'order' => 'DESC', 
			);  
			
			if(!empty(get_sub_field('casestudies'))){
				$args['post__in'] = get_sub_field('casestudies');
				$args['orderby'] = 'post__in';
			}
			
			$loop = new WP_Query( $args ); 
			$string = '';
      $case_link_mode = check_using_ip_address();
			if($loop->have_posts() ): ?>
			<div class="admin-updates__list">
			<?php
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
      <a class="admin-updates__list-item <?php if($case_link_mode =='popup') { ?>popup-link<?php } ?>" data-caseurl="<?php echo esc_url(get_the_permalink()); ?>" href="<?php if($case_link_mode =='popup') { echo "#";  } else { echo esc_url(get_the_permalink()); } ?>" <?php if($case_link_mode =='popup') { ?>data-popup="#popupSolution12"<?php } ?>>
			   <div class="admin-updates__list-image">
                <?php 
				if(get_post_thumbnail_id( get_the_ID())){ ?> 
          <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'casestudy-thumb')); ?>" alt="<?php echo esc_attr(wp_strip_all_tags(get_the_title())); ?>"/>
				<?php } ?>
              </div>
              <div class="admin-updates__list-content">
        <div class="admin-updates__list-text"><?php echo wp_kses_post(get_the_title()); ?></div>
        <div class="admin-updates__list-company"><?php echo esc_html(get_field('client_name')); ?></div>
              </div></a>
			<?php endwhile; ?>   
			</div>
			<?php endif; 
      wp_reset_postdata();
			?>
          <div class="admin-updates__list-more" data-aos="fade-up" data-aos-duration="2000"><a class="btn-more" href="<?php echo get_the_permalink(23); ?>">
              <div class="btn-more__text">Explore<br> More</div>
              <div class="btn-more__icon">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                </svg>
              </div></a></div>
        </div>
      </section>
	  <?php endif; ?>
	<?php 
	
	endwhile; endif; ?>
    </main>