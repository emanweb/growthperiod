<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package growthperiod
 */

get_header('', ["headerClasses" => "header--dark"]);
?>
<main class="main">
      <section class="case-intro">
        <div class="container case-intro__container">
          <div class="case-intro__info" data-aos="fade-in">
            <?php if(get_field('client_name')) { ?><div class="case-intro__info-client"><?php echo get_field('client_name'); ?></div><?php } ?>
            <div class="case-intro__info-title">
              <h1 class="h3"><?php echo get_the_title(); ?></h1>
            </div>
          </div>
          <div class="case-intro__image" data-aos="fade-in">
            <?php 
			if(get_post_thumbnail_id( get_the_ID())){ ?> 
				<picture><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>"/></picture>
			<?php } ?>
            <div class="case-intro__image-tile"><span></span><span></span><span></span><span></span><span></span><span></span></div>
          </div>
        </div>
      </section>
	  <?php 
	  $blockarray = array('first', 'second', 'third', 'fourth');
	  $blockcount = 0;
	  if( have_rows('content_area') ): while( have_rows('content_area') ): the_row(); ?>
      <?php if( get_row_layout() == 'case_study_info_section' ): ?>
      <section class="case-info">
        <div class="container case-info__container">
          <div class="case-info__list">
			<?php if( have_rows('content_list') ): while( have_rows('content_list') ): the_row(); ?>
            <div class="case-info__list-item case-info__list-item--<?php echo $blockarray[$blockcount]; ?>" data-aos="fade-in">
              <h3 class="h3"><?php echo get_sub_field('title'); ?></h3>
              <div class="case-info__list-content"><?php echo get_sub_field('description'); ?></div>
            </div>
			<?php 
			$blockcount++;
			endwhile; endif; ?>
          </div>
        </div>
      </section>
	  <?php elseif( get_row_layout() == 'client_review_section' ): ?>
      <section class="case-review" data-aos="fade-in">
        <div class="case-review__light"></div>
        <div class="container case-review__container">
          <div class="case-review__quotes">
            <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-quotes"></use>
            </svg>
          </div>
          <div class="case-review__text"><?php echo get_sub_field('quote'); ?></div>
          <div class="case-review__owner"><?php echo get_sub_field('owner'); ?></div>
          <div class="case-review__company"><?php echo get_sub_field('company'); ?></div>
        </div>
      </section>
	  <?php elseif( get_row_layout() == 'other_case_studies' ): ?>
      <section class="cases cases--other">
        <div class="container cases__container">
          <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
		  <?php
			$args = array(  
				'post_type' => 'casestudies',
				'post_status' => 'publish',
				'posts_per_page' => 4,
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
			<div class="cases__list">
			<?php
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
			<a class="cases__list-item <?php if(check_using_ip_address() =='popup') { ?>popup-link<?php } ?>" data-caseurl="<?php echo get_the_permalink(); ?>" href="<?php if(check_using_ip_address() =='popup') { echo "#";  } else { echo get_the_permalink(); } ?>" <?php if(check_using_ip_address() =='popup') { ?>data-popup="#popupSolution12"<?php } ?>>
			   <div class="cases__list-image">
                <?php 
				if(get_post_thumbnail_id( get_the_ID())){ ?> 
					<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'casestudy-thumb'); ?>" alt="<?php the_title(); ?>"/>
				<?php } ?>
              </div>
              <div class="cases__list-content">
                <div class="cases__list-text"><?php echo get_the_title(); ?></div>
                <div class="cases__list-company"><?php echo get_field('client_name'); ?></div>
              </div></a>
			<?php endwhile; ?>   
			</div>
			<?php endif; 
			wp_reset_query();
			?>
          <div class="cases__list-more" data-aos="fade-up" data-aos-duration="2000"><a class="btn-more" href="<?php echo get_the_permalink(23); ?>">
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
<?php
get_footer('', ["footerClasses" => "footer--gray"]); 
