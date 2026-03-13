<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package growthperiod
 */

get_header('', ["headerClasses" => "header--dark"]);
?>
	<main class="main">
      <section class="news">
        <div class="container news__container">
          <div class="news__header" data-aos="fade-in">
            <h1 class="h2"><span class="accent"><?php esc_html_e( '404', 'growthperiod' ); ?></h1>
          </div>
		  <p><?php esc_html_e( 'It looks like nothing was found at this location.', 'growthperiod' ); ?></p>
		</div>
      </section>
	</main>
<?php
get_footer('', ["footerClasses" => "footer--grey"]); 
