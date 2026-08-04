<?php
/*
Template Name: Team
*/
get_header('', ["headerClasses" => "header--dark"]); 
?> 
	<main class="main">
	<?php if( have_rows('hero_section')): while( have_rows('hero_section') ) : the_row(); ?>
      <section class="team-intro">
        <div class="container team-intro__container">
          <div class="team-intro__image">
            <div class="team-intro__image-holder" data-aos="fade-down-right">
              <?php
				if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'large', ['class' => ''] );
				?>
				</picture>
			  <?php } ?>
            </div>
          </div>
          <div class="team-intro__info" data-aos="fade-in">
            <div class="team-intro__title">
              <h1 class="h3"><?php echo get_sub_field('title'); ?></h1>
            </div>
            <div class="team-intro__description"><?php echo get_sub_field('description'); ?></div>
          </div>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  <?php if( have_rows('leadership')): while( have_rows('leadership') ) : the_row(); ?>
      <section class="team-leadership">
        <div class="container team-leadership__container">
          <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
			<?php
			$args = array(  
				'post_type' => 'our-leaders',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'no_found_rows' => true,
				'orderby' => 'date', 
				'order' => 'DESC', 
			);  
			
			$loop = new WP_Query( $args ); 
			if($loop->have_posts() ): ?>
			<div class="team-leadership__list">
			  <?php 
			  while ( $loop->have_posts() ) : $loop->the_post(); 
			  global $post; ?>
			<div class="team-leadership__item popup-link" data-popup="#teamPersonPopup" data-person-id="<?php echo esc_attr( get_the_ID() ); ?>" data-person-kind="leader" data-aos="fade-in">
              <div class="team-leadership__item-image">
                <?php 
				if(get_post_thumbnail_id( get_the_ID())){ ?> 
					<picture><?php echo get_the_post_thumbnail( get_the_ID(), 'large', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => get_the_title()] ); ?></picture>
				<?php } ?>
                <div class="btn-more">
                  <div class="btn-more__text">Bio</div>
                  <div class="btn-more__icon">
                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24">
                      <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-arrow-top-right"></use>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="team-leadership__item-data">
                <div class="team-leadership__item-position"><?php echo get_field('position'); ?></div>
                <div class="team-leadership__item-name"><?php echo get_the_title(); ?></div>
              </div>
            </div>
			<?php endwhile; ?>
            </div>
			<?php endif; 
			wp_reset_query();
			?>
        </div>
      </section>
    <?php endwhile; endif; ?>
	  <?php if( have_rows('our_experts')): while( have_rows('our_experts') ) : the_row(); ?>  
	  <section class="team-experts">
        <div class="container team-experts__container">
          <h3 class="team-experts__title h3"><?php echo get_sub_field('title'); ?></h3>
          <div class="team-experts__filter">
            <div class="team-experts__filter-caption"><?php echo get_sub_field('caption'); ?></div>
            <div class="team-experts__filter-controls" id="teamFilter">
			<?php 
			$types = get_terms( array(
				'taxonomy' => 'types',
				'hide_empty' => false,
				'orderby'   => 'ID', 
                'order'     => 'ASC'
			) );
			if ( !empty($types) ) :
			foreach( $types as $type ) {
				echo '<div class="team-experts__filter-control" data-filter="'. esc_attr( $type->term_id ) .'">'. esc_attr( $type->name ) .'</div>';
			}
			endif;
			?>
            </div>
			<?php
		    $args = array(  
				'post_type' => 'our-experts',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'no_found_rows' => true,
				'meta_key' => 'last_name',
				'orderby' => array(
					'meta_value' => 'ASC',
					'title' => 'ASC',
				), 
				'order' => 'ASC', 
			);  
			
			$loop = new WP_Query( $args ); 
			if($loop->have_posts() ): ?>
            <div class="team-experts__filter-list" id="teamList">
			<?php 
			  while ( $loop->have_posts() ) : $loop->the_post(); 
			  global $post; 
			  $type_cats = wp_get_object_terms( $post->ID, 'types', array( 'fields' => 'ids' ) );
			  if(!empty($type_cats)){
			  ?>
			  <?php
			  $expert_position = trim((string) get_field('position'));
			  $expert_last_name = trim((string) get_field('last_name'));
			  $expert_first_name = trim((string) get_field('first_name'));
			  // Display the expert post title instead of first/last name fields.
			  $expert_label = trim(get_the_title());
			  ?>
			  <div class="team-experts__filter-item popup-link" data-popup="#teamPersonPopup" data-person-id="<?php echo esc_attr( get_the_ID() ); ?>" data-person-kind="expert" data-filter="<?php echo implode(',', $type_cats); ?>"><?php echo esc_html($expert_label); ?></div>
			  
			<?php 
			  }
			endwhile;?>
            </div>
			<?php endif; 
			wp_reset_query();
			?>
          </div>
        </div>
      </section>
	<?php endwhile; endif; ?>
	<div class="popup popup--person" id="teamPersonPopup" aria-hidden="true">
		<div class="popup__container">
			<div class="popup__close">
				<svg class="icon" width="40" height="40" viewBox="0 0 30 30">
					<use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
				</svg>
			</div>
			<div class="popup__content" data-simplebar data-simplebar-auto-hide="false"></div>
		</div>
	</div>
	<?php if( have_rows('clients_worldwide')): while( have_rows('clients_worldwide') ) : the_row(); ?>
      <section class="team-map" data-aos="fade-in">
        <div class="team-map__image">
          <?php
			if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php echo getImageHTMLCodeWebp( get_sub_field('image'), 'large', ['class' => ''] ); ?>
				</picture>
			<?php } ?>
        </div>
        <div class="team-map__content" data-aos="fade-up" data-aos-delay="500">
          <h3 class="h3"><?php echo get_sub_field('title'); ?></h3>
          <div class="team-map__description"><?php echo get_sub_field('caption'); ?>
            <?php if( have_rows('lists')): ?>
			<ul>
			<?php while( have_rows('lists') ) : the_row(); ?>
              <li><?php echo get_sub_field('item'); ?></li>
			<?php endwhile; ?>
            </ul>
			<?php endif; ?>
          </div>
        </div>
      </section>
	<?php endwhile; endif; ?>
    </main>
<?php get_footer('', ["footerClasses" => ""]); 