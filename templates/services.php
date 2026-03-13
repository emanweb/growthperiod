<?php
/*
Template Name: Services
*/
get_header('', ["headerClasses" => "header--dark"]);
?> 
	<main class="main">
	<?php if( have_rows('hero_section')): while( have_rows('hero_section') ) : the_row(); ?>
      <section class="services-intro">
        <div class="services-intro__light"></div>
        <div class="container services-intro__container">
          <div class="services-intro__info" data-aos="fade-in">
            <h1 class="h3"><?php echo get_sub_field('title'); ?></h1>
            <div class="services-intro__description"><?php echo get_sub_field('description'); ?></div>
            <div class="services-intro__menu">
			<?php if( have_rows('links')): while( have_rows('links') ) : the_row(); ?>
              <?php if(!empty(get_sub_field('link'))) { ?><div class="services-intro__menu-item"><a href="<?php echo get_sub_field('link')['url']; ?>" data-smooth-scroll="<?php echo get_sub_field('link')['url']; ?>"><?php echo get_sub_field('link')['title']; ?></a></div><?php } ?>
			<?php endwhile; endif; ?>
            </div>
          </div>
          <div class="services-intro__image" data-aos="fade-in">
            <div class="services-intro__image-container">
				<?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
              <div class="services-intro__image-tile"><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  <?php if( have_rows('business_development')): while( have_rows('business_development') ) : the_row(); ?>
      <section class="services-business" id="business">
        <div class="container services-business__container">
          <div class="services-business__holder">
            <div class="services-business__title" data-aos="fade-in">
              <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            </div>
            <?php
			if(!empty(get_sub_field('image'))){ ?>
			<picture>
			<?php
				echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
			?>
			</picture>
			<?php } ?>
          </div>
          <div class="services-business__description"><?php echo get_sub_field('description'); ?></div>
        </div>
        <div class="services-business__slider-container">
          <div class="services-business__slider swiper js-servicesBusinessSlider">
            <div class="swiper-wrapper">
			<?php if( have_rows('content_slider')): while( have_rows('content_slider') ) : the_row(); ?>
              <div class="swiper-slide">
                <div class="services-business__slider-slide" data-simplebar data-simplebar-auto-hide="false">
                  <div class="services-business__slider-title"><?php echo get_sub_field('title'); ?></div>
                  <div class="services-business__slider-content"><?php echo get_sub_field('description'); ?></div>
                </div>
              </div>
			<?php endwhile; endif; ?>
            </div>
            <div class="swiper-controls">
              <div class="swiper-button swiper-button-prev">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-left"></use>
                </svg>
              </div>
              <div class="swiper-counts">
                <div class="swiper-counts__current"></div>
                <div class="swiper-counts__divider">/</div>
                <div class="swiper-counts__counts"></div>
              </div>
              <div class="swiper-button swiper-button-next">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-right"></use>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  
	  <?php if( have_rows('merger_and_acquisition_support')): while( have_rows('merger_and_acquisition_support') ) : the_row(); ?>
      <section class="services-business services-business--light" id="merger">
        <div class="container services-business__container services-business__container--left">
          <div class="services-business__holder">
            <div class="services-business__title" data-aos="fade-in">
              <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            </div>
            <?php
			if(!empty(get_sub_field('image'))){ ?>
			<picture>
			<?php
				echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
			?>
			</picture>
			<?php } ?>
          </div>
          <div class="services-business__description"><?php echo get_sub_field('description'); ?></div>
        </div>
        <div class="services-business__slider-container">
          <div class="services-business__slider swiper js-servicesBusinessSlider">
            <div class="swiper-wrapper">
				<?php if( have_rows('content_slider')): while( have_rows('content_slider') ) : the_row(); ?>
				  <div class="swiper-slide">
					<div class="services-business__slider-slide" data-simplebar data-simplebar-auto-hide="false">
					  <div class="services-business__slider-title"><?php echo get_sub_field('title'); ?></div>
					  <div class="services-business__slider-content"><?php echo get_sub_field('description'); ?></div>
					</div>
				  </div>
				<?php endwhile; endif; ?>
            </div>
            <div class="swiper-controls">
              <div class="swiper-button swiper-button-prev">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-left"></use>
                </svg>
              </div>
              <div class="swiper-counts">
                <div class="swiper-counts__current"></div>
                <div class="swiper-counts__divider">/</div>
                <div class="swiper-counts__counts"></div>
              </div>
              <div class="swiper-button swiper-button-next">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-right"></use>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  <?php if( have_rows('strategy_and_management_consulting')): while( have_rows('strategy_and_management_consulting') ) : the_row(); ?>
      <section class="services-business" id="strategy">
        <div class="container services-business__container">
          <div class="services-business__holder">
            <div class="services-business__title" data-aos="fade-in">
              <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            </div>
            <?php
			if(!empty(get_sub_field('image'))){ ?>
			<picture>
			<?php
				echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
			?>
			</picture>
			<?php } ?>
          </div>
          <div class="services-business__description"><?php echo get_sub_field('description'); ?></div>
        </div>
        <div class="services-business__slider-container">
          <div class="services-business__slider swiper js-servicesBusinessSlider">
            <div class="swiper-wrapper">
				<?php if( have_rows('content_slider')): while( have_rows('content_slider') ) : the_row(); ?>
				  <div class="swiper-slide">
					<div class="services-business__slider-slide" data-simplebar data-simplebar-auto-hide="false">
					  <div class="services-business__slider-title"><?php echo get_sub_field('title'); ?></div>
					  <div class="services-business__slider-content"><?php echo get_sub_field('description'); ?></div>
					</div>
				  </div>
				<?php endwhile; endif; ?>
            </div>
            <div class="swiper-controls">
              <div class="swiper-button swiper-button-prev">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-left"></use>
                </svg>
              </div>
              <div class="swiper-counts">
                <div class="swiper-counts__current"></div>
                <div class="swiper-counts__divider">/</div>
                <div class="swiper-counts__counts"></div>
              </div>
              <div class="swiper-button swiper-button-next">
                <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                  <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-slide-right"></use>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  

	  <?php if( have_rows('geopolitical_risk_management')): while( have_rows('geopolitical_risk_management') ) : the_row(); ?>
      <section class="services-recruiting" id="geopolitical_risk_management">
        <div class="services-recruiting__arrows" data-aos="fade-in" data-aos-duration="2000"><img src="<?php echo get_template_directory_uri(); ?>/images/arrows-right-2.svg" alt=""></div>
        <div class="container services-recruiting__container">
          <div class="services-recruiting__info" data-aos="fade-in">
            <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            <div class="services-recruiting__description"><?php echo get_sub_field('description'); ?></div>
            <?php if(!empty(get_sub_field('link'))) { ?><div class="services-recruiting__button" data-aos="fade-in"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>">
                <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
                <div class="btn-more__icon">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                  </svg>
			</div></a></div><?php } ?>
          </div>
          <div class="services-recruiting__image" data-aos="fade-in" data-aos-delay="200">
            <div class="rel">
              <?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
              <div class="services-recruiting__image-tile"><span data-aos="fade-in" data-aos-delay="50"></span><span data-aos="fade-in" data-aos-delay="100"></span><span data-aos="fade-in" data-aos-delay="150"></span><span data-aos="fade-in" data-aos-delay="250"></span><span data-aos="fade-in" data-aos-delay="300"></span><span data-aos="fade-in" data-aos-delay="350"></span></div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>		
		
		
	  <?php if( have_rows('executive_recruiting')): while( have_rows('executive_recruiting') ) : the_row(); ?>
      <section class="services-recruiting" id="recruiting">
        <div class="services-recruiting__arrows" data-aos="fade-in" data-aos-duration="2000"><img src="<?php echo get_template_directory_uri(); ?>/images/arrows-right-2.svg" alt=""></div>
        <div class="container services-recruiting__container">
          <div class="services-recruiting__info" data-aos="fade-in">
            <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            <div class="services-recruiting__description"><?php echo get_sub_field('description'); ?></div>
            <?php if(!empty(get_sub_field('link'))) { ?><div class="services-recruiting__button" data-aos="fade-in"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>">
                <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
                <div class="btn-more__icon">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                  </svg>
			</div></a></div><?php } ?>
          </div>
          <div class="services-recruiting__image" data-aos="fade-in" data-aos-delay="200">
            <div class="rel">
              <?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
              <div class="services-recruiting__image-tile"><span data-aos="fade-in" data-aos-delay="50"></span><span data-aos="fade-in" data-aos-delay="100"></span><span data-aos="fade-in" data-aos-delay="150"></span><span data-aos="fade-in" data-aos-delay="250"></span><span data-aos="fade-in" data-aos-delay="300"></span><span data-aos="fade-in" data-aos-delay="350"></span></div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  
	  <?php if( have_rows('Canada_GW_Group')): while( have_rows('Canada_GW_Group') ) : the_row(); ?>
      <section class="services-recruiting" id="gwsupport">
        <div class="services-recruiting__arrows" data-aos="fade-in" data-aos-duration="2000"><img src="<?php echo get_template_directory_uri(); ?>/images/arrows-right-2.svg" alt=""></div>
        <div class="container services-recruiting__container">
          <div class="services-recruiting__info" data-aos="fade-in">
            <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            <div class="services-recruiting__description"><?php echo get_sub_field('description'); ?></div>
            <?php if(!empty(get_sub_field('link'))) { ?><div class="services-recruiting__button" data-aos="fade-in"><a class="btn-more" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>">
                <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
                <div class="btn-more__icon">
                  <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                  </svg>
			</div></a></div><?php } ?>
          </div>
          <div class="services-recruiting__image" data-aos="fade-in" data-aos-delay="200">
            <div class="rel">
              <?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
				?>
				</picture>
				<?php } ?>
              <div class="services-recruiting__image-tile"><span data-aos="fade-in" data-aos-delay="50"></span><span data-aos="fade-in" data-aos-delay="100"></span><span data-aos="fade-in" data-aos-delay="150"></span><span data-aos="fade-in" data-aos-delay="250"></span><span data-aos="fade-in" data-aos-delay="300"></span><span data-aos="fade-in" data-aos-delay="350"></span></div>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  
	  <?php if( have_rows('challenge_us')): while( have_rows('challenge_us') ) : the_row(); ?>
      <section class="services-find">
        <div class="container services-find__container">
          <div class="services-find__block">
            <div class="services-find__info">
              <div class="services-find__title">
                <h3 class="h3"><?php echo get_sub_field('title'); ?></h3>
              </div>
			  <?php if(!empty(get_sub_field('link'))) { ?>
              <div class="services-find__button"><a class="btn-more contactsFormLinkMenu" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>">
                  <div class="btn-more__text"><?php echo get_sub_field('link')['title']; ?></div>
                  <div class="btn-more__icon">
                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                    </svg>
                  </div></a></div>
			  <?php } ?>
            </div>
            
			<?php $gallery = get_sub_field('images'); 
			  if(!empty($gallery)){
			  ?>
			  <div class="services-find__images">
				<?php foreach($gallery as $gal) { ?>
				  <div class="services-find__images-item">
				  <div class="services-find__images-picture" data-aos="zoom-in" data-aos-delay="500">
				  <img src="<?php echo $gal['url']; ?>" alt="">
				  </div>
				  </div>
				<?php } ?>
				</div>
			  <?php } ?>
            </div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
    </main>
<?php get_footer('', ["footerClasses" => ""]); 