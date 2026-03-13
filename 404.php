<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
