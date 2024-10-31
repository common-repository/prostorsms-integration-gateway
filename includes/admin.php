<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

function prostorsms_options_page() {

    $settingsPage = add_options_page(
        'Простор СМС',
        'Простор СМС',
        'manage_options',
        'prostorsms',
        'prostorsms_options_page_ui'
    );

    add_action('admin_print_styles-'. $settingsPage, 'prostorsms_styles');
    add_action('admin_print_scripts-'. $settingsPage, 'prostorsms_scripts');
}

function prostorsms_styles() {
    wp_enqueue_style( 'prostorsmsstyle', plugins_url( '../styles/style.min.css' , __FILE__ ) );
}

function prostorsms_scripts() {
    wp_enqueue_script( 'prostorsmsscript', plugins_url( '../scripts/script.js' , __FILE__ ) );
}

add_action( 'admin_menu', 'prostorsms_options_page' );

function prostorsms_options_page_ui() {

    include 'admin-ui.php';

}