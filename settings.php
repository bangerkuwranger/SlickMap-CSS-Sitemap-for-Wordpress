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



//display names for levels; also iterated over to create all 'slickmap_level' objects and their settings fields
$slickmap_css_sitemap_level_names = array (

	'home'		=> 'Home',
	'level1'	=> 'One',
	'level2'	=> 'Two',
	'level3'	=> 'Three',

);




//general callback for each level's color settings section header
function slickmap_css_sitemap_colors_section_callback( $arg ) {
 	
 	$section = $arg['title'];
	echo '<p>Settings here will affect the colors of <b>' . $section . '</b> boxes in your sitemap.</p>';

}	//end slickmap_css_sitemap_colors_section_callback( $arg )



//general callback for each color setting's field
function slickmap_css_sitemap_color_field_callback( $args ) {

	$level = $args['label_for'];
	$type = $args['type'];
	//set option name
	$setting = 'slickmap_css_sitemap_' . $level . '_' . $type;
	//use saved setting as value; fallback to default from $slickmap_css_sitemap_default_settings if no value is saved
	if ( get_option( $setting ) ) {
	
		$value = get_option( $setting );
	
	}
	else {
	
		global $slickmap_css_sitemap_default_settings;
		$color_setting_to_property = array (

			'bgcolor'			=> 'background-color',
			'bgcolor_hover'		=> 'background-color',
			'bordercolor'		=> 'border-color',
			'bordercolor_hover'	=> 'border-color',

		);
		$property = $color_setting_to_property[$type];
		$level_defaults = $slickmap_css_sitemap_default_settings[$level];
		$default_keys = array_keys( $level_defaults );
		if( strpos( $type, 'hover' ) !== false ) {
	
			$selector = $default_keys[2];
	
		}
		else {
	
			$selector = $default_keys[0];
	
		}	//end if( strpos( $type, 'hover' ) !== false )
		$value = $level_defaults[$selector][$property]['default'];
	
	}	//end if ( get_option( $setting ) )
	//create input for color setting
	echo '<input name="' . $setting . '" id="' . $setting . '" class="iris-color-picker-field" type="text" value="' . $value . '" />';

}	//end slickmap_css_sitemap_color_field_callback( $args )



//general callback for each level's text settings section header
function slickmap_css_sitemap_text_section_callback( $arg ) {
 	
 	$section = $arg['title'];
	echo '<p>Settings here will affect the text of <b>' . $section . '</b> boxes in your sitemap.</p>';

}	//end slickmap_css_sitemap_text_section_callback( $arg )



