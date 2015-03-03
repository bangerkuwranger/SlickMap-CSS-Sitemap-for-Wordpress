<?php
/**
 * Plugin Name: SlickMap CSS Sitemap
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin to create a custom HTML/CSS sitemap. Set your colors and fonts, then wrap any set of ULs in a shortcode to make an interactive sitemap. Uses Matt Everson's SlickMap CSS (astuteo.com); give him money if you dig this. 
 * Version: 1.3
 * File: settings.php
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2015 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

$slickmap_css_sitemap_default_levels = array (

	'home'		=> 'Home',
	'level1'	=> 'One',
	'level2'	=> 'Two',
	'level3'	=> 'Three',

);




$slickmap_css_sitemap_default_colors = array (

	'slickmap_css_sitemap_home_bgcolor'				=> '#c3eafb',
	'slickmap_css_sitemap_home_bgcolor_hover'		=> '#e2f4fd',
	'slickmap_css_sitemap_home_bordercolor'			=> '#b5d9ea',
	'slickmap_css_sitemap_home_bordercolor_hover'	=> '#97bdcf',
	'slickmap_css_sitemap_level1_bgcolor'			=> '#c3eafb',
	'slickmap_css_sitemap_level1_bgcolor_hover'		=> '#e2f4fd',
	'slickmap_css_sitemap_level1_bordercolor'		=> '#b5d9ea',
	'slickmap_css_sitemap_level1_bordercolor_hover'	=> '#97bdcf',
	'slickmap_css_sitemap_level2_bgcolor'			=> '#cee3ac',
	'slickmap_css_sitemap_level2_bgcolor_hover'		=> '#e7f1d7',
	'slickmap_css_sitemap_level2_bordercolor'		=> '#b8da83',
	'slickmap_css_sitemap_level2_bordercolor_hover'	=> '#94b75f',
	'slickmap_css_sitemap_level3_bgcolor'			=> '#fff7aa',
	'slickmap_css_sitemap_level3_bgcolor_hover'		=> '#fffce5',
	'slickmap_css_sitemap_level3_bordercolor'		=> '#e3ca4b',
	'slickmap_css_sitemap_level3_bordercolor_hover'	=> '#d1b62c',

);

	

function slickmap_css_sitemap_colors_section_callback( $arg ) {
 	
 	$section = $arg['title'];
	echo '<p>Settings here will affect the colors of <b>' . $section . '</b> boxes in your sitemap.</p>';

}	//end slickmap_css_sitemap_colors_section_callback( $arg )



function slickmap_css_sitemap_color_field_callback( $args ) {

	$level = $args['label_for'];
	$type = $args['type'];
	global $slickmap_css_sitemap_default_colors;
	$setting = 'slickmap_css_sitemap_' . $level . '_' . $type;
	if ( get_option( $setting ) ) {
	
		$value = get_option( $setting );
	
	}
	else {
	
		$value = $slickmap_css_sitemap_default_colors[$setting];
	
	}	//end if ( get_option( $setting ) )
	echo '<input name="' . $setting . '" id="' . $setting . '" class="iris-color-picker-field" type="text" value="' . $value . '" />';

}	//end slickmap_css_sitemap_color_field_callback( $args )



$slickmap_css_sitemap_default_text = array (

	'slickmap_css_sitemap_home_title_text_color'	=> '#000000',
	'slickmap_css_sitemap_home_path_text_color'		=> '#78a9c0',
	'slickmap_css_sitemap_home_title_text_size'		=> '14px',
	'slickmap_css_sitemap_home_path_text_size'		=> '10px',
	'slickmap_css_sitemap_level1_title_text_color'	=> '#000000',
	'slickmap_css_sitemap_level1_path_text_color'	=> '#78a9c0',
	'slickmap_css_sitemap_level1_title_text_size'	=> '14px',
	'slickmap_css_sitemap_level1_path_text_size'	=> '10px',
	'slickmap_css_sitemap_level2_title_text_color'	=> '#000000',
	'slickmap_css_sitemap_level2_path_text_color'	=> '#8faf5c',
	'slickmap_css_sitemap_level2_title_text_size'	=> '14px',
	'slickmap_css_sitemap_level2_path_text_size'	=> '10px',
	'slickmap_css_sitemap_level3_title_text_color'	=> '#000000',
	'slickmap_css_sitemap_level3_path_text_color'	=> '#ccae14',
	'slickmap_css_sitemap_level3_title_text_size'	=> '12px',
	'slickmap_css_sitemap_level3_path_text_size'	=> '9px',

);

	

function slickmap_css_sitemap_text_section_callback( $arg ) {
 	
 	$section = $arg['title'];
	echo '<p>Settings here will affect the text of <b>' . $section . '</b> boxes in your sitemap.</p>';

}	//end slickmap_css_sitemap_text_section_callback( $arg )



function slickmap_css_sitemap_text_field_callback( $args ) {

	$level = $args['label_for'];
	$type = $args['type'];
	$fieldtype = $args['field'];
	global $slickmap_css_sitemap_default_text;
	$setting = 'slickmap_css_sitemap_' . $level . '_' . $type;
	if ( get_option( $setting ) ) {
	
		$value = get_option( $setting );
	
	}
	else {
	
		$value = $slickmap_css_sitemap_default_text[$setting];
	
	}	//end if ( get_option( $setting ) )
	if( $fieldtype == 'color' ) {

		echo '<input name="' . $setting . '" id="' . $setting . '" class="iris-color-picker-field" type="text" value="' . $value . '" />';

	}
	else {
	
		echo '<p><input size="10" name="' . $setting . '" id="' . $setting . '" type="text" value="' . $value . '" /></p>';
	
	}	//end if( $fieldtype == 'color' )

}	//end slickmap_css_sitemap_color_field_callback( $args )



//class for each level's settings
class slickmap_level {

	public $level_title;
	public $level_id;

	
	
	function __construct( $id ) {
	
		$this->level_id = $id;
		global $slickmap_css_sitemap_default_levels;
		$this->level_title = $slickmap_css_sitemap_default_levels[$id];
		$this->_color_settings();
		$this->_text_settings();
	
	}	//end __construct( $id )
	
	private function _color_settings() {
		
		add_settings_section( 'slickmap_css_sitemap_colors_' . $this->level_id, 'Level - ' . $this->level_title, 'slickmap_css_sitemap_colors_section_callback', 'slickmap_css_sitemap_menu_colors');
		$color_settings = array (

			'bgcolor'				=> 'Background Color',
			'bgcolor_hover'			=> 'Background Color - Hover',
			'bordercolor'			=> 'Border Color',
			'bordercolor_hover'		=> 'Border Color - Hover',

		);
		foreach( $color_settings as $type => $title ) {
		
			$args = array(
			
				'label_for'	=> $this->level_id,
				'type'		=> $type,
				
			);
			add_settings_field( 'slickmap_css_sitemap_' . $args['label_for'] . '_' . $type, $title, 'slickmap_css_sitemap_color_field_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_' . $args['label_for'], $args );
			register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_' . $args['label_for'] . '_' . $type );
			
		}	//end foreach( $color_settings as $type => $title )
		
	}	//end _color_settings()
	
	
	
	
	private function _text_settings() {
	
		add_settings_section( 'slickmap_css_sitemap_text_' . $this->level_id, 'Level - ' . $this->level_title, 'slickmap_css_sitemap_text_section_callback', 'slickmap_css_sitemap_menu_text');
		$text_settings = array (

			'title_text_color'	=> 'Title Color',
			'title_text_size'	=> 'Title Size',
			'path_text_color'	=> 'Path Color',
			'path_text_size'	=> 'Path Size',

		);
		foreach( $text_settings as $type => $title ) {
		
			$args = array(
			
				'label_for'	=> $this->level_id,
				'type'		=> $type,
				
			);
			if( strpos( $type, 'color' ) !== FALSE ) {
			
				$args['field'] = 'color';
			
			}
			else {
			
				$args['field'] = 'text';
			
			}	//end if( strpos( $type, 'color' ) !== FALSE )
			add_settings_field( 'slickmap_css_sitemap_' . $args['label_for'] . '_' . $type, $title, 'slickmap_css_sitemap_text_field_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_' . $args['label_for'], $args );
			register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_' . $args['label_for'] . '_' . $type );
			
		}	//end foreach( $text_settings as $type => $title )
	
	}	//end _text_settings()

}	//end class slickmap_level


	

//create settings menu item for sitemap styles
add_action('admin_menu', 'slickmap_css_sitemap_menu');
function slickmap_css_sitemap_menu() {

	add_menu_page( 'SlickMap CSS Sitemap Options', 'SlickMap Options', 'manage_options', 'slickmap_css_sitemap_menu', 'slickmap_css_sitemap_menu_content', 'dashicons-networking', '88.898');
	add_submenu_page( 'slickmap_css_sitemap_menu', 'SlickMap CSS General Settings', 'General', 'manage-options', 'slickmap_css_sitemap_menu_general', create_function( null, 'slickmap_css_sitemap_menu_content( "general" );' ) ); 
	add_submenu_page( 'slickmap_css_sitemap_menu', 'SlickMap CSS Colors', 'Colors', 'manage-options', 'slickmap_css_sitemap_menu_colors', create_function( null, 'slickmap_css_sitemap_menu_content( "colors" );' ) ); 
	add_submenu_page( 'slickmap_css_sitemap_menu', 'SlickMap CSS Text Options', 'Text', 'manage-options', 'slickmap_css_sitemap_menu_text', create_function( null, 'slickmap_css_sitemap_menu_content( "text" );' ) );

}	//end slickmap_css_sitemap_menu()


//callback for settings tabs
function slickmap_css_sitemap_menu_content( $active_tab = '' ) {

?>
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2>SlickMap CSS Sitemap Settings</h2>
         
        <?php
        	$active_tab = 'general';
            if( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = $_GET[ 'tab' ];
            } // end if
        ?>
         
        <h2 class="nav-tab-wrapper">
        	<a href="?page=slickmap_css_sitemap_menu&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
            <a href="?page=slickmap_css_sitemap_menu&tab=colors" class="nav-tab <?php echo $active_tab == 'colors' ? 'nav-tab-active' : ''; ?>">Colors</a>
            <a href="?page=slickmap_css_sitemap_menu&tab=text" class="nav-tab <?php echo $active_tab == 'text' ? 'nav-tab-active' : ''; ?>">Text Options</a>
        </h2>
         
        <form method="post" action="options.php">
        
			
            <?php
             if( $active_tab == 'colors' ) {
             	settings_fields( 'slickmap_css_sitemap_menu_colors' );
				do_settings_sections( 'slickmap_css_sitemap_menu_colors' ); 
            }
             elseif( $active_tab == 'text' ) {
             	settings_fields( 'slickmap_css_sitemap_menu_text' );
				do_settings_sections( 'slickmap_css_sitemap_menu_text' ); 
            }
            else {
            	settings_fields( 'slickmap_css_sitemap_menu_general' );
				do_settings_sections( 'slickmap_css_sitemap_menu_general' ); 
            }
           
        	submit_button(); ?>
             
        </form>
    </div><!-- /.wrap -->
<?php

}	//end slickmap_css_sitemap_menu_content( $active_tab = '' )



//generate settings menu in admin
add_action( 'admin_init', 'slickmap_css_sitemap_settings_api_init' );

function slickmap_css_sitemap_settings_api_init() {
	
	//add the general settings section
	add_settings_section( 'slickmap_css_sitemap_general', 'Global Sitemap Style', 'slickmap_css_sitemap_general_callback', 'slickmap_css_sitemap_menu_general');

	//register the fields for each general setting
	add_settings_field( 'slickmap_css_sitemap_general_gradient', 'Use White Gradient', 'slickmap_css_sitemap_general_gradient_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_font_family', 'Font Family', 'slickmap_css_sitemap_general_font_family_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_radius', 'Border Radius', 'slickmap_css_sitemap_general_radius_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_padding', 'Padding', 'slickmap_css_sitemap_general_padding_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	
	//register general settings for savin'
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_gradient' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_font_family' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_radius' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_padding' );
	
	//create sections, settings, and fields for each level
	global $slickmap_css_sitemap_default_levels;
	foreach( $slickmap_css_sitemap_default_levels as $level ) {
	
		New slickmap_level( $level );
	
	}	//end foreach( $slickmap_css_sitemap_default_levels as $level )

}	//end slickmap_css_sitemap_settings_api_init()




//general section callback
function slickmap_css_sitemap_general_callback() {

	echo '<p>Settings here will affect all of the boxes in your sitemap.</p>';

}	//end slickmap_css_sitemap_general_callback()




//general option field callbacks
function slickmap_css_sitemap_general_gradient_callback() {

	$gradient = get_option( 'slickmap_css_sitemap_general_gradient' );
	echo '<p>';
	if( $gradient ) {
	
	?>
		<input type="radio" name="slickmap_css_gradient" value="show" <?php checked( $gradient, 'show' ) ?> > Frosty<br/>
		<input type="radio" name="slickmap_css_gradient" value="hide" <?php checked( $gradient, 'hide' ) ?> > Flat
	<?php
	
	}
	else {
	
		echo '<input type="radio" name="slickmap_css_gradient" value="show" checked="checked">Frosty<br/>
		<input type="radio" name="slickmap_css_gradient" value="hide">Flat';
	
	}	//end if( $gradient )
	echo '</p>';
	
}	//end slickmap_css_sitemap_general_gradient_callback()




function slickmap_css_sitemap_general_font_family_callback() {

	if( get_option( 'slickmap_css_sitemap_general_font_family' ) ) {
	
		echo "<p><input size='90' name='slickmap_css_sitemap_general_font_family' id='slickmap_css_sitemap_general_font_family' type='text' value='" . get_option( 'slickmap_css_sitemap_general_font_family' ) . "' /></p>";
	
	}
	else {
	
		echo "<p><input size='90' name='slickmap_css_sitemap_general_font_family' id='slickmap_css_sitemap_general_font_family' type='text' value='Gotham, Helvetica, Arial, sans-serif' /></p>";
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_font_family' ) )

}	//end slickmap_css_sitemap_general_font_family_callback()




function slickmap_css_sitemap_general_radius_callback() {

	if( get_option( 'slickmap_css_sitemap_general_radius' ) ) {
	
		echo "<p><input size='10' name='slickmap_css_sitemap_general_radius' id='slickmap_css_sitemap_general_radius' type='text' value='" . get_option( 'slickmap_css_sitemap_general_radius' ) . "' /></p>";
	
	}
	else {
	
		echo "<p><input size='10' name='slickmap_css_sitemap_general_radius' id='slickmap_css_sitemap_general_radius' type='text' value='5px' /></p>";
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_radius' ) )

}	//end slickmap_css_sitemap_general_radius_callback()




function slickmap_css_sitemap_general_padding_callback() {

	$padding = array (
		'top'		=>	'10px',
		'right' 	=>	'0px',
		'bottom'	=>	'10px',
		'left'	 	=>	'0px',
	);
	if( get_option( 'slickmap_css_sitemap_general_padding' ) ) {
	
		$padding = get_option( 'slickmap_css_sitemap_general_padding' );
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_padding' ) )
	echo "<p>Top: <input size='10' name='slickmap_css_sitemap_general_padding_top' id='slickmap_css_sitemap_general_padding_top' type='text' value='" . $padding['top'] . "' /></p>";
	echo "<p>Bottom: <input size='10' name='slickmap_css_sitemap_general_padding_bottom' id='slickmap_css_sitemap_general_padding_bottom' type='text' value='" . $padding['bottom'] . "' /></p>";
	echo "<p>Right: <input size='10' name='slickmap_css_sitemap_general_padding_right' id='slickmap_css_sitemap_general_padding_right' type='text' value='" . $padding['right'] . "' /></p>";
	echo "<p>Left: <input size='10' name='slickmap_css_sitemap_general_padding_left' id='slickmap_css_sitemap_general_padding_left' type='text' value='" . $padding['left'] . "' /></p>";
	update_option( 'slickmap_css_sitemap_general_padding', $padding );

}	//end slickmap_css_sitemap_general_padding_callback()




//include colorpicker and attach to color inputs
function include_colorpicker_script_for_slickmap_options() {
	wp_enqueue_script( 'wp-color-picker' );
	// load the custom script
	wp_enqueue_script( 'slickmap_css_sitemap_admin_js', SlickMap_PLUGIN_URL . 'js/slickmap_css_sitemap_adminfields.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'include_colorpicker_script_for_slickmap_options' );