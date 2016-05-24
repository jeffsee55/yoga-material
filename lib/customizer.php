<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->add_setting(
    'primary_color',
    array(
      'default'     => '#000000',
      'transport'   => 'refresh',
    ) 
  );

  $className = 'WP_Customize_Color_Control';
  substr($className, strrpos($className, '\\') + 1);
  $wp_customize->add_control( new $className( $wp_customize, 'primary_color', array(
    'label'        => __( 'Primary Color', 'jsd-material' ),
    'section'    => 'colors',
    'settings'   => 'primary_color',
  ) ) );

  $wp_customize->add_section( 'jsd_material_logo_section' , array(
    'title'       => __( 'Logos', 'jsd-material' ),
    'priority'    => 30,
    'description' => 'Logos',
  ) );

  $className = 'WP_Customize_Image_Control';
  substr($className, strrpos($className, '\\') + 1);
  $wp_customize->add_setting( 'jsd_material_primary_logo' );
  $wp_customize->add_setting( 'jsd_material_secondary_logo' );

  $wp_customize->add_control( new $className( $wp_customize, 'jsd_material_primary_logo', array(
    'label'    => __( 'Primary Logo', 'jsd-material' ),
    'section'  => 'jsd_material_logo_section',
    'settings' => 'jsd_material_primary_logo',
  ) ) );
  $wp_customize->add_control( new $className( $wp_customize, 'jsd_material_secondary_logo', array(
    'label'    => __( 'Secondary Logo', 'jsd-material' ),
    'section'  => 'jsd_material_logo_section',
    'settings' => 'jsd_material_secondary_logo',
  ) ) );
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');

/**
 * Main Background Support
 */

$args = array(
	'default-color' => '999999',
	'default-image' => get_template_directory_uri() . '/dist/images/stardust.png',
);
add_theme_support( 'custom-background', $args );


/**
 * Header Color Support
 */
function jsd_custom_css() {
  $primary_color = get_theme_mod( 'primary_color', '#000000' );
  $darker = darken_color($primary_color, $darker=1.2);
  $header_gradient = '125deg,' . $primary_color . ',' . $primary_color . ' 60%,' . $darker . ' 40%,' . $darker;
  ?>
  <style type="text/css">
    .header { 
      background: <?php echo $primary_color; ?>;
    }
    @media( min-width: 981px ) {
      .header { 
        background: linear-gradient( <?php echo $header_gradient; ?> );
      }
    }
    .header .page-header h1 { 
      color: <?php echo $darker; ?>
    }
    a {
      color: <?php echo $darker; ?>
    }

    a:hover, a:focus {
      color: <?php echo $darker; ?>
    }
  </style>
<?php }

add_action( 'wp_head', __NAMESPACE__ . '\\jsd_custom_css');

function darken_color($rgb, $darker=2) {

    $hash = (strpos($rgb, '#') !== false) ? '#' : '';
    $rgb = (strlen($rgb) == 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) == 6) ? $rgb : false);
    if(strlen($rgb) != 6) return $hash.'000000';
    $darker = ($darker > 1) ? $darker : 1;

    list($R16,$G16,$B16) = str_split($rgb,2);

    $R = sprintf("%02X", floor(hexdec($R16)/$darker));
    $G = sprintf("%02X", floor(hexdec($G16)/$darker));
    $B = sprintf("%02X", floor(hexdec($B16)/$darker));

    return $hash.$R.$G.$B;
}
