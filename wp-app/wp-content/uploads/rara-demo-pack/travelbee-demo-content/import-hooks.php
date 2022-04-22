<?php
/**
 * Travelbee Template Hooks.
 *
 * @package Travelbee
 */

/** Import content data*/
if ( ! function_exists( 'travelbee_import_files' ) ) :
function travelbee_import_files() {
  $upload_dir = wp_upload_dir();
    return array(
        array(
            'import_file_name'             => 'Travelbee Demo',
            'local_import_file'            => $upload_dir['basedir'] . '/rara-demo-pack/travelbee-demo-content/content/travelbee.xml',
            'local_import_widget_file'     => $upload_dir['basedir'] . '/rara-demo-pack/travelbee-demo-content/content/travelbee.wie',
            'local_import_customizer_file' => $upload_dir['basedir'] . '/rara-demo-pack/travelbee-demo-content/content/travelbee.dat',
            'import_preview_image_url'     => get_template_directory() .'/screenshot.png',
            'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'travelbee' ),
        ),
    );       
}
add_filter( 'rrdi/import_files', 'travelbee_import_files' );
endif;

/** Programmatically set the front page and menu */
if ( ! function_exists( 'travelbee_after_import' ) ) :

    function travelbee_after_import( $selected_import ) {
      
    //Set Menu
    $primary   = get_term_by('name', 'Primary Menu', 'nav_menu');
    $footer = get_term_by('name', 'Secondary Menu', 'nav_menu');
    set_theme_mod( 'nav_menu_locations' , array( 
        'primary'   => $primary->term_id,
        'footer'   => $footer->term_id
       ) 
    );
      
}
add_action( 'rrdi/after_import', 'travelbee_after_import' );
endif;


function travelbee_import_msg(){
    return __( 'Before you begin, make sure all recommended plugins are activated.', 'travelbee' );
}
add_filter( 'rrdi_before_import_msg', 'travelbee_import_msg' );