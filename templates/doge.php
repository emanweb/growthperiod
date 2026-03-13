<?php
/**
 * Template Name: Custom Doge Template
 * Description: A template that displays content from post ID 2115 followed by posts with the "doge" tag
 */

get_header('', ["headerClasses" => "header--dark"]);  ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<main id="primary" class="site-main container">
    <section class="featured-content">
        <?php
        // Get the post with ID 2115
        $featured_post = get_post(2115);
        
        if ($featured_post) {
            // Display the title
            echo '<h1 class="featured-title">Navigating Reality vs. DOGE Hype</h1>';
            
            ?>
			<div class="featured-content"><h4>As organizations navigate the changing landscape under the new administration, it is essential to understand DOGE’s impacts.</h4>
				<img class="size-full wp-image-2170 alignright doge-image" src="https://growthperiod.com/wp-content/uploads/2022/10/Navigating-DOGE.png" style="float: right;margin: 20px;border-radius: 16px;" />
			<p><strong>Fact: The US Government Budget – Including for Government Contracting – Will Still Be in the Trillions of Dollars</strong>….growth[period] has an unapparelled network of former U.S. government officials and subject matter experts.&nbsp; Our experts’ networks, insights and experience help our clients navigate a successful path forward through the twists and turns of DOGE. Despite the proposed changes by DOGE, the federal government budget will remain in the trillions* of dollars. This Administration also favors privatization and outsourcing. Thus, allowing for opportunities for the government contracting sector to fill gaps. [*In FY 24 the government spent $6.75 trillion USD. Even if it is cut in half the government will spend over $3 trillion USD annually. Source: Congressional Budget Office]</p>
				
			<p style="text-align: center;">–</p>
			<p><strong>Fewer Contracts in Some Areas – Increased Spending in Others.</strong> The reality is that if your company provides any diversity, equity and inclusion related services those contracts are gone. However, the Trump Administration places a heavy emphasis on defense spending. This is also true in the context of Secretary Hegseth’s guidance on proposed cuts to the Pentagon’s budget.</p>
			<p>The House on February 25th passed a budget blueprint that invests an <strong>additional</strong> $100 billion in defense over the next decade. This is part of a sweeping Republican plan to enact President Trump’s agenda. This may seem oxymoronic, but it underscores how nuanced these activities are. &nbsp;The purpose of the defense budget is to <em>bolster our ability </em>to defend the nation and deter aggression against America or our allies and partners. That purpose still remains. The bipartisan resolve to sustain it transcends DOGE. In FY 24 total US Defense spending was approximately $850 billion dollars. Even with tradeoffs in defense spending priorities the spending across the sector is strong.</p>
				
			<p style="text-align: center;">–</p>
			<p><b>Effects on Small Businesses.</b> The Trump Administration is suggesting that small business set aside categories, such as 8a, should be eliminated or sharply curtailed. These set aside programs have broad support across both aisles in Congress. However, if these programs are eliminated, small business size standards and NAICS codes are applicable for contracting officers to leverage. This continues to provide opportunities for small businesses to compete successfully to win prime work with the government.</p>
			<p style="text-align: center;">–</p>
			<p><b>Performance based metrics. </b>This emphasis by DOGE just underlies the already existing trend of federal agencies increasingly favoring performance-based contracting models that emphasize measurable efficiency over flexibility. Such an environment enables agencies to increase their reliance on Other Transaction Agreements (OTAs) and Indefinite Delivery/Indefinite Quantity (IDIQ) contracts. These types of contracts allow agencies to scale contract awards up or down based on flexible and shifting metrics and budgetary requirements and are not new to the federal contracting landscape.</p>
			<p style="text-align: center;">–</p>
			<p><strong>Weekly Updates.</strong> growth[period] publishes a Weekly Administration Update that can help you track and understand how DOGE will impact your company. Please send us an email at hcongdon@growthprd.com if you wish to be added to the list. Our experts are also available to help your organization chart a smart way forward to ensure growth in the shadow of DOGE. Please contact us at info@growthperiod.com and let us know how we may best help you continue to succeed.</p>
			</div>
			<?php
        } else {
            echo '<p>Featured post not found.</p>';
        }
        ?>
    </section>

    <!-- Custom "See More" button section -->
    <div class="container contact__button">
        <a class="btn-more" href="#contactsFormLinkMenupage">
            <div class="contact-us__link-text">Contact us</div>
			
			<div class="contact-us__link-icon">
			  <svg class="icon" width="15" height="15" viewBox="0 0 15 15">
				<use xlink:href="https://growthperiod.com/wp-content/themes/growthperiod/images/sprites/main.stack.svg#image-arrow-top-right"></use>
			  </svg>
			</div>
        </a>
		
		<script>
			jQuery(document).ready(function(){
				jQuery('.container .contact__button .btn-more').on('click', function(){
					setTimeout(function(){
						jQuery('.contact-us__form').addClass('is-active');
					}, 50)
				});
				
				jQuery('.popup-link').each(function(index){
					jQuery(this).on('click', function(){
						var postslug = jQuery(this).attr('href');
						
						setTimeout(function(){
							jQuery(postslug).addClass('is-active');
						}, 50);
					});
				});
			});
		</script>
    </div>

    <!-- Posts grid with "doge" tag -->
    <section class="doge-posts-grid">
        <div class="grid-container">
            <?php
            // WP Query to get posts with "doge" tag
            $args = array(
                'tag' => 'doge',
                'posts_per_page' => 9, // Adjust number as needed
                'post_status' => 'publish'
            );
            
            $doge_query = new WP_Query($args);
            
            if ($doge_query->have_posts()) :
                while ($doge_query->have_posts()) : $doge_query->the_post();
                    ?>
                    <article class="grid-item">
                            <?php if (has_post_thumbnail()) : ?>
                               <!-- <div class="post-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>-->
                            <?php endif; ?>
                            
                            <h2 class="post-title"><?php the_title(); ?></h2>
                            
                            
                            <div class="post-meta">
								<a class="popup-link more about-insights__list-more" href="#<?php echo get_post_field('post_name'); ?>" data-popup="#<?php echo get_post_field('post_name'); ?>">Learn More</a>
                            </div>
						
						
                    </article>
                    <?php
                endwhile;
                
                // Reset post data
                wp_reset_postdata();
                
            else :
                echo '<p>No posts with the "doge" tag found.</p>';
            endif;
            ?>
        </div>
    </section>
	
	<!-- Popups for each post -->
    <?php
    // Run the query again to generate popups
    $doge_query = new WP_Query($args);
    
    if ($doge_query->have_posts()) :
        while ($doge_query->have_posts()) : $doge_query->the_post();
            $post_slug = get_post_field('post_name');
            $post_title = get_the_title();
            $post_id = get_the_ID();
            $post_date = get_the_date('F d, y');
            $post_content = get_the_content();
            ?>
            <div class="popup popup--news" id="<?php echo esc_attr($post_slug); ?>">
                <div class="popup__container">
                    <div class="popup__close">
                        <svg class="icon" width="30" height="30" viewBox="0 0 30 30">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprites/main.stack.svg#image-close"></use>
                        </svg>
                    </div>
                    <div class="popup__content" data-simplebar data-simplebar-auto-hide="false">
                        <div class="news-item">
                            <div class="news-item__title">
                                <div class="h3"><?php echo esc_html($post_title); ?></div>
                            </div>
                            <div class="news-item__date"><?php echo esc_html($post_date); ?></div>
                            <div class="news-item__content"><?php echo apply_filters('the_content', $post_content); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</main>

