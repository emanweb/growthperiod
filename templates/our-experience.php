<?php
/*
Template Name: Our experience
*/
get_header('', ["headerClasses" => "header--dark"]);
?> 
	<main class="main">
	<?php if( have_rows('hero_section')): while( have_rows('hero_section') ) : the_row(); ?>
      <section class="experience-intro">
        <div class="experience-intro__light"></div>
        <div class="container experience-intro__container">
          <div class="experience-intro__content" data-aos="fade-in">
            <h1 class="h3"><?php echo get_sub_field('title'); ?></h1>
            <div class="experience-intro__description"><?php echo get_sub_field('description'); ?></div>
          </div>
          <div class="experience-intro__image" data-aos="fade-in">
		    <?php
			if(get_sub_field('show_tile')[0] == 'yes'){ ?>
            <div class="experience-intro__image-tile"><span data-aos="fade-in" data-aos-delay="50"></span><span data-aos="fade-in" data-aos-delay="100"></span><span data-aos="fade-in" data-aos-delay="150"></span><span data-aos="fade-in" data-aos-delay="250"></span><span data-aos="fade-in" data-aos-delay="300"></span><span data-aos="fade-in" data-aos-delay="350"></span></div>
			<?php } ?>
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
      </section>
	<?php endwhile; endif; ?>
	<?php if( have_rows('experience_list')): ?>
      <section class="experience-list">
        <div class="container experience-list__container">
          <div class="experience-list__content">
		  <?php while( have_rows('experience_list') ) : the_row(); ?>
		  <?php if(get_sub_field('type') == 'image') {?>
            <div class="experience-list__item" data-aos="flip-up" data-aos-delay="100" data-aos-duration="2000">
            <?php
			if(!empty(get_sub_field('image'))){ ?>
			<picture>
			<?php
				echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
			?>
			</picture>
			<?php } ?>
            </div>
		  <?php } else if( get_sub_field('type') == 'review' ){ ?>
			<?php if( have_rows('review_section')): while( have_rows('review_section') ) : the_row(); ?>
			<div class="experience-list__item experience-list__item--review <?php echo get_sub_field('class'); ?>" data-aos="flip-up" data-aos-delay="<?php echo get_sub_field('delay'); ?>" data-aos-duration="2000">
              <div class="experience-list__item-comment"><?php echo get_sub_field('quote'); ?></div>
              <div class="experience-list__item-owner"><?php echo get_sub_field('name_&_position'); ?></div>
            </div>
			<?php endwhile; endif; ?>
		  <?php } ?>
		  <?php endwhile; ?>
           </div>
        </div>
      </section>
	  <?php endif; ?>
	  <?php if( have_rows('a_sampling_of_our_clients')): while( have_rows('a_sampling_of_our_clients') ) : the_row(); ?>
      <section class="experience-clients" id="clients">
        <div class="container">
          <h2 class="h2"><?php echo get_sub_field('title'); ?></h2>
          <div class="experience-clients__alphabet" id="experienceAlphabet">
		  <span class="is-active" data-letter="all">All</span>
		  <?php if( have_rows('clients_list')): while( have_rows('clients_list') ) : the_row(); 
		  $sampling_client_type = get_sub_field('sampling_client_type'); 
		  ?>
		  <span data-letter="<?php echo $sampling_client_type['value']; ?>"><?php echo $sampling_client_type['label']; ?></span>
		  <?php endwhile; endif; ?>
		  </div>
          <div class="experience-clients__list swiper" id="experienceClients">
            <div class="swiper-wrapper">
			<?php if( have_rows('clients_list')): while( have_rows('clients_list') ) : the_row(); 
			$gallery = get_sub_field('image'); 
			if(!empty($gallery)){
			foreach($gallery as $gal) { ?>
              <div class="swiper-slide" data-sort="<?php echo get_sub_field('sampling_client_type')['value']; ?>">
                <div class="experience-clients__list-item">
                    <?php
					if(!empty($gal)){ ?>
					<picture>
					<img src="<?php echo $gal['url']; ?>" alt="">
					</picture>
					<?php } ?>
                </div>
              </div>
			<?php } 
			}
			?>
			<?php endwhile; endif; ?>
            </div>
            <div class="swiper-scrollbar"></div>
          </div>
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
        'posts_per_page' => -1,
				'ignore_sticky_posts' => false,
				'orderby' => 'date', 
        'order' => 'DESC', 
			);  
			
			$loop = new WP_Query( $args ); 
      $case_link_mode = check_using_ip_address();
      $is_popup_mode = ($case_link_mode === 'popup');
			if($loop->have_posts() ): ?>
      <div class="cases__carousel-wrap">
      <div class="cases__controls swiper-controls">
      <div class="swiper-button swiper-button-prev" aria-label="Previous case study">
      <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
        <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-left"></use>
      </svg>
      </div>
      <div class="swiper-button swiper-button-next" aria-label="Next case study">
      <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
        <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-right"></use>
      </svg>
      </div>
      </div>
      <div class="cases__carousel swiper js-caseStudiesCarouselLocal">
      <div class="swiper-wrapper">
		  <?php
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
      <div class="swiper-slide">
        <a class="cases__list-item <?php if($is_popup_mode) { ?>popup-link<?php } ?>" data-caseurl="<?php echo get_the_permalink(); ?>" href="<?php echo $is_popup_mode ? '#' : get_the_permalink(); ?>" <?php if($is_popup_mode) { ?>data-popup="#popupSolution12"<?php } ?>>
          <div class="cases__list-image">
          <?php if(get_post_thumbnail_id( get_the_ID())){ ?> 
          <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'casestudy-thumb'); ?>" alt="<?php the_title(); ?>"/>
          <?php } ?>
          </div>
          <div class="cases__list-content">
            <div class="cases__list-text"><?php echo get_the_title(); ?></div>
            <div class="cases__list-company"><?php echo get_field('client_name'); ?></div>
          </div>
        </a>
      </div>
        <?php 
			endwhile; ?>
      </div>
			</div>
			</div>
			<?php endif; 
      wp_reset_postdata();
			?>
        </div>
      </section>
	 <?php endwhile; endif; ?>
	 
	 <?php if( have_rows('what_clients_say')): while( have_rows('what_clients_say') ) : the_row(); 
	 if(get_sub_field('title')){
	 ?>
	  <section class="about-review" id="review">
        <div class="container about-review__container">
          <div class="about-review__light"></div>
          <div class="about-review__content">
            <div class="about-review__title" data-aos="fade-in">
              <h2 class="h2"><?php echo get_sub_field('title'); ?></h2>
            </div>
            <div class="about-review__thumb" data-aos="fade-in">
              <div class="video js-popup popup-link" <?php if(!empty(get_sub_field('video_mp4'))) { ?> data-video="<?php echo get_sub_field('video_mp4')['url']; ?>" <?php } ?> data-popup="#popupReview">
                <?php if(!empty(get_sub_field('image'))) { ?>
                <picture>
                  <img src="<?php echo get_sub_field('image')['url']; ?>" alt="<?php echo get_sub_field('image')['alt']; ?>"/>
                </picture>
                <?php } ?>
                <div class="video__play"></div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="popup popup--video" id="popupReview">
        <div class="popup__container">
          <div class="popup__close">
            <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
            </svg>
          </div>
          <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
            <div class="video video--popup is-paused video--vertical">
            <?php if(!empty(get_sub_field('video_mp4')) || !empty(get_sub_field('video_webp'))) { ?>
              <video poster="<?php echo get_sub_field('poster_image')['alt']; ?>">
                <?php if(!empty(get_sub_field('video_mp4'))) { ?><source src="<?php echo get_sub_field('video_mp4')['url']; ?>" type="video/mp4"><?php } ?>
                <?php if(!empty(get_sub_field('video_webp'))) { ?><source src="<?php echo get_sub_field('video_webp')['url']; ?>" type="video/webm"><?php } ?>
              </video>
              <?php } ?>
              <div class="video__play">
                <svg class="icon" width="209" height="144" viewBox="0 0 209 144">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-youtube-play"></use>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
	  }
	  endwhile; endif; ?>
    </main>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var sliders = document.querySelectorAll('.js-caseStudiesCarouselLocal');

  if (!sliders.length || typeof Swiper === 'undefined') {
    return;
  }

  sliders.forEach(function(slider) {
    var sliderWrap = slider.closest('.cases__carousel-wrap');
    var controls = sliderWrap ? sliderWrap.querySelector('.swiper-controls') : null;
    var prevButton = controls ? controls.querySelector('.swiper-button-prev') : null;
    var nextButton = controls ? controls.querySelector('.swiper-button-next') : null;

    if (slider.swiper) {
      return;
    }

    var swiper = new Swiper(slider, {
      loop: true,
      speed: 9000,
      autoplay: {
        delay: 1,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
        reverseDirection: false,
      },
      spaceBetween: 16,
      slidesPerView: 1.1,
      grabCursor: true,
      watchOverflow: true,
      breakpoints: {
        640: {
          slidesPerView: 1.5,
          spaceBetween: 18,
        },
        768: {
          slidesPerView: 2.1,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3.05,
          spaceBetween: 24,
        },
        1440: {
          slidesPerView: 4,
          spaceBetween: 24,
        }
      }
    });

    // Left arrow: jump one item (manual step).
    if (prevButton) {
      prevButton.addEventListener('click', function(e) {
        e.preventDefault();
        swiper.autoplay.stop();
        swiper.slideNext(350);
      });
    }

    // Right arrow: switch to continuous rightward motion.
    if (nextButton) {
      nextButton.addEventListener('click', function(e) {
        e.preventDefault();
        swiper.params.autoplay.reverseDirection = true;
        swiper.autoplay.stop();
        swiper.autoplay.start();
      });
    }
  });
});
</script>
<?php get_footer('', ["footerClasses" => "footer--gray"]); 