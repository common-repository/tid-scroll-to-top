<?php
/*
 * @wordpress-plugin
 * Plugin Name:       TID Scroll to Top
 * Plugin URI:        https://wordpress.org/plugins/tid-scroll-to-top/
 * Description:       Simple scroll plugin for scroll bottom to up.
 * Author:            TechIT Dev
 * Author URI:        https://techitdev.com/
 * Version:           2.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Text Domain:       tid_stt
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */




/**
 * Plugin Option page Function
 */
add_action('admin_menu', 'tid_stt_add_theme_page');
function tid_stt_add_theme_page()
{
    add_menu_page('Scroll to Top Option for Admin', 'Scroll to Top', 'manage_options', 'tid-scroll-to-top', 'tid_create_page', 'dashicons-arrow-up-alt', 102);
}


// Including Admin CSS
function tid_stt_admin_enqueue_style()
{
    wp_enqueue_style('tid-stt-admin-style', plugins_url('css/tid-stt-admin-style.css', __FILE__), false, '1.0.0');
}
add_action('admin_enqueue_scripts', 'tid_stt_admin_enqueue_style');

// Including CSS
function tid_stt_enqueue_style()
{
    wp_enqueue_style('tid-stt-style', plugins_url('css/tid-stt-style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'tid_stt_enqueue_style');


// Including JS
function tid_stt_enqueue_script()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('tid-stt-plugin-script', plugins_url('js/tid-stt-plugin.js', __FILE__), array(), '1.0.0', 'true');
}
add_action('wp_enqueue_scripts', 'tid_stt_enqueue_script');



/**
 * Plugin Callback
 */

function tid_create_page()
{
?>

    <div class="tid-main-area">
        <div class="tid-body-area tid-common">
            <h3 id="title"><?php print esc_attr('🎨 Scroll Customizer') ?></h3>
            <!-- Primary Color -->
            <form action="options.php" method="post">
                <?php wp_nonce_field( 'update-options' );?>
                <div class="group-group">
                    <label for="tid-primary-color" name="tid-primary-color"> <?php print esc_attr('Primary Color') ?> </label>
                    <small>Add Your Primary Color</small>
                    <input type="color" name="tid-primary-color" value="<?php print get_option('tid-primary-color') ?>">
                </div>


                <!-- Buttion position -->
                <div class="group-group">
                    <label for="tid-button-position"> <?php print esc_attr('Button Position') ?> </label>
                    <small>Where do you want to show your button position?</small>
                    <select name="tid-button-position" id="tid-button-position">
                        <option value="true" <?php if (get_option('tid-button-position') == 'true') {
                            echo 'selected="selected"'; }; ?>>Left</option>

                        <option value="false" <?php if (get_option('tid-button-position') == 'false') {
                            echo 'selected="selected"';}; ?>>Right</option>
                    </select>
                </div>


                <!-- Rounded Corener -->
                <div class="group-group">
                    <label for="tid-rounded-corner"> <?php print esc_attr('Rounded Corner') ?> </label>
                    <small>Do you need a rounded corner button?</small>
                    <label for="radios">
                        <input type="radio" name="tid-rounded-corner" id="tid-rounded-corner" value="true" <?php if (get_option('tid-rounded-corner') == 'true') {
                             echo 'checked="checked"';  }; ?>>
                        <span>No</span>
                    </label>

                    <label for="radios">
                        <input type="radio" name="tid-rounded-corner" id="tid-rounded-corner" value="false" <?php if (get_option('tid-rounded-corner') == 'false') {
                               echo 'checked="checked"'; }; ?>>
                        <span>Yes</span>
                    </label>
                </div>

                <input type="hidden" name="action" value="update">
                <input type="hidden" name="page_options" value="tid-primary-color, tid-button-position, tid-rounded-corner">
                <input type="submit" name="submit" class="button button-primary" value="<?php _e('Save Changes', 'tid_stt'); ?>">
            </form>
        </div>

        <div class="tid-sidebar-area tid-common">
            <h3 id="title"><?php print esc_attr('👩‍💻 About Author') ?></h3>
            <p>
                <img src="<?php print plugin_dir_url(__FILE__) . '/img/author.png'; ?>" alt="<?php esc_attr('TechIT Dev'); ?>">
                <a href="https://techitdev.com/">Techit Dev</a> are founded in 2019 and connected all around the world.

                We’ve been working as a professional Website Development, Website Design, Software Development, Mobile App, Digital Marketing, and Search Engine Optimization(SEO) Service Company.
            </p>
            <p>
                <a href="https://www.buymeacoffee.com/techitdev/" target="_blank">
                    <img class="" src="<?php print plugin_dir_url(__FILE__) . '/img/bmc.png'; ?>" alt="">
                </a>
            </p>
        </div>
    </div>
<?php
}



// jQuery plugin setting activation
function tid_stt_scroll_script()
{
?>

    <script>
        jQuery(document).ready(function() {
            jQuery.scrollUp();
        });
    </script>

<?php
}
add_action('wp_footer', 'tid_stt_scroll_script');


// Plugin customization setting
// add_action( 'customize_register', 'tid_stt_scroll_to_top' );

// function tid_stt_scroll_to_top( $wp_customize) {

//     $wp_customize->add_section('tid_stt_scroll_top', array(
//         'title'=> __('Scroll to Top', 'tid_stt'),
//         'description'=> __('Simple scroll plugin for scroll bottom to up', 'tid_stt'),
//     ));
//     // Image backgound color
//     $wp_customize->add_setting('tid_stt_default_color', array(
//         'default'=> 'transparent',
//     ));
//     $wp_customize->add_control('tid_stt_default_color', array(
//         'label'=> 'Background Color',
//         'section'=> 'tid_stt_scroll_top',
//         'type'=> 'color',
//     ));

//     // Border radious 
//     $wp_customize->add_setting('tid_stt_border_radious', array(
//         'default'=> '5px',
//         'description'=> __('You may change border radious to 25 px', 'tid_stt'),

//     ));
//     $wp_customize->add_control('tid_stt_border_radious', array(
//         'label'=> 'Boder Radious',
//         'section'=> 'tid_stt_scroll_top',
//         'type'=> 'text',
//     ));
// }

// Theme CSS Customization
add_action('wp_head', 'tid_stt_color_customization');
function tid_stt_color_customization()
{
?>
    <style>
        #scrollUp {
            background-color: <?php print get_option('tid-primary-color'); ?> !important;
            <?php if (get_option('tid-button-position') == 'true') {
                echo "left:5px; right:auto";
            } else {
                echo "right:5px";
        } ?>;
        <?php if (get_option('tid-rounded-corner') == 'true')           {                                                                                                               echo "border-radius:0 !important";
                    } else {
                        echo "border-radius:50px !important";
                    }; ?>
        }
    </style>
<?php
}


 /*
  * Plugin Redirect Feature
  */
  register_activation_hook( __FILE__, 'tid_plugin_activation' );
  function tid_plugin_activation(){
    add_option('tid_plugin_do_activation_redirect', true);
  }

  add_action( 'admin_init', 'tid_plugin_redirect');
  function tid_plugin_redirect(){
    if(get_option('tid_plugin_do_activation_redirect', false)){
      delete_option('tid_plugin_do_activation_redirect');
      if(!isset($_GET['active-multi'])){
        wp_safe_redirect(admin_url( 'admin.php?page=tid-scroll-to-top' ));
        exit;
      }
    }
  }
?>