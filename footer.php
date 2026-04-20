<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package growthperiod
 */

?>
    <?php if( have_rows('case_study__popup', 'option')): while( have_rows('case_study__popup', 'option') ) : the_row(); ?>
    <div class="popup" id="popupSolution12">
        <div class="popup__container">
          <div class="popup__close">
            <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
              <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
            </svg>
          </div>
          <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
            <div class="solution">
              <div class="solution__info">
                <div class="popup__header">
                  <div class="h4"><?php echo get_sub_field('title'); ?></div>
                </div>
                <div class="popup__body">
                  <div class="popup__form">
                    <?php echo do_shortcode('[contact-form-7 id="781" title="Case Study Popup" html-class="form"]'); ?>
                  </div>
                </div>
              </div>
              <?php if(!empty(get_sub_field('image'))) { ?>
              <div class="solution__image">
                <picture>
                  <img src="<?php echo get_sub_field('image')['url']; ?>" alt=""/>
                </picture>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
    </div>
    <?php endwhile; endif; ?>
	<footer class="footer <?php echo $args['footerClasses']; ?>">
      <div class="container footer__container">
        <div class="footer-contacts">
		  <?php if( have_rows('footer_contact_section', 'option')): ?>
          <div class="footer-contacts__container">
		  <?php while( have_rows('footer_contact_section', 'option') ) : the_row(); ?>
		  <?php if(!empty(get_sub_field('link'))) { ?>
            <div class="footer-contacts__row <?php echo get_sub_field('class'); ?>">
              <div class="footer-contacts__label"><?php echo get_sub_field('title'); ?></div>
              <div class="footer-contacts__value">
			  <?php if(get_sub_field('link')['url'] =='#') { echo get_sub_field('link')['title'];  } else { echo '<a href="'.get_sub_field('link')['url'].'">'.get_sub_field('link')['title'].'</a>';  } ?>
			  </div>
            </div>
		  <?php } ?>
		   <?php endwhile; ?>
          </div>
		  <?php endif; ?>
		  <?php if( have_rows('footer_social_menu', 'option')): ?>
          <div class="footer-contacts__socials">
		  <?php while( have_rows('footer_social_menu', 'option') ) : the_row(); ?>
		  <?php if(!empty(get_sub_field('link'))) { ?>
			<a class="footer-contacts__socials-link" href="<?php echo get_sub_field('link')['url']; ?>" target="<?php echo get_sub_field('link')['target']; ?>">
              <svg class="icon" width="40" height="40" viewBox="0 0 40 40">
                <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-<?php echo get_sub_field('icon'); ?>"></use>
              </svg>
			</a>
			<?php } ?>
			<?php endwhile; ?>
			</div>
			<?php endif; ?>
        </div>
      </div>
      <div class="container footer__container footer__container--baseline">
        <div class="footer__baseline"><a class="logo logo--dark" href="<?php echo site_url(); ?>">growth [period]</a>
          <div class="footer__menu">
		    <?php if( have_rows('footer_menu', 'option')): while( have_rows('footer_menu', 'option') ) : the_row(); ?>
            <?php if(!empty(get_sub_field('link'))) { ?><div class="footer__menu-item"><a class="footer__menu-link" href="<?php echo get_sub_field('link')['url']; ?>"><?php echo get_sub_field('link')['title']; ?></a></div><?php } ?>
			<?php endwhile; endif; ?>
          </div>
        </div>
      </div>
    </footer>
    <div class="contact-us">
      <div class="contact-us__link" id="contactsFormLink" aria-label="Open contact form" role="button">
        <div class="contact-us__link-icon">
          <svg class="icon" width="24" height="24" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 7.2c0-1.2 1-2.2 2.2-2.2h13.6C20 5 21 6 21 7.2v9.6c0 1.2-1 2.2-2.2 2.2H5.2C4 19 3 18 3 16.8V7.2zm2 .2 7 4.9 7-4.9" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <div class="contact-us__link-text">Contact</div>        
      </div>
      <div class="contact-us__form" id="contactsFrom">
        <div class="contact-us__form-close" id="contactsFromClose">
          <svg class="icon" width="40" height="40" viewBox="0 0 40 40">
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
          </svg>
        </div>
        <div class="contact-us__form-inner" data-simplebar>
          <div class="contact-us__form-caption">Hi there!</div>
          <div class="contact-us__form-notice">How can we help you succeed?</div>
		  <?php echo do_shortcode('[contact-form-7 id="5" title="Contact Growth Period"]'); ?>
		</div>
      </div>
    </div>
    <?php wp_footer(); ?>
    <?php
    $myipd = get_client_ip(); ?>
	<script>
    jQuery(document).ready(function(){
        jQuery('#user_ip.wpcf7-form-control.wpcf7-hidden').attr("value","<?php echo $myipd; ?>");
        jQuery(".popup-link").click(function(){
            var caseurl = jQuery(this).attr('data-caseurl');
            jQuery('#case_url.wpcf7-form-control.wpcf7-hidden').attr("value", caseurl) ;
        }); 
     
        document.addEventListener( 'wpcf7mailsent', function( event ) {
            var inputs = event.detail.inputs;
            if ( '781' == event.detail.contactFormId ) {
                for ( var i = 0; i < inputs.length; i++ ) {
                    if ( 'casestudy_url' == inputs[i].name ) {
                     /* window.location.href = inputs[i].value;*/
                      window.location.replace(inputs[i].value);
                      break;
                    }
                }
            }
        }, false );
    
    }); 
    </script>
  </body>
</html>
