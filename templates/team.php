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
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
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
		    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(  
				'post_type' => 'our-leaders',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'paged' => $paged,
				'orderby' => 'date', 
				'order' => 'DESC', 
			);  
			
			$loop = new WP_Query( $args ); 
			$string = '';
			if($loop->have_posts() ): ?>
			<div class="team-leadership__list">
			  <?php 
			  $leadership_listrepeat = 0;
			  $popup = '';
			  $totalpost = $loop->found_posts;
			  while ( $loop->have_posts() ) : $loop->the_post(); 
			  global $post; ?>
            <div class="team-leadership__item popup-link" data-popup="#popupPerson<?php echo $leadership_listrepeat; ?>" data-aos="fade-in">
              <div class="team-leadership__item-image">
                <?php 
				if(get_post_thumbnail_id( get_the_ID())){ ?> 
					<picture><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>"/></picture>
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
			<?php 
			ob_start();
            $the_content = the_content();
            $the_content = ob_get_clean();
            
			$popup .='<div class="popup popup--person" id="popupPerson'.$leadership_listrepeat.'">
				<div class="popup__container">
				  <div class="popup__close">
					<svg class="icon" width="30" height="30" viewBox="0 0 30 30">
					  <use xlink:href="'.get_template_directory_uri().'/images/sprites/main.stack.svg#image-close"></use>
					</svg>
				  </div>
				  <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
					<div class="team-person">
					  <div class="team-person__photo">';
						if(get_post_thumbnail_id( get_the_ID())){ 
							$popup .='<picture>';
							$popup .= '<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'full').'" alt="'.get_the_title().'"/></picture>';
							$popup .='</picture>';
						} 
					  $popup .='</div>
					  <div class="team-person__info">
						<div class="team-person__info-ocupation">'.get_field("position").'</div>
						<div class="team-person__info-name h3">'.get_field("first_name").' <br> '.get_field("last_name").'</div>
						<div class="team-person__info-description">'.$the_content.'</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>';
			$leadership_listrepeat++;
			endwhile; ?>
            </div>
			<?php endif; 
			wp_reset_query();
			?>
        </div>
      </section>
      <?php echo $popup; ?>
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
				'orderby' => 'name', 
				'order' => 'ASC', 
			);  
			
			$loop = new WP_Query( $args ); 
			$string = '';
			if($loop->have_posts() ): ?>
            <div class="team-experts__filter-list" id="teamList">
			<?php 
			  $experts_listrepeat = 0;
			  $expopup = '';
			  $totalpost = $loop->found_posts;
			  while ( $loop->have_posts() ) : $loop->the_post(); 
			  global $post; 
			  $type_cats = wp_get_object_terms( $post->ID, 'types', array( 'fields' => 'ids' ) );
			  if(!empty($type_cats)){
			  ?>
              <div class="team-experts__filter-item popup-link" data-popup="#popupAdvisor<?php echo $experts_listrepeat; ?>" data-filter="<?php echo implode(',', $type_cats); ?>"><?php echo get_the_title(); ?></div>
			  
			<?php 
			  }
			$expopup .= '<div class="popup popup--person" id="popupAdvisor'.$experts_listrepeat.'">
						<div class="popup__container">
						  <div class="popup__close">
							<svg class="icon" width="30" height="30" viewBox="0 0 30 30">
							  <use xlink:href="'.get_template_directory_uri().'/images/sprites/main.stack.svg#image-close"></use>
							</svg>
						  </div>
						  <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
							<div class="team-person">
							  <div class="team-person__expertise">';
							  if(get_field("expertise")){
								$expopup .= '<div class="team-person__expertise-content">
								  <div class="h4">Expertise:</div>'.get_field("expertise").'
								</div>';
							  }
							  $expopup .= '</div>
							  <div class="team-person__info">
								<div class="team-person__info-ocupation">'.get_field("position").'</div>
								<div class="team-person__info-name h3">'.get_field("first_name").' <br> '.get_field("last_name").'</div>
								<div class="team-person__info-description">'.get_the_content().'</div>
							  </div>
							</div>
						  </div>
						</div>
					  </div>';
			$experts_listrepeat++;
			endwhile;?>
            </div>
			<?php endif; 
			wp_reset_query();
			?>
          </div>
        </div>
      </section>
	<?php 
	echo $expopup;
	endwhile; endif; ?>
	<?php if( have_rows('clients_worldwide')): while( have_rows('clients_worldwide') ) : the_row(); ?>
      <section class="team-map" data-aos="fade-in">
        <div class="team-map__image">
          <?php
			if(!empty(get_sub_field('image'))){ ?>
				<picture>
				<?php echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] ); ?>
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