<style>
    /* Basic styling for the grid layout */
    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 40px;
    }
    
    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 480px) {
        .grid-container {
            grid-template-columns: 1fr;
        }
    }
    
    .grid-item {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .grid-item:hover {
        transform: translateY(-5px);
    }
    
    .grid-item a {
        display: block;
        text-decoration: none;
        color: inherit;
    }
    
    .post-thumbnail img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .post-title {
        padding: 15px 15px 5px;
        margin: 0;
        font-size: 18px;
    }
    
    .post-excerpt {
        padding: 0 15px;
        font-size: 14px;
    }
    
    .post-meta {
        padding: 5px 15px 15px;
        font-size: 12px;
        color: #666;
    }
    
    /* Styling for the "See More" button */
    .clients__button {
        margin: 40px 0;
        text-align: center;
    }
    
    .btn-more {
        display: inline-flex;
        align-items: center;
        background-color: #f5f5f5;
        padding: 12px 20px;
        border-radius: 30px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
    }
    
    .btn-more:hover {
        background-color: #e0e0e0;
    }
    
    .btn-more__text {
        margin-right: 10px;
        font-weight: 500;
    }
    
    .btn-more__icon {
        display: flex;
        align-items: center;
    }
</style>
<?php get_footer('', ["footerClasses" => ""]) ?>