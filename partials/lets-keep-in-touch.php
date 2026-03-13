<?php if( have_rows('lets_keep_in_touch', 'option')): while( have_rows('lets_keep_in_touch', 'option') ) : the_row(); ?>
	<div class="b225 container">
	  <div class="k-touch-area"> 
		<div class="k-touch-area__image">
			<?php
			  if(!empty(get_sub_field('image'))){ ?>
			  <picture>
				<?php
					echo getImageHTMLCodeWebp( get_sub_field('image'), 'full', ['class' => 'responsive-img cover-img'] );
				?>
			  </picture>
			<?php } ?>
		</div>
		<div class="k-touch-area__cont z10">
		  <div class="maw600">
			<h2 class="text-56"><?php echo get_sub_field('title'); ?></h2>
			<div class="text-22 b20 k-touch-desc"><?php echo get_sub_field('description'); ?></div>
			<div class="b32 form__styler">
				<?php echo do_shortcode('[contact-form-7 id="117" title="Lets keep in touch"]'); ?>
			
			</div>
		  </div>
		</div>
	  </div>
	</div>
<?php endwhile; endif; ?>