<?php
/**
 * Plugin Name:     Naoko Kato Utility
 * Plugin URI:
 * Description:     Necessary for this site functions :)
 * Author:          Hibou
 * Author URI:      https://hibou-web.com
 * Text Domain:     naokokato_utility
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Naokokato_utility
 */


/**
 * Set path.
 */
define( 'NAOKOKATOVERSION', '0.5.0' );
define( 'NAOKOKATOPATH', trailingslashit( dirname( __FILE__) ) );
define( 'NAOKOKATODIR', trailingslashit( dirname( plugin_basename( __FILE__ ) ) ) );
define( 'NAOKOKATOURL', plugin_dir_url( dirname( __FILE__ ) ) . NAOKOKATODIR );

require_once ( NAOKOKATOPATH . 'post-types/p_calendar.php' );
require_once ( NAOKOKATOPATH . 'op_shortcode.php' );
require_once ( NAOKOKATOPATH . 'naoko_calendar_acf.php' );