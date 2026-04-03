<?php
/*
Template Name: Industries
*/
get_header('', ["headerClasses" => "header--dark"]);
?> 
	<main class="main">
	 <?php if( have_rows('hero_section')): while( have_rows('hero_section') ) : the_row(); ?>
      <section class="industries-intro">
        <div class="container industries-intro__container">
          <div class="industries-intro__content">
            <h1 class="h3" data-aos="fade-in"><?php echo get_sub_field('title'); ?></h1>
            <div class="industries-intro__description" data-aos="fade-in" data-aos-delay="200"><?php echo get_sub_field('description'); ?></div>
            <div class="industries-intro__menu">
              <?php if( have_rows('links')): while( have_rows('links') ) : the_row(); ?>
              <?php if(!empty(get_sub_field('link'))) { ?><div class="industries-intro__menu-item"><a class="industries-intro__menu-link" href="<?php echo get_sub_field('link')['url']; ?>" data-smooth-scroll="<?php echo get_sub_field('link')['url']; ?>"><?php echo get_sub_field('link')['title']; ?></a></div><?php } ?>
			  <?php endwhile; endif; ?>
            </div>
            <div class="industries-intro__light"></div>
          </div>
		  <?php $gallery = get_sub_field('gallery'); 
		  if(!empty($gallery)){
		  ?>
          <div class="industries-intro__thumbs-outer">
            <div class="industries-intro__thumbs">
			 <?php foreach($gallery as $gal) { ?>
              <div class="industries-intro__thumbs-item">
			  <picture>
			  <img src="<?php echo $gal['url']; ?>" alt="">
			  </picture>
			  </div>
			<?php } ?>
            </div>
          </div>
		<?php } ?>
        </div>
      </section>
	  <?php endwhile; endif; ?>
	  <?php 
	  $industries_list_block = 1;
	  $totle_block = count(get_field('industries_list'));
	  if( have_rows('industries_list')): while( have_rows('industries_list') ) : the_row(); ?>
      <section class="industries-infoblock <?php echo get_sub_field('class'); ?>" id="<?php echo get_sub_field('id'); ?>">
        <div class="container industries-infoblock__container">
          <div class="industries-infoblock__holder <?php if( ($industries_list_block ==1) || ($totle_block == $industries_list_block)) {   } else { ?>industries-infoblock__holder--left<?php } ?>">
            <div class="industries-infoblock__title" data-aos="fade-in">
              <h2 class="h3"><?php echo get_sub_field('title'); ?></h2>
            </div>
            <?php
			//echo $totle_block .'=='. $industries_list_block;
			if(!empty(get_sub_field('image'))){ ?>
			<picture>
			<?php
				echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => ''] );
			?>
			</picture>
			<?php } ?>
          </div>
          <div class="industries-infoblock__description <?php if( ($industries_list_block ==1) || ($totle_block == $industries_list_block)) {  } else { ?>industries-infoblock__description--right<?php } ?>" data-aos="fade-in"><?php echo get_sub_field('description'); ?></div>
          <?php 
		  if( have_rows('item_list')):  ?>
          <ul class="industries-infoblock__nomenclature" data-aos="fade-in">
            <?php 
			$repeater_count = 1;
			$ind_delay = 50;
			while( have_rows('item_list') ) : the_row(); ?>
            <li data-aos="fade-up" data-aos-duration="500" data-aos-delay="<?php echo $ind_delay; ?>"><?php echo get_sub_field('text'); ?></li>
            <?php 
			$repeater_count++;
			$ind_delay = $ind_delay+50;
			endwhile; ?>
           </ul>
		  <?php endif; ?>
        </div>
      </section>
	  <?php 
	  $industries_list_block++;
	  endwhile; endif; ?>
	</main>
<?php get_footer('', ["footerClasses" => "footer--gray"]); 