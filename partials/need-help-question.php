<?php if( have_rows('need_help_or_have_a_question', 'option')): while( have_rows('need_help_or_have_a_question', 'option') ) : the_row(); ?>
<div class="container b80"> 
  <div class="grey-bg helpline-box" data-aos="fade-up"> 
	<div class="row b-30 row-21 align-items-center">
	  <div class="col-lg-6 b30"> 
		<div class="text-def text-22 link-def">
		  <h3><?php echo get_sub_field('title'); ?></h3>
		  <p><?php echo get_sub_field('description'); ?></p>
		</div>
	  </div>
	  <div class="col-lg-6 b30"> 
		<div class="card-box">
		  <div class="row b-40"> 
			<?php if( have_rows('contact_list', 'option')): while( have_rows('contact_list', 'option') ) : the_row(); ?>
			<div class="col-12 b40"> 
			  <div class="text-22"><?php echo get_sub_field('title'); ?></div>
			  <?php if(!empty(get_sub_field('value'))) { ?><div class="text-lora text-28 text-c10"><?php echo get_sub_field('value')['title']; ?></div><?php } ?>
			</div>
			<?php endwhile; endif; ?>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php endwhile; endif; ?>