//general callback for each text setting's field
function slickmap_css_sitemap_text_field_callback( $args ) {

	$level = $args['label_for'];
	$type = $args['type'];
	$fieldtype = $args['field'];
	//set option name
	$setting = 'slickmap_css_sitemap_' . $level . '_' . $type;
	//use saved setting as value; fallback to default from $slickmap_css_sitemap_default_settings if no value is saved
	if ( get_option( $setting ) ) {
	
		$value = get_option( $setting );
	
	}
	else {
	
		global $slickmap_css_sitemap_default_settings;
		$text_setting_to_property = array (

			'title_text_color'	=> 'color',
			'path_text_color'	=> 'color',
			'title_text_size'	=> 'font-size',
			'path_text_size'	=> 'font-size',

		);
		$property = $text_setting_to_property[$type];
		$level_defaults = $slickmap_css_sitemap_default_settings[$level];
		$default_keys = array_keys( $level_defaults );
		if( strpos( $type, 'path' ) !== false ) {
	
			$selector = $default_keys[1];
	
		}
		else {
	
			$selector = $default_keys[0];
	
		}	//end if( strpos( $type, 'path' ) !== false )
		$value = $level_defaults[$selector][$property]['default'];
		
	
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
		global $slickmap_css_sitemap_level_names;
		$this->level_title = $slickmap_css_sitemap_level_names[$id];
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
	add_submenu_page( 'slickmap_css_sitemap_menu', 'Advanced CSS Settings', 'Advanced', 'manage-options', 'slickmap_css_sitemap_menu_advanced', create_function( null, 'slickmap_css_sitemap_menu_content( "advanced" );' ) );
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
	<ul id="primaryNav" class="col3" style="background: #fff; padding: 1em; max-width: 90%">
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
	$sitemap .= '<div class="slickmap sitemap" style="min-height: 400px;">';
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
	$reset_all = false;
	if( isset( $_GET[ 'reset_all' ] ) ) {
	
		$reset_all = $_GET[ 'reset_all' ];
	
	} // end if( isset( $_GET[ 'reset_all' ] ) )
	if( $reset_all == true ) {
	
		echo '
		<div class="error">
			<p>Slickmap CSS Settings have been reset to default values.</p>
		</div>
		';
		slickmap_css_sitemap_reset_all();
	
	}	//end if( $reset_all === true )
?>
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2>SlickMap CSS Sitemap Settings</h2>
         
        <?php
        	$active_tab = 'general';
            if( isset( $_GET[ 'tab' ] ) ) {
            
                $active_tab = $_GET[ 'tab' ];
            
            } // end if( isset( $_GET[ 'tab' ] ) )
        ?>
         
        <h2 class="nav-tab-wrapper">
        	<a href="?page=slickmap_css_sitemap_menu&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
            <a href="?page=slickmap_css_sitemap_menu&tab=colors" class="nav-tab <?php echo $active_tab == 'colors' ? 'nav-tab-active' : ''; ?>">Colors</a>
            <a href="?page=slickmap_css_sitemap_menu&tab=text" class="nav-tab <?php echo $active_tab == 'text' ? 'nav-tab-active' : ''; ?>">Text Options</a>
             <a href="?page=slickmap_css_sitemap_menu&tab=advanced" class="nav-tab <?php echo $active_tab == 'advanced' ? 'nav-tab-active' : ''; ?>">Advanced</a>
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
            elseif( $active_tab == 'advanced' ) {
            
            	settings_fields( 'slickmap_css_sitemap_menu_advanced' );
				do_settings_sections( 'slickmap_css_sitemap_menu_advanced' );
            
            	if( !( wp_script_is( 'ace-editor', 'enqueued' ) ) ) {
            	
            		if( ( wp_script_is( 'ace-editor', 'registered' ) ) ) {
            		
            			wp_enqueue_script( 'ace-editor' );
            		
            		}
            		else {
            		
            			wp_enqueue_script( 'ace-editor', SlickMap_PLUGIN_URL . '/lib/ace/ace.js', array( 'jquery' ), null, true );
            		
            		}	//end if( ( wp_script_is( 'ace-editor', 'registered' ) ) )
            	
            	}	//end if( !( wp_script_is( 'ace-editor', 'enqueued' ) ) )
            	?>
				<style type="text/css" media="screen">
					#slickmap_css_sitemap_ace_editor {
						margin: 0;
						position: absolute;
						top: 7em;
						bottom: 6em;
						left: 0;
						right: 0;
					}
					.wrap form {
						position: relative;
						min-height: 400px;
						overflow: hidden;
					}
					p.submit {
						position: absolute;
						bottom: 0;
					}
				</style>
				<pre id="slickmap_css_sitemap_ace_editor"></pre>
				<?php
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
        <hr/>
        <div style="background: #fcc; border: 2px solid #d00; padding: 1em 2em; margin-top: 2em;">
        	<h3>Reset All Settings to Default</h3>
        	<p>
        		<a id="slickmap_css_sitemap_resetAll" class="button" href="#!" style="background: #f55; color:#fff; font-weight: bold;">Reset</a>
        	</p>
        	<p>
        		<strong>WARNING: This cannot be undone!</strong><br/>This resets all of your custom settings to the default values.
        	</p>
        </div>
    </div><!-- /.wrap -->
<?php

}	//end slickmap_css_sitemap_menu_content( $active_tab = '' )



//generate settings menu in admin
add_action( 'admin_init', 'slickmap_css_sitemap_settings_api_init' );

function slickmap_css_sitemap_settings_api_init() {
	
	//add the general & advanced settings sections
	add_settings_section( 'slickmap_css_sitemap_general', 'Global Sitemap Style', 'slickmap_css_sitemap_general_callback', 'slickmap_css_sitemap_menu_general');
	add_settings_section( 'slickmap_css_sitemap_advanced', 'Advanced Settings', 'slickmap_css_sitemap_advanced_callback', 'slickmap_css_sitemap_menu_advanced');
	
	//register general settings for savin'
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_gradient' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_font_family' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_radius' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_padding' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_breakpoint' );
	register_setting( 'slickmap_css_sitemap_menu_advanced', 'slickmap_css_sitemap_advanced_additional_css' );

	//add the fields for each general setting
	add_settings_field( 'slickmap_css_sitemap_general_gradient', 'Use White Gradient', 'slickmap_css_sitemap_general_gradient_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_font_family', 'Font Family', 'slickmap_css_sitemap_general_font_family_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_radius', 'Border Radius', 'slickmap_css_sitemap_general_radius_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_padding', 'Padding', 'slickmap_css_sitemap_general_padding_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_breakpoint', 'Mobile Breakpoint', 'slickmap_css_sitemap_general_breakpoint_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_advanced_additional_css', 'Additional CSS', 'slickmap_css_sitemap_advanced_additional_css_callback', 'slickmap_css_sitemap_menu_advanced', 'slickmap_css_sitemap_advanced' );
	
	
	
	//create sections, settings, and fields for each level
	global $slickmap_css_sitemap_level_names;
	foreach( $slickmap_css_sitemap_level_names as $level => $title ) {
	
		New slickmap_level( $level );
	
	}	//end foreach( $slickmap_css_sitemap_level_names as $level )

}	//end slickmap_css_sitemap_settings_api_init()




//general section callback
function slickmap_css_sitemap_general_callback() {

	echo '<p>Settings here will affect all of the boxes in your sitemap.</p>';

}	//end slickmap_css_sitemap_general_callback()



function slickmap_css_sitemap_advanced_callback() {

	echo '<p>Here you may add additional CSS rules to further customize your sitemap\'s style.</p>';

}	//end slickmap_css_sitemap_advanced_callback()




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



function slickmap_css_sitemap_advanced_additional_css_callback() {

	if( get_option( 'slickmap_css_sitemap_advanced_additional_css' ) ) {
	
		echo '<input name="slickmap_css_sitemap_advanced_additional_css" id="slickmap_css_sitemap_advanced_additional_css" type="hidden" value="' . get_option( 'slickmap_css_sitemap_advanced_additional_css' ) . '" />';
	
	}
	else {
	
		echo '<input name="slickmap_css_sitemap_advanced_additional_css" id="slickmap_css_sitemap_advanced_additional_css" type="hidden" value="/*** enter any additional css rules here ***/" />';
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_font_family' ) )

}	//end slickmap_css_sitemap_advanced_additional_css_callback()



//function to reset all options to default
function slickmap_css_sitemap_reset_all() {

	global $slickmap_css_sitemap_default_settings;
	//update options not in global defaults
	update_option( 'slickmap_css_sitemap_general_gradient', 'show' );
	update_option( 'slickmap_css_sitemap_general_breakpoint', '768' );
	//use global defaults to reset the rest of the options
	//check each setting and set rules if necessary
	foreach( $slickmap_css_sitemap_default_settings as $level => $selectors ) {
	
		foreach( $selectors as $selector => $properties ) {
		
			foreach( $properties as $property => $values ) {
			
				$default = $values['default'];
				$option = 'slickmap_css_sitemap_' . $level . '_' . $values['setting'];
				update_option( $option, $default );
			
			}	//end foreach( $properties as $property => $values )
		
		}	//end foreach( $selectors as $selector => $properties )
	
	}	//end foreach( $slickmap_css_sitemap_default_settings as $level => $details )
	slickmap_css_sitemap_save_style_transient();

}	//end slickmap_css_sitemap_reset_all()



//filter css before save
add_action( 'init', 'slickmap_css_sitemap_add_css_filter' );
function update_option_slickmap_css_sitemap_advanced_additional_css( $new_value, $old_value ) {
	
	
	$new_value = slickmap_css_sitemap_clean_css( $new_value );
	return $new_value;
	
}	//end update_option_slickmap_css_sitemap_advanced_additional_css( $new_value, $old_value )



function slickmap_css_sitemap_add_css_filter() {

	add_filter( 'pre_update_option_slickmap_css_sitemap_advanced_additional_css', 'update_option_slickmap_css_sitemap_advanced_additional_css', 10, 2 );

}	//end slickmap_css_sitemap_add_css_filter()



//function to sanitize css
function slickmap_css_sitemap_clean_css( $css ) {

	require_once( SlickMap_PLUGIN_DIR .'/lib/CSSTidy/class.csstidy.php' );
	$csstidy = new csstidy();
	$csstidy->set_cfg( 'discard_invalid_properties', TRUE );
	$csstidy->set_cfg( 'preserve_css', TRUE ); 
	$css = wp_kses_split( $css, array(), array() );
	$csstidy->parse( $css );
	$cssclean = $csstidy->print->formatted();
	$css = print_r( $csstidy->print->output_css_plain, true );
	$css = str_replace( array( "\n", "\r", "\t" ), '', $css );
	return $css;

}	//slickmap_css_sitemap_clean_css( $css )



//include colorpicker and script to attach to color inputs
add_action( 'admin_enqueue_scripts', 'slickmap_css_sitemap_include_colorpicker_script' );
function slickmap_css_sitemap_include_colorpicker_script() {

	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'slickmap_css_sitemap_admin_js', SlickMap_PLUGIN_URL . '/js/slickmap_css_sitemap_adminfields.js', array( 'jquery', 'wp-color-picker' ), SlickMap_VERSION, true );
	wp_enqueue_style( 'wp-color-picker' );

}	//end function slickmap_css_sitemap_include_colorpicker_script()