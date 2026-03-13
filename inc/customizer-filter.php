<?php
function wpgrowth_numeric_posts_nav( $max = '' ) {
  
    /* if( is_singular() )
        return; */
  
    global $wp_query;
  
    /** Stop execution if there's only 1 page */
    if($max == '')
     {
         global $wp_query;
         $max = $wp_query->max_num_pages;
         if(!$max)
         {
             $max = 1;
         }
     }
  
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    //$max   = intval( $wp_query->max_num_pages );
  
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
  
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
  
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
  
    echo '<div class="pagination">' . "\n";
    $prev = get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);
    /** Previous Page Link */
    if ( $paged > 1  )
        //printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
		printf( '<div class="pagination__prev"><a href="%s">
                <svg class="icon" width="50" height="54" viewBox="0 0 50 54">
                  <use xlink:href="'.get_template_directory_uri().'/images/sprites/main.stack.svg#image-arrow-left"></use>
                </svg></a></div>', get_pagenum_link( $paged-1 ));
	echo '<div class="pagination__list">' . "\n";
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' is-active' : '';
  
        printf( '<div class="pagination__item %s"><a href="%s">%s</a></div>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
  
        if ( ! in_array( 2, $links ) )
            echo '<div class="pagination__item %s">…</div>';
    }
  
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' is-active' : '';
        printf( '<div class="pagination__item %s"><a href="%s">%s</a></div>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
  
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<div class="pagination__item %s">…</div>' . "\n";
  
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<div class="pagination__item %s"><a href="%s">%s</a></div>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
    echo '</div>' . "\n";
    /** Next Post Link */
    if ( $paged < $max )
        printf( '<div class="pagination__next"><a href="%s">
                <svg class="icon" width="50" height="54" viewBox="0 0 50 54">
                  <use xlink:href="'.get_template_directory_uri().'/images/sprites/main.stack.svg#image-arrow-right"></use>
                </svg></a></div>', get_pagenum_link( $paged+1 ));
  
    echo '</div>' . "\n";
  
}