<?php
/*
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
	add_submenu_page( 'slickmap_css_sitemap_menu', 'Slickmap Settings Preview', 'Preview', 'manage-options', 'slickmap_css_sitemap_menu_preview', create_function( null, 'slickmap_css_sitemap_menu_content( "preview" );' ) );

}	//end slickmap_css_sitemap_menu()



//notice for settings saved
function slickmap_css_sitemap_saved_notice() {

	echo '
    <div class="updated">
        <p>Slickmap CSS Settings have been saved.</p>
    </div>
    ';

}	//end slickmap_css_sitemap_saved_notice()



//function to generate style string and save to transient
function slickmap_css_sitemap_save_style_transient() {

	$styles = slickmap_css_sitemap_return_user_styles();
	// echo '<h1>save_transient</h1>';
	if( false === ( $style_transient = get_transient( 'slickmap_css_sitemap_styles' ) ) ) {
	
		set_transient( 'slickmap_css_sitemap_styles', $styles, 30 * DAY_IN_SECONDS );
		// echo '<h2>No transient - New transient saved</h2>';
		slickmap_css_sitemap_saved_notice();
	
	}
	elseif( $style_transient != $styles ) {
		
			delete_transient( 'slickmap_css_sitemap_styles' );
			set_transient( 'slickmap_css_sitemap_styles', $styles, 30 * DAY_IN_SECONDS );
			// echo '<h2>Transient out of date - New transient saved</h2>';
			slickmap_css_sitemap_saved_notice();
		
	}	//end if( false !== ( $style_transient = get_transient( 'slickmap_css_sitemap_styles' ) ) )
// 	else { echo '<h2>Transient is current - No new transient saved</h2>'; }

}	//end slickmap_css_sitemap_save_style_transient()



//load frontend css file for admin preview
function slickmap_css_sitemap_include_frontend_css_admin() {

	echo '<link rel="stylesheet" id="slickmap_css-css" href="' . SlickMap_PLUGIN_URL . '/css/slickmap.css?ver=' . SlickMap_VERSION . '" type="text/css" media="all">';

}	//end slickmap_css_sitemap_include_frontend_css_admin()



//content of preview section; not a setting, so not within main menu page callback (but called by it!)
function slickmap_css_sitemap_menu_preview_callback() {
	
	slickmap_css_sitemap_include_frontend_css_admin();
	$styles = slickmap_css_sitemap_get_saved_styles();
	$content = '
	<ul id="primaryNav" class="col3" style="background: #fff; padding: 1em;">
		<li id="home">
			<a href="#home">Home</a>
		</li>
		<li>
			<a href="#level1-1">Level One - 1</a>
		</li>
		<li>
			<a href="#level1-2">Level One - 2</a>
			<ul>
				<li>
					<a href="#level2-1">Level Two - 1</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#level1-3">Level One - 3</a>
			<ul>
				<li>
					<a href="#level2-2">Level Two - 2</a>
					<ul>
						<li>
							<a href="#level3-1">Level Three - 1</a>
						</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
	';
	$sitemap = $styles;
	$sitemap .= '<div class="slickmap sitemap">';
	//wrapped ul content here
	$sitemap .= "\n		" . $content . "\n";
	$sitemap .= '</div>';
	
	echo '
		<h3>Preview Sitemap Settings:</h3>
		<hr/>';
	echo '
		' . $sitemap . '
	';

}	//end slickmap_css_sitemap_menu_preview_callback()

//callback for settings tabs
function slickmap_css_sitemap_menu_content( $active_tab = '' ) {

	slickmap_css_sitemap_save_style_transient();
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
            <a href="?page=slickmap_css_sitemap_menu&tab=preview" class="nav-tab <?php echo $active_tab == 'preview' ? 'nav-tab-active' : ''; ?>">Preview</a>
        </h2>
         
        <form method="post" action="options.php">
        
			
            <?php
            if( $active_tab == 'colors' ) {
            
             	settings_fields( 'slickmap_css_sitemap_menu_colors' );
				do_settings_sections( 'slickmap_css_sitemap_menu_colors' );
				submit_button();
            
            }
            elseif( $active_tab == 'text' ) {
            
             	settings_fields( 'slickmap_css_sitemap_menu_text' );
				do_settings_sections( 'slickmap_css_sitemap_menu_text' );
				submit_button();
            
            }
            elseif( $active_tab == 'preview' ) {
            
             	slickmap_css_sitemap_menu_preview_callback();
            
            }
            else {
            
            	settings_fields( 'slickmap_css_sitemap_menu_general' );
				do_settings_sections( 'slickmap_css_sitemap_menu_general' );
				submit_button();
            
            }	//end if( $active_tab == 'colors' )
           
        	?>
             
        </form>
    </div><!-- /.wrap -->
<?php

}	//end slickmap_css_sitemap_menu_content( $active_tab = '' )



//generate settings menu in admin
add_action( 'admin_init', 'slickmap_css_sitemap_settings_api_init' );

function slickmap_css_sitemap_settings_api_init() {
	
	//add the general settings section
	add_settings_section( 'slickmap_css_sitemap_general', 'Global Sitemap Style', 'slickmap_css_sitemap_general_callback', 'slickmap_css_sitemap_menu_general');
	
	//register general settings for savin'
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_gradient' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_font_family' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_radius' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_padding' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_breakpoint' );

	//add the fields for each general setting
	add_settings_field( 'slickmap_css_sitemap_general_gradient', 'Use White Gradient', 'slickmap_css_sitemap_general_gradient_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_font_family', 'Font Family', 'slickmap_css_sitemap_general_font_family_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_radius', 'Border Radius', 'slickmap_css_sitemap_general_radius_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_padding', 'Padding', 'slickmap_css_sitemap_general_padding_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_breakpoint', 'Mobile Breakpoint', 'slickmap_css_sitemap_general_breakpoint_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	
	
	
	//create sections, settings, and fields for each level
	global $slickmap_css_sitemap_default_levels;
	foreach( $slickmap_css_sitemap_default_levels as $level => $title ) {
	
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
		<input type="radio" name="slickmap_css_sitemap_general_gradient" value="show" <?php checked( $gradient, 'show' ) ?> > Frosty<br/>
		<input type="radio" name="slickmap_css_sitemap_general_gradient" value="hide" <?php checked( $gradient, 'hide' ) ?> > Flat
	<?php
	
	}
	else {
	
		echo '<input type="radio" name="slickmap_css_sitemap_general_gradient" value="show" checked="checked">Frosty<br/>
		<input type="radio" name="slickmap_css_sitemap_general_gradient" value="hide">Flat';
	
	}	//end if( $gradient )
	echo '</p>';
	
}	//end slickmap_css_sitemap_general_gradient_callback()




function slickmap_css_sitemap_general_font_family_callback() {

	if( get_option( 'slickmap_css_sitemap_general_font_family' ) ) {
	
		echo '<p><input size="90" name="slickmap_css_sitemap_general_font_family" id="slickmap_css_sitemap_general_font_family" type="text" value="' . get_option( 'slickmap_css_sitemap_general_font_family' ) . '" /></p>';
	
	}
	else {
	
		echo '<p><input size="90" name="slickmap_css_sitemap_general_font_family" id="slickmap_css_sitemap_general_font_family" type="text" value="Gotham, Helvetica, Arial, sans-serif" /></p>';
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_font_family' ) )

}	//end slickmap_css_sitemap_general_font_family_callback()




function slickmap_css_sitemap_general_radius_callback() {

	if( get_option( 'slickmap_css_sitemap_general_radius' ) ) {
	
		echo '<p><input size="18" name="slickmap_css_sitemap_general_radius" id="slickmap_css_sitemap_general_radius" type="text" value="' . get_option( 'slickmap_css_sitemap_general_radius' ) . '" /></p>';
	
	}
	else {
	
		echo '<p><input size="18" name="slickmap_css_sitemap_general_radius" id="slickmap_css_sitemap_general_radius" type="text" value="5px" /></p>';
	
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
	
		$padding = explode( ' ', get_option( 'slickmap_css_sitemap_general_padding' ) );
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_padding' ) )
	echo '<p><span style="min-width: 8em; display: inline-block">Top: </span><input size="10" class="slickmap_css_sitemap_general_padding" name="slickmap_css_sitemap_general_padding_top" id="slickmap_css_sitemap_general_padding_top" type="text" value="' . $padding[0] . '" /></p>';
	echo '<p><span style="min-width: 8em; display: inline-block">Right: </span><input size="10" class="slickmap_css_sitemap_general_padding" name="slickmap_css_sitemap_general_padding_right" id="slickmap_css_sitemap_general_padding_right" type="text" value="' . $padding[1] . '" /></p>';
	echo '<p><span style="min-width: 8em; display: inline-block">Bottom: </span><input size="10" class="slickmap_css_sitemap_general_padding" name="slickmap_css_sitemap_general_padding_bottom" id="slickmap_css_sitemap_general_padding_bottom" type="text" value="' . $padding[2] . '" /></p>';
	echo '<p><span style="min-width: 8em; display: inline-block">Left: </span><input size="10" class="slickmap_css_sitemap_general_padding" name="slickmap_css_sitemap_general_padding_left" id="slickmap_css_sitemap_general_padding_left" type="text" value="' . $padding[3] . '" /></p>';
	//JS concatenates all four visible field values ON CHANGE of any field into hidden field, the value of which is saved to registered setting.
	$padding_string = $padding[0] . ' ' . $padding[1] . ' ' . $padding[2] . ' ' . $padding[3];
	echo '<input name="slickmap_css_sitemap_general_padding" id="slickmap_css_sitemap_general_padding" type="hidden" value="' . $padding_string . '" />';

}	//end slickmap_css_sitemap_general_padding_callback()


function slickmap_css_sitemap_general_breakpoint_callback() {

	echo '<p>Enter the window with in pixels at which the sitemap changes to the vertical mobile style.<br/>Do not include units; numbers only. Default is 768.<br/>Enter "0" to disable mobile style.</p><p>';
	if( get_option( 'slickmap_css_sitemap_general_breakpoint' ) ) {
	
		echo '<input size="8" name="slickmap_css_sitemap_general_breakpoint" id="slickmap_css_sitemap_general_breakpoint" type="number" value="' . get_option( 'slickmap_css_sitemap_general_breakpoint' ) . '" />px</p>';
	
	}
	else {
	
		echo '<input size="8" name="slickmap_css_sitemap_general_breakpoint" id="slickmap_css_sitemap_general_breakpoint" type="number" value="768" />px</p>';
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_breakpoint' ) )

}	//end slickmap_css_sitemap_general_breakpoint_callback()




//include colorpicker and script to attach to color inputs
add_action( 'admin_enqueue_scripts', 'include_colorpicker_script_for_slickmap_options' );
function include_colorpicker_script_for_slickmap_options() {

	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'slickmap_css_sitemap_admin_js', SlickMap_PLUGIN_URL . '/js/slickmap_css_sitemap_adminfields.js', array( 'jquery', 'wp-color-picker' ), SlickMap_VERSION, true );
	wp_enqueue_style( 'wp-color-picker' );

}	//end function include_colorpicker_script_for_slickmap_options()