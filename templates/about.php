<?php
/*
Template Name: About Us
*/
get_header('', ["headerClasses" => "header--dark"]); 
?> 
	<main class="main">
	  <?php if( have_rows('hero_section')): while( have_rows('hero_section') ) : the_row(); ?>
      <section class="about-intro">
        <div class="container about-intro__container">
          <div class="about-intro__content">
            <h1 class="h3"><?php echo get_sub_field('title'); ?></h1>
            <div class="about-intro__menu">
			  <?php if( have_rows('links')): while( have_rows('links') ) : the_row(); ?>
              <?php if(!empty(get_sub_field('link'))) { ?><div class="about-intro__menu-item"><a class="about-intro__menu-link" href="<?php echo get_sub_field('link')['url']; ?>" data-smooth-scroll="<?php echo get_sub_field('link')['url']; ?>"><?php echo get_sub_field('link')['title']; ?></a></div><?php } ?>
			  <?php endwhile; endif; ?>
            </div>
            <div class="about-intro__light"></div>
          </div>
		  <?php $gallery = get_sub_field('gallery'); 
		  if(!empty($gallery)){
		  ?>
          <div class="about-intro__thumbs-outer">
            <div class="about-intro__thumbs">
			<?php foreach($gallery as $gal) { ?>
              <div class="about-intro__thumbs-item"><img src="<?php echo $gal['url']; ?>" alt=""></div>
			<?php } ?>
            </div>
          </div>
		  <?php } ?>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  <?php if( have_rows('history_section')): while( have_rows('history_section') ) : the_row(); ?>
      <div class="about-description" id="history">
        <div class="container about-description__container">
          <div class="about-description__header">
            <div class="about-description__header-image">
				<?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
          echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => 'about-description__header-image-img'] );
				?>
				</picture>
				<?php } ?>
            </div>
            <div class="about-description__header-text"><?php echo get_sub_field('description_1'); ?></div>
          </div>
          <div class="about-description__content">
            <div class="about-description__content-video">
              <div class="video js-popup popup-link" data-video="<?php echo get_sub_field('video')['url']; ?>" data-popup="#popupVideo">
                <?php
				if(!empty(get_sub_field('poster_image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('poster_image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
                <div class="video__play"></div>
              </div>
            </div>
            <div class="about-description__content-text"><?php echo get_sub_field('description_2'); ?></div>
          </div>
        </div>
      </div>
	  <?php if(get_sub_field('vimeo_video')) { ?>
      <div class="popup popup--video" id="popupVideo">
        <div class="popup__container">
          <div class="popup__close">
            <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
            </svg>
          </div>
          <div class="popup__content">
            <iframe src="<?php echo get_sub_field('vimeo_video'); ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </div>
	  <?php } ?>
	  <?php endwhile; endif; ?>
	  <?php if( have_rows('what_sets_us_apart')): while( have_rows('what_sets_us_apart') ) : the_row(); ?>
      <section class="about-sets-us-apart" id="whatSetsUsApart">
        <div class="container about-sets-us-apart__container">
          <div class="about-sets-us-apart__header" data-aos="fade-in">
            <div class="about-sets-us-apart__header-title">
              <div class="about-sets-us-apart__eyebrow">growthperiod</div>
              <h2 class="h2"><?php echo get_sub_field('title'); ?></h2>
            </div>
            <div class="about-sets-us-apart__header-image" data-aos="fade-in">
              <div class="about-sets-us-apart__header-image-container">
                <?php
              $apart_gallery = get_sub_field('gallery');
              if(empty($apart_gallery)) {
                $apart_gallery = get_sub_field('images');
              }
              if(!empty($apart_gallery)){ ?>
        <div class="about-sets-us-apart__mosaic">
          <?php
          $apart_gallery_index = 0;
          foreach($apart_gallery as $apart_gallery_item) {
            $apart_image_full = !empty($apart_gallery_item['url']) ? $apart_gallery_item['url'] : '';
            $apart_image_alt = !empty($apart_gallery_item['alt']) ? $apart_gallery_item['alt'] : '';
            $apart_image_thumb = !empty($apart_gallery_item['sizes']['large']) ? $apart_gallery_item['sizes']['large'] : $apart_image_full;
            $apart_image_width = !empty($apart_gallery_item['width']) ? (int) $apart_gallery_item['width'] : 0;
            $apart_image_height = !empty($apart_gallery_item['height']) ? (int) $apart_gallery_item['height'] : 0;
            $apart_image_ratio = $apart_image_height > 0 ? ($apart_image_width / $apart_image_height) : 1;

            $apart_item_type_class = 'is-square';
            if($apart_image_ratio >= 1.2) {
              $apart_item_type_class = 'is-landscape';
            } elseif($apart_image_ratio <= 0.84) {
              $apart_item_type_class = 'is-portrait';
            }

            $apart_item_classes = 'about-sets-us-apart__mosaic-item popup-link js-apart-gallery-item ' . $apart_item_type_class;
            if($apart_gallery_index === 0) {
              $apart_item_classes .= ' is-featured';
            }

            if(empty($apart_image_full)) {
              continue;
            }
          ?>
          <a href="<?php echo esc_url($apart_image_full); ?>" class="<?php echo esc_attr($apart_item_classes); ?>" data-popup="#apartGalleryPopup" data-image="<?php echo esc_url($apart_image_full); ?>" data-image-alt="<?php echo esc_attr($apart_image_alt); ?>" aria-label="View image">
            <img src="<?php echo esc_url($apart_image_thumb); ?>" alt="<?php echo esc_attr($apart_image_alt); ?>" loading="lazy"/>
          </a>
          <?php
            $apart_gallery_index++;
          } ?>
        </div>
        <?php } elseif(!empty(get_sub_field('image'))){ ?>
        <picture>
        <?php
          echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
        ?>
        </picture>
        <?php } ?>
        <?php
        $show_tile = get_sub_field('show_tile');
        $show_tile_enabled = false;
        if (is_array($show_tile)) {
          $show_tile_enabled = in_array('yes', $show_tile, true);
        } elseif (is_string($show_tile)) {
          $show_tile_enabled = $show_tile === 'yes';
        }
        if($show_tile_enabled){ ?>
                <div class="about-sets-us-apart__header-tile"></div>
        <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="container about-sets-us-apart__container about-sets-us-apart__list-container">
          <div class="about-sets-us-apart__list" role="list">
			<?php
            if( have_rows('what_sets_us_apart_list')):
              $apart_index = 1;
              while( have_rows('what_sets_us_apart_list') ) : the_row();
                $is_active = $apart_index === 1;
            ?>
            <article class="about-sets-us-apart__list-item<?php echo $is_active ? ' is-active' : ''; ?>" role="listitem" tabindex="0" data-apart-index="<?php echo $apart_index; ?>">
              <div class="about-sets-us-apart__list-content" data-aos="fade-in">
                <div class="about-sets-us-apart__list-index"><?php echo sprintf('%02d', $apart_index); ?></div>
                <h3 class="about-sets-us-apart__list-title"><?php echo get_sub_field('title'); ?></h3>
                <div class="about-sets-us-apart__list-description"><?php echo get_sub_field('description'); ?></div>
              </div>
            </article>
			<?php
                $apart_index++;
              endwhile;
            endif;
            ?>
          </div>
          <div class="about-sets-us-apart__light"></div>
        </div>
        <div class="popup popup--apart-gallery" id="apartGalleryPopup">
          <div class="popup__container">
            <div class="popup__close">
              <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
              </svg>
            </div>
            <div class="popup__content about-sets-us-apart__popup-content">
              <img src="" alt="" class="about-sets-us-apart__popup-image"/>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  <?php if( have_rows('our_team')): while( have_rows('our_team') ) : the_row(); ?>
      <section class="about-team" id="ourTeam">
        <div class="container about-team__container">
          <div class="about-team__content" data-aos="fade-in">
            <h2 class="h2"><?php echo get_sub_field('title'); ?></h2>
            <div class="about-team__description"><?php echo get_sub_field('description'); ?></div>
            <?php if(!empty(get_sub_field('voted_best_place_to_work'))) { ?><div class="about-team__voit"><a class="about-team__voit-btn btn popup-link" data-popup="<?php echo get_sub_field('voted_best_place_to_work')['url']; ?>">
                <div class="btn__prepend">
					<?php
					if(!empty(get_sub_field('voted_best_place_to_work_image'))){ ?>
					<picture>
					<?php
						echo getImageHTMLCodeWebp( get_sub_field('voted_best_place_to_work_image'), 'full', ['class' => ''] );
					?>
					</picture>
					<?php } ?>
                </div>
			<div class="btn__text"><?php echo get_sub_field('voted_best_place_to_work')['title']; ?></div></a></div>
			
			<?php    
            $aboutpopupid = str_replace("#", "", get_sub_field('voted_best_place_to_work')['url']);
            if(get_sub_field('popup_post')){
            $popup_post_id = get_sub_field('popup_post');
            $contentdata = get_post($popup_post_id);
            $aboutpopup = '<div class="popup popup--news" id="'.$aboutpopupid.'">
				<div class="popup__container">
				  <div class="popup__close">
					<svg class="icon" width="30" height="30" viewBox="0 0 30 30">
					  <use xlink:href="'.get_template_directory_uri().'/images/sprites/main.stack.svg#image-close"></use>
					</svg>
				  </div>
				  <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
					<div class="news-item">
					  <div class="news-item__title">
						<div class="h3">'.get_the_title($popup_post_id).'</div>
					  </div>
					  <div class="news-item__date">'.date("F d, y", strtotime($contentdata->post_date)).'</div>
					  <div class="news-item__content">'.$contentdata->post_content.'</div>
					</div>
				  </div>
				</div>
			  </div>';
            }
			?>
			<?php } ?>
            <?php if(!empty(get_sub_field('link'))) { ?>
			<div class="about-team__more"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
                <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
                <div class="btn-more__icon">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                  </svg>
                </div></a></div>
			<?php } ?>
          </div>
          <div class="about-team__gallery">
		  <?php if(!empty(get_sub_field('slider_1'))) { ?>
            <div class="about-team__slider about-team__slider--first swiper">
              <div class="swiper-wrapper">
			  <?php 
			  $slider_1 = get_sub_field('slider_1');
			  foreach($slider_1 as $sli1) { ?>
                <div class="swiper-slide">
                  <picture>
                    <img src="<?php echo $sli1['url']; ?>" alt="<?php echo $sli1['alt']; ?>"/>
                  </picture>
                </div>
			  <?php } ?>
              </div>
            </div>
			<?php 
			}
			if(!empty(get_sub_field('slider_2'))) { ?>
            <div class="about-team__slider about-team__slider--second swiper">
              <div class="swiper-wrapper">
			  <?php 
			  $slider_2 = get_sub_field('slider_2');
			  foreach($slider_2 as $sli2) { ?>
                <div class="swiper-slide">
                  <picture>
                    <img src="<?php echo $sli2['url']; ?>" alt="<?php echo $sli2['alt']; ?>"/>
                  </picture>
                </div>
			  <?php } ?>
              </div>
            </div>
			<?php } ?>
          </div>
        </div>
      </section>
	  <?php 
	  if($aboutpopup){
	     echo $aboutpopup;  
	  }
	  endwhile; endif; ?>
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
	  <?php if( have_rows('announcements_and_news')): while( have_rows('announcements_and_news') ) : the_row(); ?>
      <section class="about-insights" id="recentInsight">
        <div class="container about-insights__container">
          <div class="about-insights__header" data-aos="fade-in">
            <h3 class="h2"><?php echo get_sub_field('title'); ?></h3>
          </div>
		  <?php
			$args = array(  
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 2,
				'ignore_sticky_posts' => false,
				'orderby' => 'date', 
				'order' => 'ASC', 
			);  
			
			if(!empty(get_sub_field('announcements_and_news_list'))){
				$args['post__in'] = get_sub_field('announcements_and_news_list');
				$args['orderby'] = 'post__in';
			}
			
			$loop = new WP_Query( $args ); 
			$string = '';
			if($loop->have_posts() ): ?>
          <div class="about-insights__list">
		  <?php
			$popup = '';
			$latest_article = 1; 
			$totalpost = $loop->found_posts;
			while ( $loop->have_posts() ) : $loop->the_post(); 
			global $post; ?>
            <div class="about-insights__list-item" data-aos="fade-in">
              <div class="about-insights__list-title"><?php echo get_the_title(); ?></div>
              <div class="about-insights__list-text"><?php if ( function_exists('excerpt_limit_growth') ) { echo excerpt_limit_growth(15); } ?>
			  <a class="more about-insights__list-more" href="<?php echo $post->post_name; ?>" data-popup="<?php echo $post->post_name; ?>">Learn More</a></div>
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
					  <div class="news-item__content">'.get_the_content().'</div>
					</div>
				  </div>
				</div>
			  </div>';
			endwhile; ?> 
           </div>
		  <?php endif; 
			wp_reset_query();
			echo $popup;
			?>
		  <?php if(!empty(get_sub_field('link'))) { ?>
          <div class="about-insights__more" data-aos="fade-in"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
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
	  <?php if( have_rows('giving_back')): while( have_rows('giving_back') ) : the_row(); ?>
      <section class="about-giving-back" id="givingBack">
        <div class="container about-giving-back__container">
          <h2 class="h2" data-aos="fade-in"><?php echo get_sub_field('title'); ?></h2>
          <div class="about-giving-back__block" data-aos="fade-in"><?php echo get_sub_field('description'); ?></div>
          <div class="about-giving-back__list">
		  <?php if(!empty(get_sub_field('images'))) { ?>
            <div class="about-giving-back__list-slider">
			  <?php 
			  $givingimages = get_sub_field('images');
			  foreach($givingimages as $givimages) { ?>
              <div class="about-giving-back__list-item" data-aos="fade-in">
                <picture>
                  <img src="<?php echo $givimages['url']; ?>" alt=""/>
                </picture>
              </div>
			  <?php } ?>
            </div>
		  <?php } ?>
			<?php if(!empty(get_sub_field('link'))) { ?>
            <div class="about-giving-back__list-all" data-aos="fade-in"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>">
                <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
                <div class="btn-more__icon">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                  </svg>
                </div></a></div>
			<?php } ?>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
    </main>
<?php get_footer('', ["footerClasses" => ""]) ?>