<?php
/**
 * Plugin Name: SlickMap CSS Sitemap
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin to create a custom HTML/CSS sitemap. Set your colors and fonts, then wrap any set of ULs in a shortcode to make an interactive sitemap. Uses Matt Everson's SlickMap CSS (astuteo.com); give him money if you dig this. 
 * Version: 1.0
 * Author: Chad A. Carino
 * Author URI: http://www.chadacarino.com
 * License: MIT
 */
/*
The MIT License (MIT)
Copyright (c) 2014 Chad A. Carino
 
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

//create settings menu item for sitemap styles
function slickmap_css_sitemap_menu() {
	add_menu_page( 'SlickMap CSS Sitemap Options', 'SlickMap Options', 'manage_options', 'slickmap_css_sitemap_menu', 'slickmap_css_sitemap_menu_content', 'dashicons-networking', '88.898');
	add_submenu_page( 'slickmap_css_sitemap_menu', 'SlickMap CSS General Settings', 'General', 'manage-options', 'slickmap_css_sitemap_menu_general', create_function( null, 'slickmap_css_sitemap_menu_content( "general" );' ) ); 
	add_submenu_page( 'slickmap_css_sitemap_menu', 'SlickMap CSS Colors', 'Colors', 'manage-options', 'slickmap_css_sitemap_menu_colors', create_function( null, 'slickmap_css_sitemap_menu_content( "colors" );' ) ); 
	add_submenu_page( 'slickmap_css_sitemap_menu', 'SlickMap CSS Text Options', 'Text', 'manage-options', 'slickmap_css_sitemap_menu_text', create_function( null, 'slickmap_css_sitemap_menu_content( "colors" );' ) );

}

add_action('admin_menu', 'slickmap_css_sitemap_menu');

function slickmap_css_sitemap_menu_content($active_tab = '') {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
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
            // settings_fields( 'slickmap_css_sitemap_colors_home' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_colors_home' ); 
//             <?php settings_fields( 'slickmap_css_sitemap_colors_level1' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_colors_level1' );
//             <?php settings_fields( 'slickmap_css_sitemap_colors_level2' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_colors_level2' ); 
//             <?php settings_fields( 'slickmap_css_sitemap_colors_level3' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_colors_level3' );
//              
//             <?php settings_fields( 'slickmap_css_sitemap_text_home' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_text_home' ); 
//             <?php settings_fields( 'slickmap_css_sitemap_text_level1' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_text_level1' ); 
//             <?php settings_fields( 'slickmap_css_sitemap_text_level2' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_text_level2' ); 
//             <?php settings_fields( 'slickmap_css_sitemap_text_level3' ); 
//             <?php do_settings_sections( 'slickmap_css_sitemap_text_level3' ); 
           
        	submit_button(); ?>
             
        </form>
    </div><!-- /.wrap -->
<?php
}

//generate settings menu in admin
add_action( 'admin_init', 'slickmap_css_sitemap_settings_api_init' );

function slickmap_css_sitemap_settings_api_init() {
	
	//add the settings sections
	add_settings_section( 'slickmap_css_sitemap_general', 'Global Sitemap Style', 'slickmap_css_sitemap_general_callback', 'slickmap_css_sitemap_menu_general');
	add_settings_section( 'slickmap_css_sitemap_colors_home', 'Level - Home', 'slickmap_css_sitemap_colors_home_callback', 'slickmap_css_sitemap_menu_colors');
	add_settings_section( 'slickmap_css_sitemap_colors_level1', 'Level - 1', 'slickmap_css_sitemap_colors_level1_callback', 'slickmap_css_sitemap_menu_colors');
	add_settings_section( 'slickmap_css_sitemap_colors_level2', 'Level - 2', 'slickmap_css_sitemap_colors_level2_callback', 'slickmap_css_sitemap_menu_colors');
	add_settings_section( 'slickmap_css_sitemap_colors_level3', 'Level - 3', 'slickmap_css_sitemap_colors_level3_callback', 'slickmap_css_sitemap_menu_colors');
	add_settings_section( 'slickmap_css_sitemap_text_home', 'Level - Home', 'slickmap_css_sitemap_text_home_callback', 'slickmap_css_sitemap_menu_text');
	add_settings_section( 'slickmap_css_sitemap_text_level1', 'Level - 1', 'slickmap_css_sitemap_text_level1_callback', 'slickmap_css_sitemap_menu_text');
	add_settings_section( 'slickmap_css_sitemap_text_level2', 'Level - 2', 'slickmap_css_sitemap_text_level2_callback', 'slickmap_css_sitemap_menu_text');
	add_settings_section( 'slickmap_css_sitemap_text_level3', 'Level - 3', 'slickmap_css_sitemap_text_level3_callback', 'slickmap_css_sitemap_menu_text');
	
	//register the fields for each setting
		//general
	add_settings_field( 'slickmap_css_sitemap_general_gradient', 'Use White Gradient', 'slickmap_css_sitemap_general_gradient_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_font_family', 'Font Family', 'slickmap_css_sitemap_general_font_family_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_radius', 'Border Radius', 'slickmap_css_sitemap_general_radius_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
	add_settings_field( 'slickmap_css_sitemap_general_padding', 'Padding', 'slickmap_css_sitemap_general_padding_callback', 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general' );
		//home-colors
	add_settings_field( 'slickmap_css_sitemap_home_bgcolor', 'Background Color', 'slickmap_css_sitemap_home_bgcolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_home' );
	add_settings_field( 'slickmap_css_sitemap_home_bgcolor_hover', 'Background Color - Hover', 'slickmap_css_sitemap_home_bgcolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_home' );
	add_settings_field( 'slickmap_css_sitemap_home_bordercolor', 'Border Color', 'slickmap_css_sitemap_home_bordercolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_home' );
	add_settings_field( 'slickmap_css_sitemap_home_bordercolor_hover', 'Border Color - Hover', 'slickmap_css_sitemap_home_bordercolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_home' );
		//L1-colors
	add_settings_field( 'slickmap_css_sitemap_level1_bgcolor', 'Background Color', 'slickmap_css_sitemap_level1_bgcolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level1' );
	add_settings_field( 'slickmap_css_sitemap_level1_bgcolor_hover', 'Background Color - Hover', 'slickmap_css_sitemap_level1_bgcolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level1' );
	add_settings_field( 'slickmap_css_sitemap_level1_bordercolor', 'Border Color', 'slickmap_css_sitemap_level1_bordercolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level1' );
	add_settings_field( 'slickmap_css_sitemap_level1_bordercolor_hover', 'Border Color - Hover', 'slickmap_css_sitemap_level1_bordercolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level1' );
		//L2-colors
	add_settings_field( 'slickmap_css_sitemap_level2_bgcolor', 'Background Color', 'slickmap_css_sitemap_level2_bgcolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level2' );
	add_settings_field( 'slickmap_css_sitemap_level2_bgcolor_hover', 'Background Color - Hover', 'slickmap_css_sitemap_level2_bgcolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level2' );
	add_settings_field( 'slickmap_css_sitemap_level2_bordercolor', 'Border Color', 'slickmap_css_sitemap_level2_bordercolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level2' );
	add_settings_field( 'slickmap_css_sitemap_level2_bordercolor_hover', 'Border Color - Hover', 'slickmap_css_sitemap_level2_bordercolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level2' );
		//L3-colors
	add_settings_field( 'slickmap_css_sitemap_level3_bgcolor', 'Background Color', 'slickmap_css_sitemap_level3_bgcolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level3' );
	add_settings_field( 'slickmap_css_sitemap_level3_bgcolor_hover', 'Background Color - Hover', 'slickmap_css_sitemap_level3_bgcolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level3' );
	add_settings_field( 'slickmap_css_sitemap_level3_bordercolor', 'Border Color', 'slickmap_css_sitemap_level3_bordercolor_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level3' );
	add_settings_field( 'slickmap_css_sitemap_level3_bordercolor_hover', 'Border Color - Hover', 'slickmap_css_sitemap_level3_bordercolor_hover_callback', 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_colors_level3' );
		//home-text
	add_settings_field( 'slickmap_css_sitemap_home_title_text_color', 'Title Color', 'slickmap_css_sitemap_home_title_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_home' );
	add_settings_field( 'slickmap_css_sitemap_home_title_text_size', 'Title Size', 'slickmap_css_sitemap_home_title_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_home' );
	add_settings_field( 'slickmap_css_sitemap_home_path_text_color', 'Path Color', 'slickmap_css_sitemap_home_path_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_home' );
	add_settings_field( 'slickmap_css_sitemap_home_path_text_size', 'Path Size', 'slickmap_css_sitemap_home_path_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_home' );
		//L1-text
	add_settings_field( 'slickmap_css_sitemap_level1_title_text_color', 'Title Color', 'slickmap_css_sitemap_level1_title_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level1' );
	add_settings_field( 'slickmap_css_sitemap_level1_title_text_size', 'Title Size', 'slickmap_css_sitemap_level1_title_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level1' );
	add_settings_field( 'slickmap_css_sitemap_level1_path_text_color', 'Path Color', 'slickmap_css_sitemap_level1_path_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level1' );
	add_settings_field( 'slickmap_css_sitemap_level1_path_text_size', 'Path Size', 'slickmap_css_sitemap_level1_path_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level1' );
		//L2-text
	add_settings_field( 'slickmap_css_sitemap_level2_title_text_color', 'Title Color', 'slickmap_css_sitemap_level2_title_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level2' );
	add_settings_field( 'slickmap_css_sitemap_level2_title_text_size', 'Title Size', 'slickmap_css_sitemap_level2_title_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level2' );
	add_settings_field( 'slickmap_css_sitemap_level2_path_text_color', 'Path Color', 'slickmap_css_sitemap_level2_path_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level2' );
	add_settings_field( 'slickmap_css_sitemap_level2_path_text_size', 'Path Size', 'slickmap_css_sitemap_level2_path_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level2' );
		//L3-text
	add_settings_field( 'slickmap_css_sitemap_level3_title_text_color', 'Title Color', 'slickmap_css_sitemap_level3_title_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level3' );
	add_settings_field( 'slickmap_css_sitemap_level3_title_text_size', 'Title Size', 'slickmap_css_sitemap_level3_title_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level3' );
	add_settings_field( 'slickmap_css_sitemap_level3_path_text_color', 'Path Color', 'slickmap_css_sitemap_level3_path_text_color_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level3' );
	add_settings_field( 'slickmap_css_sitemap_level3_path_text_size', 'Path Size', 'slickmap_css_sitemap_level3_path_text_size_callback', 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_text_level3' );

	//register settings for savin'
		//general
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_gradient' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_font_family' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_radius' );
	register_setting( 'slickmap_css_sitemap_menu_general', 'slickmap_css_sitemap_general_padding' );
		//home-colors
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_home_bgcolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_home_bgcolor_hover' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_home_bordercolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_home_bordercolor_hover' );
		//L1-colors
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level1_bgcolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level1_bgcolor_hover' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level1_bordercolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level1_bordercolor_hover' );
		//L2-colors
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level2_bgcolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level2_bgcolor_hover' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level2_bordercolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level2_bordercolor_hover' );
		//L3-colors
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level3_bgcolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level3_bgcolor_hover' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level3_bordercolor' );
	register_setting( 'slickmap_css_sitemap_menu_colors', 'slickmap_css_sitemap_level3_bordercolor_hover' );
		//home-text
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_home_title_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_home_title_text_size' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_home_path_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_home_path_text_size' );
		//L1-text
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level1_title_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level1_title_text_size' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level1_path_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level1_path_text_size' );
		//L2-text
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level2_title_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level2_title_text_size' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level2_path_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level2_path_text_size' );
		//L3-text
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level3_title_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level3_title_text_size' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level3_path_text_color' );
	register_setting( 'slickmap_css_sitemap_menu_text', 'slickmap_css_sitemap_level3_path_text_size' );

}

//section callbacks
function slickmap_css_sitemap_general_callback(){
	echo '<p>Settings here will affect all of the boxes in your sitemap.</p>';
}
function slickmap_css_sitemap_colors_home_callback(){
	echo '<p>Settings here will affect the background of the home level box in your sitemap.</p>';
}
function slickmap_css_sitemap_colors_level1_callback(){
	echo '<p>Settings here will affect the background of the first level boxes in your sitemap.</p>';
}
function slickmap_css_sitemap_colors_level2_callback(){
	echo '<p>Settings here will affect the background of the second level boxes in your sitemap.</p>';
}
function slickmap_css_sitemap_colors_level3_callback(){
	echo '<p>Settings here will affect the background of the third level boxes in your sitemap.</p>';
}
function slickmap_css_sitemap_text_home_callback(){
	echo '<p>Settings here will affect the text of the home level box in your sitemap.</p>';
}
function slickmap_css_sitemap_text_level1_callback(){
	echo '<p>Settings here will affect the text of the first level boxes in your sitemap.</p>';
}
function slickmap_css_sitemap_text_level2_callback(){
	echo '<p>Settings here will affect the text of the second level boxes in your sitemap.</p>';
}
function slickmap_css_sitemap_text_level3_callback(){
	echo '<p>Settings here will affect the text of the third level boxes in your sitemap.</p>';
}

//option field callbacks
function slickmap_css_sitemap_general_gradient_callback() {
	$gradient = get_option( 'slickmap_css_sitemap_general_gradient' );
	echo '<p>';
	if( $gradient ) {
		echo '<input type="radio" name="slickmap_css_gradient" value="show"' . checked( $gradient, 'show' ) . '>Frosty<br/>
		<input type="radio" name="slickmap_css_gradient" value="hide"' . checked( $gradient, 'hide' ) . '>Flat';
	}
	else {
		echo '<input type="radio" name="slickmap_css_gradient" value="show" checked="checked">Frosty<br/>
		<input type="radio" name="slickmap_css_gradient" value="hide">Flat';
	}
	echo '</p>';
}

function slickmap_css_sitemap_general_font_family_callback() {
	if ( get_option( 'slickmap_css_sitemap_general_font_family' ) ) {
		echo "<p><input size='90' name='slickmap_css_sitemap_general_font_family' id='slickmap_css_sitemap_general_font_family' type='text' value='" . get_option( 'slickmap_css_sitemap_general_font_family' ) . "' /></p>";
	} else {
		echo "<p><input size='90' name='slickmap_css_sitemap_general_font_family' id='slickmap_css_sitemap_general_font_family' type='text' value='Gotham, Helvetica, Arial, sans-serif' /></p>";
	}
}

function slickmap_css_sitemap_general_radius_callback() {
	if ( get_option( 'slickmap_css_sitemap_general_radius' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_general_radius' id='slickmap_css_sitemap_general_radius' type='text' value='" . get_option( 'slickmap_css_sitemap_general_radius' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_general_radius' id='slickmap_css_sitemap_general_radius' type='text' value='5px' /></p>";
	}
}

function slickmap_css_sitemap_general_padding_callback() {
	$padding = array (
		'top'		=>	'10px',
		'right' 	=>	'0px',
		'bottom'	=>	'10px',
		'left'	 	=>	'0px',
	);
	if ( get_option( 'slickmap_css_sitemap_general_padding' ) ) {
		$padding = get_option( 'slickmap_css_sitemap_general_padding' );
	}
	echo "<p>Top: <input size='10' name='slickmap_css_sitemap_general_padding_top' id='slickmap_css_sitemap_general_padding_top' type='text' value='" . $padding['top'] . "' /></p>";
	echo "<p>Bottom: <input size='10' name='slickmap_css_sitemap_general_padding_bottom' id='slickmap_css_sitemap_general_padding_bottom' type='text' value='" . $padding['bottom'] . "' /></p>";
	echo "<p>Right: <input size='10' name='slickmap_css_sitemap_general_padding_right' id='slickmap_css_sitemap_general_padding_right' type='text' value='" . $padding['right'] . "' /></p>";
	echo "<p>Left: <input size='10' name='slickmap_css_sitemap_general_padding_left' id='slickmap_css_sitemap_general_padding_left' type='text' value='" . $padding['left'] . "' /></p>";
}

function slickmap_css_sitemap_home_bgcolor_callback() {
	$slickmap_css_sitemap_home_bgcolor = '#c3eafb';
	if ( get_option( 'slickmap_css_sitemap_home_bgcolor' ) ) {
		$slickmap_css_sitemap_home_bgcolor = get_option( 'slickmap_css_sitemap_home_bgcolor' );
	}
	echo '<input name="slickmap_css_sitemap_home_bgcolor" id="slickmap_css_sitemap_home_bgcolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_home_bgcolor . '" />';
}

function slickmap_css_sitemap_home_bgcolor_hover_callback() {
	$slickmap_css_sitemap_home_bgcolor_hover = '#e2f4fd';
	if ( get_option( 'slickmap_css_sitemap_home_bgcolor_hover' ) ) {
		$slickmap_css_sitemap_home_bgcolor_hover = get_option( 'slickmap_css_sitemap_home_bgcolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_home_bgcolor_hover" id="slickmap_css_sitemap_home_bgcolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_home_bgcolor_hover . '" />';
}

function slickmap_css_sitemap_home_bordercolor_callback() {
	$slickmap_css_sitemap_home_bordercolor = '#b5d9ea';
	if ( get_option( 'slickmap_css_sitemap_home_bordercolor' ) ) {
		$slickmap_css_sitemap_home_bordercolor = get_option( 'slickmap_css_sitemap_home_bordercolor' );
	}
	echo '<input name="slickmap_css_sitemap_home_bordercolor" id="slickmap_css_sitemap_home_bordercolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_home_bordercolor . '" />';
}

function slickmap_css_sitemap_home_bordercolor_hover_callback() {
	$slickmap_css_sitemap_home_bordercolor_hover = '#97bdcf';
	if ( get_option( 'slickmap_css_sitemap_home_bordercolor_hover' ) ) {
		$slickmap_css_sitemap_home_bordercolor_hover = get_option( 'slickmap_css_sitemap_home_bordercolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_home_bordercolor_hover" id="slickmap_css_sitemap_home_bordercolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_home_bordercolor_hover . '" />';
}

function slickmap_css_sitemap_level1_bgcolor_callback() {
	$slickmap_css_sitemap_level1_bgcolor = '#c3eafb';
	if ( get_option( 'slickmap_css_sitemap_level1_bgcolor' ) ) {
		$slickmap_css_sitemap_level1_bgcolor = get_option( 'slickmap_css_sitemap_level1_bgcolor' );
	}
	echo '<input name="slickmap_css_sitemap_level1_bgcolor" id="slickmap_css_sitemap_level1_bgcolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level1_bgcolor . '" />';
}

function slickmap_css_sitemap_level1_bgcolor_hover_callback() {
	$slickmap_css_sitemap_level1_bgcolor_hover = '#e2f4fd';
	if ( get_option( 'slickmap_css_sitemap_level1_bgcolor_hover' ) ) {
		$slickmap_css_sitemap_level1_bgcolor_hover = get_option( 'slickmap_css_sitemap_level1_bgcolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_level1_bgcolor_hover" id="slickmap_css_sitemap_level1_bgcolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level1_bgcolor_hover . '" />';
}

function slickmap_css_sitemap_level1_bordercolor_callback() {
	$slickmap_css_sitemap_level1_bordercolor = '#b5d9ea';
	if ( get_option( 'slickmap_css_sitemap_level1_bordercolor' ) ) {
		$slickmap_css_sitemap_level1_bordercolor = get_option( 'slickmap_css_sitemap_level1_bordercolor' );
	}
	echo '<input name="slickmap_css_sitemap_level1_bordercolor" id="slickmap_css_sitemap_level1_bordercolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level1_bordercolor . '" />';
}

function slickmap_css_sitemap_level1_bordercolor_hover_callback() {
	$slickmap_css_sitemap_level1_bordercolor_hover = '#97bdcf';
	if ( get_option( 'slickmap_css_sitemap_level1_bordercolor_hover' ) ) {
		$slickmap_css_sitemap_level1_bordercolor_hover = get_option( 'slickmap_css_sitemap_level1_bordercolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_level1_bordercolor_hover" id="slickmap_css_sitemap_level1_bordercolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level1_bordercolor_hover . '" />';
}

function slickmap_css_sitemap_level2_bgcolor_callback() {
	$slickmap_css_sitemap_level2_bgcolor = '#cee3ac';
	if ( get_option( 'slickmap_css_sitemap_level2_bgcolor' ) ) {
		$slickmap_css_sitemap_level2_bgcolor = get_option( 'slickmap_css_sitemap_level2_bgcolor' );
	}
	echo '<input name="slickmap_css_sitemap_level2_bgcolor" id="slickmap_css_sitemap_level2_bgcolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level2_bgcolor . '" />';
}

function slickmap_css_sitemap_level2_bgcolor_hover_callback() {
	$slickmap_css_sitemap_level2_bgcolor_hover = '#e7f1d7';
	if ( get_option( 'slickmap_css_sitemap_level2_bgcolor_hover' ) ) {
		$slickmap_css_sitemap_level2_bgcolor_hover = get_option( 'slickmap_css_sitemap_level2_bgcolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_level2_bgcolor_hover" id="slickmap_css_sitemap_level2_bgcolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level2_bgcolor_hover . '" />';
}

function slickmap_css_sitemap_level2_bordercolor_callback() {
	$slickmap_css_sitemap_level2_bordercolor = '#b8da83';
	if ( get_option( 'slickmap_css_sitemap_level2_bordercolor' ) ) {
		$slickmap_css_sitemap_level2_bordercolor = get_option( 'slickmap_css_sitemap_level2_bordercolor' );
	}
	echo '<input name="slickmap_css_sitemap_level2_bordercolor" id="slickmap_css_sitemap_level2_bordercolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level2_bordercolor . '" />';
}

function slickmap_css_sitemap_level2_bordercolor_hover_callback() {
	$slickmap_css_sitemap_level2_bordercolor_hover = '#94b75f';
	if ( get_option( 'slickmap_css_sitemap_level2_bordercolor_hover' ) ) {
		$slickmap_css_sitemap_level2_bordercolor_hover = get_option( 'slickmap_css_sitemap_level2_bordercolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_level2_bordercolor_hover" id="slickmap_css_sitemap_level2_bordercolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level2_bordercolor_hover . '" />';
}

function slickmap_css_sitemap_level3_bgcolor_callback() {
	$slickmap_css_sitemap_level3_bgcolor = '#fff7aa';
	if ( get_option( 'slickmap_css_sitemap_level3_bgcolor' ) ) {
		$slickmap_css_sitemap_level3_bgcolor = get_option( 'slickmap_css_sitemap_level3_bgcolor' );
	}
	echo '<input name="slickmap_css_sitemap_level3_bgcolor" id="slickmap_css_sitemap_level3_bgcolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level3_bgcolor . '" />';
}

function slickmap_css_sitemap_level3_bgcolor_hover_callback() {
	$slickmap_css_sitemap_level3_bgcolor_hover = '#fffce5';
	if ( get_option( 'slickmap_css_sitemap_level3_bgcolor_hover' ) ) {
		$slickmap_css_sitemap_level3_bgcolor_hover = get_option( 'slickmap_css_sitemap_level3_bgcolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_level3_bgcolor_hover" id="slickmap_css_sitemap_level3_bgcolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level3_bgcolor_hover . '" />';
}

function slickmap_css_sitemap_level3_bordercolor_callback() {
	$slickmap_css_sitemap_level3_bordercolor = '#e3ca4b';
	if ( get_option( 'slickmap_css_sitemap_level3_bordercolor' ) ) {
		$slickmap_css_sitemap_level3_bordercolor = get_option( 'slickmap_css_sitemap_level3_bordercolor' );
	}
	echo '<input name="slickmap_css_sitemap_level3_bordercolor" id="slickmap_css_sitemap_level3_bordercolor" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level3_bordercolor . '" />';
}

function slickmap_css_sitemap_level3_bordercolor_hover_callback() {
	$slickmap_css_sitemap_level3_bordercolor_hover = '#d1b62c';
	if ( get_option( 'slickmap_css_sitemap_level3_bordercolor_hover' ) ) {
		$slickmap_css_sitemap_level3_bordercolor_hover = get_option( 'slickmap_css_sitemap_level3_bordercolor_hover' );
	}
	echo '<input name="slickmap_css_sitemap_level3_bordercolor_hover" id="slickmap_css_sitemap_level3_bordercolor_hover" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level3_bordercolor_hover . '" />';
}

function slickmap_css_sitemap_home_title_text_color_callback() {
	$slickmap_css_sitemap_home_title_text_color = '#000000';
	if ( get_option( 'slickmap_css_sitemap_home_title_text_color' ) ) {
		$slickmap_css_sitemap_home_title_text_color = get_option( 'slickmap_css_sitemap_home_title_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_home_title_text_color" id="slickmap_css_sitemap_home_title_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_home_title_text_color . '" />';
}

function slickmap_css_sitemap_home_path_text_color_callback() {
	$slickmap_css_sitemap_home_path_text_color = '#78a9c0';
	if ( get_option( 'slickmap_css_sitemap_home_path_text_color' ) ) {
		$slickmap_css_sitemap_home_path_text_color = get_option( 'slickmap_css_sitemap_home_path_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_home_path_text_color" id="slickmap_css_sitemap_home_path_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_home_path_text_color . '" />';
}

function slickmap_css_sitemap_home_title_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_home_title_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_home_title_text_size' id='slickmap_css_sitemap_home_title_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_home_title_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_home_title_text_size' id='slickmap_css_sitemap_home_title_text_size' type='text' value='14px' /></p>";
	}
}

function slickmap_css_sitemap_home_path_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_home_path_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_home_path_text_size' id='slickmap_css_sitemap_home_path_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_home_path_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_home_path_text_size' id='slickmap_css_sitemap_home_path_text_size' type='text' value='10px' /></p>";
	}
}

function slickmap_css_sitemap_level1_title_text_color_callback() {
	$slickmap_css_sitemap_level1_title_text_color = '#000000';
	if ( get_option( 'slickmap_css_sitemap_level1_title_text_color' ) ) {
		$slickmap_css_sitemap_level1_title_text_color = get_option( 'slickmap_css_sitemap_level1_title_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_level1_title_text_color" id="slickmap_css_sitemap_level1_title_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level1_title_text_color . '" />';
}

function slickmap_css_sitemap_level1_path_text_color_callback() {
	$slickmap_css_sitemap_level1_path_text_color = '#78a9c0';
	if ( get_option( 'slickmap_css_sitemap_level1_path_text_color' ) ) {
		$slickmap_css_sitemap_level1_path_text_color = get_option( 'slickmap_css_sitemap_level1_path_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_level1_path_text_color" id="slickmap_css_sitemap_level1_path_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level1_path_text_color . '" />';
}

function slickmap_css_sitemap_level1_title_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_level1_title_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_level1_title_text_size' id='slickmap_css_sitemap_level1_title_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_level1_title_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_level1_title_text_size' id='slickmap_css_sitemap_level1_title_text_size' type='text' value='14px' /></p>";
	}
}

function slickmap_css_sitemap_level1_path_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_level1_path_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_level1_path_text_size' id='slickmap_css_sitemap_level1_path_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_level1_path_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_level1_path_text_size' id='slickmap_css_sitemap_level1_path_text_size' type='text' value='10px' /></p>";
	}
}

function slickmap_css_sitemap_level2_title_text_color_callback() {
	$slickmap_css_sitemap_level2_title_text_color = '#000000';
	if ( get_option( 'slickmap_css_sitemap_level2_title_text_color' ) ) {
		$slickmap_css_sitemap_level2_title_text_color = get_option( 'slickmap_css_sitemap_level2_title_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_level2_title_text_color" id="slickmap_css_sitemap_level2_title_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level2_title_text_color . '" />';
}

function slickmap_css_sitemap_level2_path_text_color_callback() {
	$slickmap_css_sitemap_level2_path_text_color = '#8faf5c';
	if ( get_option( 'slickmap_css_sitemap_level2_path_text_color' ) ) {
		$slickmap_css_sitemap_level2_path_text_color = get_option( 'slickmap_css_sitemap_level2_path_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_level2_path_text_color" id="slickmap_css_sitemap_level2_path_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level2_path_text_color . '" />';
}

function slickmap_css_sitemap_level2_title_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_level2_title_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_level2_title_text_size' id='slickmap_css_sitemap_level2_title_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_level2_title_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_level2_title_text_size' id='slickmap_css_sitemap_level2_title_text_size' type='text' value='14px' /></p>";
	}
}

function slickmap_css_sitemap_level2_path_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_level2_path_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_level2_path_text_size' id='slickmap_css_sitemap_level2_path_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_level2_path_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_level2_path_text_size' id='slickmap_css_sitemap_level2_path_text_size' type='text' value='10px' /></p>";
	}
}

function slickmap_css_sitemap_level3_title_text_color_callback() {
	$slickmap_css_sitemap_level3_title_text_color = '#000000';
	if ( get_option( 'slickmap_css_sitemap_level3_title_text_color' ) ) {
		$slickmap_css_sitemap_level3_title_text_color = get_option( 'slickmap_css_sitemap_level3_title_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_level3_title_text_color" id="slickmap_css_sitemap_level3_title_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level3_title_text_color . '" />';
}

function slickmap_css_sitemap_level3_path_text_color_callback() {
	$slickmap_css_sitemap_level3_path_text_color = '#ccae14';
	if ( get_option( 'slickmap_css_sitemap_level3_path_text_color' ) ) {
		$slickmap_css_sitemap_level3_path_text_color = get_option( 'slickmap_css_sitemap_level3_path_text_color' );
	}
	echo '<input name="slickmap_css_sitemap_level3_path_text_color" id="slickmap_css_sitemap_level3_path_text_color" class="iris-color-picker-field" type="text" value="' . $slickmap_css_sitemap_level3_path_text_color . '" />';
}

function slickmap_css_sitemap_level3_title_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_level3_title_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_level3_title_text_size' id='slickmap_css_sitemap_level3_title_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_level3_title_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_level3_title_text_size' id='slickmap_css_sitemap_level3_title_text_size' type='text' value='12px' /></p>";
	}
}

function slickmap_css_sitemap_level3_path_text_size_callback() {
	if ( get_option( 'slickmap_css_sitemap_level3_path_text_size' ) ) {
		echo "<p><input size='10' name='slickmap_css_sitemap_level3_path_text_size' id='slickmap_css_sitemap_level3_path_text_size' type='text' value='" . get_option( 'slickmap_css_sitemap_level3_path_text_size' ) . "' /></p>";
	} else {
		echo "<p><input size='10' name='slickmap_css_sitemap_level3_path_text_size' id='slickmap_css_sitemap_level3_path_text_size' type='text' value='9px' /></p>";
	}
}

// add shortcode slickmap
//e.g. [slickmap]<ul><li>level one</li></ul>[/slickmap]
function slickmap_css_sitemap_shortcode( $atts, $content = null ) {

	// attributes allow for manual override of color settings... just in case?
	extract( shortcode_atts(
		array(
			'color1' => '',
			'color2' => '',
			'color3' => '',
		), $atts )
	);
	//fetch options, store non-defaults as css strings in arrays
		//level 1 - #primaryNav li a 
			//background: $color; (if background-color≠#c3eafb)
			//border: 2px solid $color; (if border-color≠#b5d9ea)
			//title text color: $color; (if color≠black)
			//title font-size: $size; (if font-size≠14px)
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			//background hover color - #primaryNav li a:hover { background-color: $color; } (if background-color≠#e2f4fd)
			//border hover color - #primaryNav li a:hover { border-color: $color; } (if border-color≠#97bdcf)
			//path text color #primaryNav li a:link:before, #primaryNav li a:visited:before { color: $color; } (if color≠#78a9c0)
			//path font-size #primaryNav li a:link:before, #primaryNav li a:visited:before { font-size: $size; } (if font-size≠10px)
			//show/hide gradient (if hide) background-image: none;
		//level 2 - #primaryNav li li a 
			//background: $color; (if background-color≠#cee3ac)
			//border: 2px solid $color; (if border-color≠#b8da83)
			//title text color: $color; (if color≠black)
			//title font-size: $size; (if font-size≠14px)
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			//background hover color - #primaryNav li li a:hover { background-color: $color; } (if background-color≠#e7f1d7)
			//border hover color - #primaryNav li li a:hover { border-color: $color; } (if border-color≠#94b75f)
			//path text color #primaryNav li li a:link:before, #primaryNav li li a:visited:before { color: $color; } (if color≠#8faf5c)
			//path font-size #primaryNav li li a:link:before, #primaryNav li li a:visited:before { font-size: $size; } (if font-size≠10px)
			//show/hide gradient (if hide) background-image: none;
		//level 3 - #primaryNav li li li a 
			//background: $color; (if background-color≠#fff7aa)
			//border: 2px solid $color; (if border-color≠#e3ca4b)
			//title text color: $color; (if color≠black)
			//title font-size: $size; (if font-size≠12px)
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			//background hover color - #primaryNav li li li a:hover { background-color: $color; } (if background-color≠#fffce5)
			//border hover color - #primaryNav li li li a:hover { border-color: $color; } (if border-color≠#d1b62c)
			//path text color #primaryNav li li li a:link:before, #primaryNav li li li a:visited:before { color: $color; } (if color≠#ccae14)
			//path font-size #primaryNav li li li a:link:before, #primaryNav li li li a:visited:before { font-size: $size; } (if font-size≠9px)
			//show/hide gradient (if hide) background-image: none;
		//home - #primaryNav #home a
			//background: $color; (if background-color≠#c3eafb)
			//border: 2px solid $color; (if border-color≠#b5d9ea)
			//title text color: $color; (if color≠black)
			//title font-size: $size; (if font-size≠14px)
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			//background hover color - #primaryNav #home a:hover { background-color: $color; } (if background-color≠#e2f4fd)
			//border hover color - #primaryNav #home a:hover { border-color: $color; } (if border-color≠#97bdcf)
			//path text color #primaryNav #home a:link:before, #primaryNav #home a:visited:before { color: $color; } (if color≠#78a9c0)
			//path font-size #primaryNav #home a:link:before, #primaryNav #home a:visited:before { font-size: $size; } (if font-size≠10px)
			//show/hide gradient (if hide) background-image: none;
	//check if atts included any colors, change any array strings that they would override
		//if so, override array string for
			//#primaryNav li a { background-color: $color1;}
			//#primaryNav li li a { background-color: $color2;}
			//#primaryNav li li li a { background-color: $color3;}
	//create style rules to override included stylesheet
	$style = '<style>';
	//$style .= foreach css selector in array (#primaryNav li a; #primaryNav li a:hover; #primaryNav li a:link:before, #primaryNav li a:visited:before; #primaryNav li li a; #primaryNav li li a:hover; #primaryNav li li a:link:before, #primaryNav li li a:visited:before; #primaryNav li li li a; #primaryNav li li li a:hover; #primaryNav li li li a:link:before, #primaryNav li li li a:visited:before; #primaryNav #home a; #primaryNav #home a:hover; #primaryNav #home a:link:before, #primaryNav #home a:visited:before)
		//return selector {
		//foreach style rule
			//return style rule pair from array
		//return }
	$style .= '</style>';
	//remove open ul tag from sitemap structure
// 	if (substr($content, 0, 5) == '<ul>') {
// 		$sitemap_structure = substr($content, 6);
// 	}
// 	else {
// 		$sitemap_structure = '<!-- <div>'.substr($content, 0, 5).'</div> -->' . $content . '</ul>';
// 	}
	$sitemap_structure = '<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery(".slickmap>ul").attr("id", "primaryNav");
		jQuery("#primaryNav>li:first-child").attr("id", "home");
	});
	</script>' . $content;
	//concatenate all content for output
	//style tag here
	$sitemap = $style;
	//open containers
	$sitemap .= '<div class="slickmap sitemap">';
	// modified ul content here
	$sitemap .= $sitemap_structure . '</div>';
	//final output of sitemap
    return $sitemap;
}
add_shortcode( 'slickmap', 'slickmap_css_sitemap_shortcode' );

//include slickmap css; sets defaults and display style
function include_slickmap_css_sitemap_style() {
	wp_enqueue_style ( 'slickmap_css', plugins_url().'/slickmap/slickmap.css' );
}

add_action( 'wp_enqueue_scripts', 'include_slickmap_css_sitemap_style' );

function include_colorpicker_script_for_slickmap_options() {
	wp_enqueue_script( 'wp-color-picker' );
	// load the custom script
	wp_enqueue_script( 'slickmap_css_sitemap_js', plugins_url( 'slickmap_css_sitemap.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '1.0', true );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'include_colorpicker_script_for_slickmap_options' );
