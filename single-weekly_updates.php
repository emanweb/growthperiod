<?php
/**
 * The template for displaying Weekly Updates posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package growthperiod
 */

get_header('', ["headerClasses" => "header--dark"]);
?>
<main class="main">
      <section class="admin-update-intro">
        <div class="container admin-update-intro__container">
          <div class="admin-update-intro__info" data-aos="fade-in">
            <?php if( get_field('weekly_title') ) { ?>
              <div class="admin-update-intro__info-subtitle"><?php echo esc_html( get_field('weekly_title') ); ?></div>
            <?php } ?>
            <?php
            $week_date_raw = get_field('week_date');
            if( $week_date_raw ) {
                $date_obj = DateTime::createFromFormat('d/m/Y', $week_date_raw);
                $formatted_date = $date_obj ? $date_obj->format('n.j.Y') : $week_date_raw;
            ?>
              <div class="admin-update-intro__info-date">Weekly Update <?php echo esc_html( $formatted_date ); ?></div>
            <?php } ?>
            <div class="admin-update-intro__info-title">
              <h1 class="h3"><?php the_title(); ?></h1>
            </div>
          </div>
          <div class="admin-update-intro__image" data-aos="fade-in">
            <?php if( get_post_thumbnail_id( get_the_ID() ) ) { ?>
              <picture><img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"/></picture>
            <?php } ?>
          </div>
        </div>
      </section>
      <?php if( have_rows('content_area') ) : while( have_rows('content_area') ) : the_row(); ?>
        <?php if( get_row_layout() == 'content_item' ) : ?>
        <section class="admin-update-info">
          <div class="container admin-update-info__container">
            <?php if( get_sub_field('title') ) { ?>
              <h3 class="admin-update-info__title h3"><?php echo esc_html( get_sub_field('title') ); ?></h3>
            <?php } ?>
            <?php if( get_sub_field('content_section') ) { ?>
              <div class="admin-update-info__content"><?php echo wp_kses_post( get_sub_field('content_section') ); ?></div>
            <?php } ?>
          </div>
        </section>
        <?php endif; ?>
      <?php endwhile; endif; ?>

      <?php
      $pdf = get_field('pdf_upload');
      if( $pdf ) : ?>
      <section class="admin-update-pdf" data-aos="fade-in">
        <div class="container admin-update-pdf__container">
          <span class="admin-update-pdf__label">Download</span>
          <a class="admin-update-pdf__link" href="<?php echo esc_url( $pdf['url'] ); ?>" target="_blank" rel="noopener noreferrer">
            <?php echo esc_html( $pdf['title'] ? $pdf['title'] : 'Weekly Update PDF' ); ?>
          </a>
        </div>
      </section>
      <?php endif; ?>
    </main>
<?php get_footer(); ?>