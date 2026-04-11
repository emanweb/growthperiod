<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 */

get_header();
?>
	<?php while ( have_posts() ) : the_post(); ?>
	<main class="main">
	<?php if( have_rows('hero_section')): while( have_rows('hero_section') ) : the_row(); ?>
      <section class="intro" id="intro">
        <div class="intro__image">
          <?php if(!empty(get_sub_field('video'))) { ?><video autoplay playsinline muted loop>
            <source src="https://customer-2vxpiqm0uuovdvvl.cloudflarestream.com/af4a34330fe458803306ffdbf94a0bd8/downloads/default.mp4" type="video/mp4">
		  <?php } ?>
          </video>
        </div>
        <div class="intro__content" data-aos="fade-in" data-aos-duration="3000">
          <h1 class="intro__logo"><?php echo get_sub_field('title'); ?></h1>
          <h2 class="h2"><?php echo get_sub_field('sub_title'); ?></h2>
        </div>
      </section>
	<?php endwhile; endif; ?>
	<?php if( have_rows('about_us_section')): while( have_rows('about_us_section') ) : the_row(); ?>
      <section class="about">
        <div class="container about__container">
          <h2 class="h2 js-type"><?php echo get_sub_field('title'); ?></h2>
          <div class="about__description" data-aos="fade-in" data-aos-delay="300" data-aos-duration="2000">
            <?php echo get_sub_field('description'); ?>
          </div>
        </div>
      </section>
	<?php endwhile; endif; ?>
	<?php if( have_rows('meet_some_of_our_clients')): while( have_rows('meet_some_of_our_clients') ) : the_row(); ?>
      <section class="clients">
        <div class="container clients__container">
          <h2 class="h2 js-type"><?php echo get_sub_field('title'); ?></h2>
          <div class="clients__description" data-aos="fade-in" data-aos-duration="2000"><?php echo get_sub_field('description'); ?></div>
        </div>
        <div class="clients__list splide" role="group" aria-label="Splide Basic HTML Example" id="clients2">
          <div class="splide__track">
            <div class="splide__list">
			<?php if( have_rows('clients_list')): while( have_rows('clients_list') ) : the_row(); ?>
              <div class="splide__slide">
                <div class="clients__list-item">
                  <div class="clients__list-holder">
                    <div class="clients__list-content">
                      <div class="clients__list-logo">
                        <?php
						if(!empty(get_sub_field('image'))){ ?>
						<picture>
						<?php
							echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
						?>
						</picture>
						<?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			<?php endwhile; endif; ?>
			<?php if( have_rows('last_slide')): while( have_rows('last_slide') ) : the_row(); ?>
              <?php if(!empty(get_sub_field('link'))) { ?><div class="splide__slide"><a class="clients__list-item clients__list-item--all" href="<?php echo get_sub_field('link')['url']; ?>">
                  <div class="clients__list-holder">
                    <div class="clients__list-content">
                      <div class="clients__list-all">
                        <div class="clients__list-all-icon">
                          <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                          </svg>
                        </div><?php echo get_sub_field('totla'); ?>
                      </div>
                      <div class="clients__list-data">
                        <div class="clients__list-title"><?php echo get_sub_field('link')['title']; ?></div>
                      </div>
                    </div>
                  </div></a></div>
			  <?php } ?>
			<?php endwhile; endif; ?>
            </div>
          </div>
        </div>
		<?php if(!empty(get_sub_field('link'))) { ?>
        <div class="container clients__button"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
            <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
            <div class="btn-more__icon">
              <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
              </svg>
            </div></a></div>
		<?php } ?>
      </section>
	<?php endwhile; endif; ?>
	<?php if( have_rows('our_services')): while( have_rows('our_services') ) : the_row(); ?>
      <section class="services">
        <div class="container services__container">
			<h2 class="h2 js-type"><?php echo get_sub_field('title'); ?></h2>
			<div class="services__list">
			<?php if( have_rows('our_services_list')): while( have_rows('our_services_list') ) : the_row(); ?>
			<a class="services__list-item" href="<?php echo get_sub_field('link')['url']; ?>" data-aos="fade-up">
              <div class="services__list-thumb">
                <?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
              </div>
              <div class="services__list-title"><?php echo get_sub_field('link')['title']; ?></div>
              <div class="services__list-arrow">
                <svg class="icon" width="55" height="55" viewBox="0 0 55 55">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right2"></use>
                </svg>
              </div></a>
			<?php endwhile; endif; ?>
			</div>
			<?php if(!empty(get_sub_field('link'))) { ?>
			<div class="services__list-more" data-aos="fade-up" data-aos-transition="2000"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
              <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
              <div class="btn-more__icon">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                </svg>
              </div></a></div>
			<?php } ?>
        </div>
      </section>
	<?php endwhile; endif; ?>
	<?php if( have_rows('industries_we_work_with')): while( have_rows('industries_we_work_with') ) : the_row(); ?>
      <section class="industries">
        <div class="container industries__container">
          <h2 class="h2 js-type"><?php echo get_sub_field('title'); ?></h2>
          <div class="industries__list">
			<?php if( have_rows('industries_list')): while( have_rows('industries_list') ) : the_row(); ?>
			<a class="industries__list-item" href="<?php echo get_sub_field('link')['url']; ?>" data-aos="fade-up">
              <div class="industries__list-thumb">
                <?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
              </div>
              <div class="industries__list-title"><?php echo get_sub_field('link')['title']; ?></div>
              <div class="industries__list-arrow">
                <svg class="icon" width="55" height="55" viewBox="0 0 55 55">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right2"></use>
                </svg>
              </div></a>
			<?php endwhile; endif; ?>  
			</div>
			<?php if(!empty(get_sub_field('link'))) { ?>
			<div class="industries__list-more" data-aos="fade-up" data-aos-transition="2000"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
              <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
              <div class="btn-more__icon">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                </svg>
              </div></a></div>
			<?php } ?>
        </div>
      </section>
	<?php endwhile; endif; ?>
	<?php if( have_rows('case_studies')): while( have_rows('case_studies') ) : the_row(); ?>
      <section class="cases">
        <div class="container cases__container">
          <h2 class="h2 js-type"><?php echo get_sub_field('title'); ?></h2>
          <div class="cases__description" data-aos="fade-in" data-aos-duration="2000"><?php echo get_sub_field('description'); ?></div>
			<?php
			$args = array(  
				'post_type' => 'casestudies',
				'post_status' => 'publish',
				'posts_per_page' => 4,
				'ignore_sticky_posts' => false,
				'orderby' => 'date', 
        'order' => 'DESC', 
			);  
			
			if(!empty(get_sub_field('case_studies_list'))){
				$args['post__in'] = get_sub_field('case_studies_list');
				$args['orderby'] = 'post__in';
			}
			
			$loop = new WP_Query( $args ); 
			$string = '';
      $case_link_mode = check_using_ip_address();
			if($loop->have_posts() ): ?>
			<div class="cases__list">
			<?php
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
      <a class="cases__list-item <?php if($case_link_mode =='popup') { ?>popup-link<?php } ?>" data-caseurl="<?php echo esc_url(get_the_permalink()); ?>" href="<?php if($case_link_mode =='popup') { echo "#";  } else { echo esc_url(get_the_permalink()); } ?>" <?php if($case_link_mode =='popup') { ?>data-popup="#popupSolution12"<?php } ?>>
              <div class="cases__list-image">
                <picture>
                <?php 
				if(get_post_thumbnail_id( get_the_ID())){ ?> 
          <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(wp_strip_all_tags(get_the_title())); ?>"/>
				<?php } ?>
                </picture>
              </div>
              <div class="cases__list-content">
        <div class="cases__list-text"><?php echo wp_kses_post(get_the_title()); ?></div>
        <div class="cases__list-company"><?php echo esc_html(get_field('client_name')); ?></div>
              </div></a>
			<?php endwhile; ?>  
			</div>
			<?php endif; 
      wp_reset_postdata();
			?>
			<?php if(!empty(get_sub_field('link'))) { ?>
			<div class="cases__list-more" data-aos="fade-up" data-aos-duration="2000"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
              <div class="btn-more__text">Explore<br> More</div>
              <div class="btn-more__icon">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                </svg>
              </div></a>
			</div>
			<?php } ?>
        </div>
      </section>
	<?php endwhile; endif; ?>
    </main>
	<?php endwhile; // End of the loop. ?>
<?php
get_footer('', ["footerClasses" => "footer--gray"]); 