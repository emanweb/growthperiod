<?php
/**
 * Archive template for Weekly Updates.
 *
 * @package growthperiod
 */

$case_link_mode = function_exists( 'check_using_ip_address' ) ? check_using_ip_address() : 'popup';

get_header('', ["headerClasses" => "header--dark"]);
?>
<main class="main">
	<section class="admin-update-intro">
		<div class="container admin-update-intro__container">
			<div class="admin-update-intro__info" data-aos="fade-in">
				<div class="admin-update-intro__info-date">Weekly Administration Updates</div>
				<div class="admin-update-intro__info-title">
					<h1 class="h3">All Weekly Updates</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="services">
		<div class="container services__container">
			<?php
			$weekly_updates_query = new WP_Query(
				[
					'post_type'           => 'weekly_updates',
					'post_status'         => 'publish',
					'posts_per_page'      => -1,
					'ignore_sticky_posts' => true,
					'orderby'             => 'date',
					'order'               => 'DESC',
				]
			);
			?>

			<?php if ( $weekly_updates_query->have_posts() ) : ?>
				<div class="services__list">
					<?php
					while ( $weekly_updates_query->have_posts() ) :
						$weekly_updates_query->the_post();

						$weekly_title = get_field( 'weekly_title' );
						$week_date_raw = get_field( 'week_date' );
						$formatted_week_date = '';

						if ( $week_date_raw ) {
							$date_obj = DateTime::createFromFormat( 'd/m/Y', $week_date_raw );
							$formatted_week_date = $date_obj ? $date_obj->format( 'n.j.Y' ) : $week_date_raw;
						}

						$display_title = $weekly_title ? $weekly_title : get_the_title();
						if ( $formatted_week_date ) {
							$display_title .= ' | Weekly Update ' . $formatted_week_date;
						}
						?>
						<a class="services__list-item <?php if($case_link_mode =='popup') { ?>popup-link<?php } ?>" data-caseurl="<?php echo esc_url( get_the_permalink() ); ?>" href="<?php if($case_link_mode =='popup') { echo '#'; } else { echo esc_url( get_the_permalink() ); } ?>" <?php if($case_link_mode =='popup') { ?>data-popup="#popupSolution12"<?php } ?> data-aos="fade-up">
							<div class="services__list-thumb">
								<?php if ( get_post_thumbnail_id( get_the_ID() ) ) : ?>
									<picture>
										<img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" alt="<?php echo esc_attr( wp_strip_all_tags( get_the_title() ) ); ?>" />
									</picture>
								<?php endif; ?>
							</div>
							<div class="services__list-title"><?php echo esc_html( $display_title ); ?></div>
							<div class="services__list-arrow">
								<svg class="icon" width="55" height="55" viewBox="0 0 55 55">
									<use xlink:href="<?php echo esc_url( get_template_directory_uri() . '/images/sprites/main.stack.svg#image-arrow-top-right2' ); ?>"></use>
								</svg>
							</div>
						</a>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p>No weekly updates found.</p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
