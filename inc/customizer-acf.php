<?php
add_action('acf/init', 'growth_acf_op_init');
function growth_acf_op_init() {

    // Check function exists.
    if( function_exists('growth_acf_op_init') ) {

        // Register options page.
        $option_page = acf_add_options_page(array(
            'page_title'    => __('Growth General Settings'),
            'menu_title'    => __('Growth General Settings'),
            'menu_slug'     => 'growth-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
		
		$option_page = acf_add_options_page(array(
            'page_title'    => __('Our experts'),
            'menu_title'    => __('Our experts'),
            'menu_slug'     => 'growth-our-experts',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}

function acf_load_icon_field_choices( $field ) {
    // reset choices
    $field['choices'] = array();
    // get the textarea value from options page without any formatting
    $choices = get_field('experts_list_category', 'option', false);
    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);
    // remove any unwanted white space
    $choices = array_map('trim', $choices);
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $key => $choice ) {
            //$exploded = explode(' : ', $choice);
            $field['choices'][ $key ] = $choice;
          //  $field['choices'][ $choice ] = $choice;
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/name=experts_category', 'acf_load_icon_field_choices');




//Sampling Client Type

function sampling_client_type_acf_load_icon_field_choices( $field ) {
    // reset choices
    $field['choices'] = array();
    // get the textarea value from options page without any formatting
    $choices = get_field('sampling_client_type_area', 'option', false);
    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);
    // remove any unwanted white space
    $choices = array_map('trim', $choices);
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        foreach( $choices as $key => $choice ) {
            $exploded = explode(':', $choice);
            $field['choices'][ $exploded[0] ] = $exploded[1];
          //  $field['choices'][ $choice ] = $choice;
        }
    }
    // return the field
    return $field;
}
add_filter('acf/load_field/name=sampling_client_type', 'sampling_client_type_acf_load_icon_field_choices');