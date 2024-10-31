<?php
/*
Plugin Name: Интеграция СМС ПРОСТОР
Plugin URI:  https://wordpress.org/plugins/smsprostor/
Description: Отправка смс-сообщений Вашим клиентам
Version:     1.1.0
Author:      SMS Prostor
Author URI:  https://prostor-sms.ru
Text Domain: smsprostor
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }

include_once ( plugin_dir_path( __FILE__ ) . 'includes/admin.php' );

include_once ( plugin_dir_path( __FILE__ ) . 'extensions/prostorsms_gateway.php' );
include_once ( plugin_dir_path( __FILE__ ) . 'extensions/cf7.php' );
include_once ( plugin_dir_path( __FILE__ ) . 'extensions/woocommerce.php' );