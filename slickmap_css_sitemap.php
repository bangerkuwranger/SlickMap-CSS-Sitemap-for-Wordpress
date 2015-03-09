<?php
/**
 * Plugin Name: SlickMap CSS Sitemap
 * Plugin URI: https://github.com/bangerkuwranger
 * Description: Wordpress plugin to create a custom HTML/CSS sitemap. Set your colors and fonts, then wrap any set of ULs in a shortcode to make an interactive sitemap. Uses Matt Everson's SlickMap CSS (astuteo.com); give him money if you dig this. 
 * Version: 1.3
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


//default settings array. NOT static; do NOT overwrite values! (php compatibility is still an issue)
$slickmap_css_sitemap_default_settings = array(

	'general'	=> array(
	
		'.slickmap #primaryNav li a'																					=> array(
		
			'border-radius'		=> array(
			
				'default'	=> '5px',
				'setting'	=> 'radius',
		
			),
			'padding'			=> array(
			
				'default'	=> '10px 0 10px 0',
				'setting'	=> 'padding',
		
			),
			'font-family'		=> array(
			
				'default'	=> 'Gotham, Helvetica, Arial, sans-serif',
				'setting'	=> 'font_family',
		
			),
		
		),
	
	),
	'home'		=> array(
	
		'.slickmap #primaryNav > #home > a'																				=> array(
		
			
			'background-color'	=> array(
			
				'default'	=> '',
				'setting'	=> 'bgcolor',
			
			),
			'border-color'		=> array(
			
				'default'	=> '',
				'setting'	=> 'bordercolor',
			
			),
			'color'				=> array(
			
				'default'	=> '',
				'setting'	=> 'title_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '',
				'setting'	=> 'title_text_size',
			
			),
		
		),
		'.slickmap #primaryNav > #home > a:link::after, .slickmap #primaryNav > #home > a:visited::after'				=> array(
		
			'color'				=> array(
			
				'default'	=> '',
				'setting'	=> 'path_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '',
				'setting'	=> 'path_text_size',
			
			),
		
		),
		'.slickmap #primaryNav > #home > a:hover'																		=> array(
		
			'background-color'	=> array(
			
				'default'	=> '',
				'setting'	=> 'bgcolor_hover',
			
			),
			'border-color'		=> array(
			
				'default'	=> '',
				'setting'	=> 'bordercolor_hover',
			
			),
		
		),
	
	),
	'level1'	=> array(
	
		'.slickmap #primaryNav li a'																					=> array(
		
			'background-color'	=> array(
			
				'default'	=> '#c3eafb',
				'setting'	=> 'bgcolor',
			
			),
			'border-color'		=> array(
			
				'default'	=> '#b5d9ea',
				'setting'	=> 'bordercolor',
			
			),
			'color'				=> array(
			
				'default'	=> '#000000',
				'setting'	=> 'title_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '14px',
				'setting'	=> 'title_text_size',
			
			),
		
		),
		'.slickmap #primaryNav li a:link::after, .slickmap #primaryNav li a:visited::after'								=> array(
		
			'color'				=> array(
			
				'default'	=> '#78a9c0',
				'setting'	=> 'path_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '10px',
				'setting'	=> 'path_text_size',
			
			),
		
		),
		'.slickmap #primaryNav li a:hover'																				=> array(
		
			'background-color'	=> array(
			
				'default'	=> '#e2f4fd',
				'setting'	=> 'bgcolor_hover',
			
			),
			'border-color'		=> array(
			
				'default'	=> '#97bdcf',
				'setting'	=> 'bordercolor_hover',
			
			),
		
		),
	
	),
	'level2'	=> array(
	
		'.slickmap #primaryNav li ul li a'																				=> array(
		
			'background-color'	=> array(
			
				'default'	=> '#cee3ac',
				'setting'	=> 'bgcolor',
			
			),
			'border-color'		=> array(
			
				'default'	=> '#b8da83',
				'setting'	=> 'bordercolor',
			
			),
			'color'				=> array(
			
				'default'	=> '#000000',
				'setting'	=> 'title_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '14px',
				'setting'	=> 'title_text_size',
			
			),
		
		),
		'.slickmap #primaryNav li ul li a:link::after, .slickmap #primaryNav li ul li a:visited::after'					=> array(
		
			'color'				=> array(
			
				'default'	=> '#8faf5c',
				'setting'	=> 'path_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '10px',
				'setting'	=> 'path_text_size',
			
			),
		
		),
		'.slickmap #primaryNav li ul li a:hover'																		=> array(
		
			'background-color'	=> array(
			
				'default'	=> '#e7f1d7',
				'setting'	=> 'bgcolor_hover',
			
			),
			'border-color'		=>  array(
			
				'default'	=> '#94b75f',
				'setting'	=> 'bordercolor_hover',
			
			),
		
		),
	
	),
	'level3'	=> array(
	
		'.slickmap #primaryNav li ul li ul li a'																		=> array(
		
			'background-color'	=> array(
			
				'default'	=> '#fff7aa',
				'setting'	=> 'bgcolor',
			
			),
			'border-color'		=> array(
			
				'default'	=> '#e3ca4b',
				'setting'	=> 'bordercolor',
			
			),
			'color'				=> array(
			
				'default'	=> '#000000',
				'setting'	=> 'title_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '12px',
				'setting'	=> 'title_text_size',
			
			),
		
		),
		'.slickmap #primaryNav li ul li ul li a:link::after, .slickmap #primaryNav li ul li ul li a:visited::after'		=> array(
		
			'color'				=> array(
			
				'default'	=> '#ccae14',
				'setting'	=> 'path_text_color',
			
			),
			'font-size'			=> array(
			
				'default'	=> '9px',
				'setting'	=> 'path_text_size',
			
			),
		
		),
		'.slickmap #primaryNav li ul li ul li a:hover'																	=> array(
		
			'background-color'	=> array(
			
				'default'	=> '#fffce5',
				'setting'	=> 'bgcolor_hover',
			
			),
			'border-color'		=> array(
			
				'default'	=> '#d1b62c',
				'setting'	=> 'bordercolor_hover',
			
			),
		
		),
	
	),

);



//define static values for plugin
define( 'SlickMap_VERSION', '1.3' );
define( 'SlickMap_REQUIRED_WP_VERSION', '4.0' );
define( 'SlickMap_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'SlickMap_PLUGIN_NAME', trim( dirname( SlickMap_PLUGIN_BASENAME ), '/' ) );
define( 'SlickMap_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );
define( 'SlickMap_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );



//include admin settings
require_once SlickMap_PLUGIN_DIR . '/settings.php';



//function to enqueue plugin files
function slickmap_css_sitemap_frontend_enqueue( array $settings ) {

	if( is_array( $settings ) ) {
	
		wp_localize_script( 'slickmap_css_front_js', 'slickmapSettings', $settings );
	
	}	//end if( is_array( $settings ) )
	wp_enqueue_style( 'slickmap_css' );
	wp_enqueue_script( 'slickmap_css_front_js' );

}	//end slickmap_css_sitemap_frontend_enqueue( array $settings )



//function to check saved setting value against default. returns saved value if different, false if default.
function slickmap_css_sitemap_get_saved_setting( $level, $setting, $default ) {

	//get option name and saved value
	$option = 'slickmap_css_sitemap_' . $level . '_' . $setting;
	$saved = get_option( $option );
	//check if saved differs from default, return appropriate value
	if( $saved == $default || empty( $saved ) ) {
	
		return false;
	
	}
	else {
	
		return $saved;
	
	}	//end if( $saved == $default || empty( $saved ) )

}	//end slickmap_css_sitemap_get_saved_setting( $level, $setting, $default )



//checks if transient containing saved styles exists and is current. if so, returns style string from transient. If not, generates string, saves transient, and returns style string.
function slickmap_css_sitemap_get_saved_styles() {

	if( false === ( $style_transient = get_transient( 'slickmap_css_sitemap_styles' ) ) ) {
	
		slickmap_css_sitemap_save_style_transient();
		$style_transient = get_transient( 'slickmap_css_sitemap_styles' );
	
	}	//end if( false === ( $style_transient = get_transient( 'slickmap_css_sitemap_styles' ) ) )
	return $style_transient;

}	//end slickmap_css_sitemap_get_saved_styles()



//function to return all style settings as inline <style> string
function slickmap_css_sitemap_return_user_styles() {

	//assume all styles are default
	$styles_are_default = true;
	
	//begin building concatenated styles
	$styles = "<style>\n";
	
	//use global defaults
	global $slickmap_css_sitemap_default_settings;
	
	//check each setting and set rules if necessary
	foreach( $slickmap_css_sitemap_default_settings as $level => $selectors ) {
	
		if( $level == 'general' ) {
		
			//show/hide gradient (if hide) background-image: none; (this is an oddly implemented rule)
			if( get_option( 'slickmap_css_sitemap_general_gradient' ) == 'hide' ) {
			
				$styles_are_default = false;
				$styles .= ".slickmap #primaryNav li a {\n	background-image: none !important;\n}\n";
			
			}	//end if( get_option( 'slickmap_css_sitemap_general_gradient' ) == 'hide' )
		
		}	//end if( $level == 'general' )
		foreach( $selectors as $selector => $properties ) {
		
			$styles .=  $selector . " {\n";
			
			foreach( $properties as $property => $values ) {
			
				$newrule = slickmap_css_sitemap_get_saved_setting( $level, $values['setting'], $values['default'] );
				if( $newrule ) {
				
					$styles_are_default = false;
					$styles .= '	' . $property . ": " . $newrule . ";\n";
				
				}	//end if( $newrule )
			
			}	//end foreach( $properties as $property => $values )
			$styles .= "}\n";
		
		}	//end foreach( $selectors as $selector => $properties )
	
	}	//end foreach( $slickmap_css_sitemap_default_settings as $level => $details )
	
	//add advanced additional style rules
	$styles .= get_option( 'slickmap_css_sitemap_advanced_additional_css' );
	
	//finish building concatenated styles
	$styles .= "</style>\n";
	
	//only return concatenated styles if any saved styles differ from default
	if( $styles_are_default ) {
	
		return '<!-- Slickmap Using Default Styles -->';
		
	}
	else {
	
		return $styles;
	
	}	//end if( $styles_are_default )

}	//end slickmap_css_sitemap_return_user_styles()




// add shortcode slickmap
//e.g. [slickmap columns="7"]<ul><li>Home</li><li>Level One<ul><li>Level Two<ul><li>Level Three</li></ul></li></ul></li></ul>[/slickmap]
add_shortcode( 'slickmap', 'slickmap_css_sitemap_shortcode' );
function slickmap_css_sitemap_shortcode( $atts, $content = null ) {

	// attribute allows manual column setting
	extract( shortcode_atts(
	
		array(
		
			'columns'	=>	'7',
		
		), $atts )
	
	);
	
	//include css and js, as well as column count to js
	$settings_array = array (
	
		'columns'	=> $columns,
	
	);
	//if breakpoint is set in options, send value to JS
		if( get_option( 'slickmap_css_sitemap_general_breakpoint' ) ) {
	
		$settings_array['breakpoint'] = get_option( 'slickmap_css_sitemap_general_breakpoint' );
	
	}	//end if( get_option( 'slickmap_css_sitemap_general_breakpoint' ) )
	slickmap_css_sitemap_frontend_enqueue( $settings_array );
	
	//fetch options, store non-defaults as css strings in arrays
	$style = slickmap_css_sitemap_get_saved_styles();

	//concatenate all content for output
	$sitemap = $style;
	//open containers
	$sitemap .= '<div class="slickmap sitemap">';
	//wrapped ul content here
	$sitemap .= "\n		" . $content . "\n";
	$sitemap .= '</div>';
	//return final output of sitemap
    return $sitemap;

}	//end slickmap_css_sitemap_shortcode( $atts, $content = null )




//register slickmap css; sets defaults and display style. register script to name and attach id/classes to uls/lis
add_action( 'wp_enqueue_scripts', 'register_slickmap_css_sitemap_files' );
function register_slickmap_css_sitemap_files() {

	wp_register_style( 'slickmap_css', SlickMap_PLUGIN_URL . '/css/slickmap.css', array(), SlickMap_VERSION );
	wp_register_script( 'slickmap_css_front_js', SlickMap_PLUGIN_URL . '/js/slickmap_css_sitemap_setclass.js', array( 'jquery' ), SlickMap_VERSION, true );

}	//end include_slickmap_css_sitemap_files()
