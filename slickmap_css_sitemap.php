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


define( 'SlickMap_VERSION', '1.3' );

define( 'SlickMap_REQUIRED_WP_VERSION', '4.0' );

define( 'SlickMap_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

define( 'SlickMap_PLUGIN_NAME', trim( dirname( SlickMap_PLUGIN_BASENAME ), '/' ) );

define( 'SlickMap_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

define( 'SlickMap_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

require_once SlickMap_PLUGIN_DIR . '/settings.php';

// add shortcode slickmap
//e.g. [slickmap]<ul><li>level one</li></ul>[/slickmap]
add_shortcode( 'slickmap', 'slickmap_css_sitemap_shortcode' );
function slickmap_css_sitemap_shortcode( $atts, $content = null ) {

	// attributes allow for manual override of color settings... just in case?
	extract( shortcode_atts(
		array(
			'color1' 	=>	'',
			'color2' 	=>	'',
			'color3' 	=>	'',
			'columns'	=>	'7',
		), $atts )
	);
	
	//include css and js, as well as column count to js
	$settings_array = array (
	
		'columns'	=> $columns,
	
	);
	wp_localize_script( 'slickmap_css_front_js', 'slickmapSettings', $settings_array );
	wp_enqueue_style( 'slickmap_css' );
	wp_enqueue_script( 'slickmap_css_front_js' );
	
	
	
	//fetch options, store non-defaults as css strings in arrays
		$style_rules = array (
			'target1'			=>	array ('selector'	=>	'.slickmap #primaryNav li a'),
			'target1_before'	=>	array ('selector'	=>	'.slickmap #primaryNav li a:link::before, .slickmap #primaryNav li a:visited::before'),
			'target1_hover'		=>	array ('selector'	=>	'.slickmap #primaryNav li a:hover'),
			'target2'			=>	array ('selector'	=>	'.slickmap #primaryNav li li a'),
			'target2_before'	=>	array ('selector'	=>	'.slickmap #primaryNav li li a:link::before, .slickmap #primaryNav li li a:visited::before'),
			'target2_hover'		=>	array ('selector'	=>	'.slickmap #primaryNav li li a:hover'),
			'target3'			=>	array ('selector'	=>	'.slickmap #primaryNav li li li a'),
			'target3_before'	=>	array ('selector'	=>	'.slickmap #primaryNav li li li a:link::before, .slickmap #primaryNav li li li a:visited::before'),
			'target3_hover'		=>	array ('selector'	=>	'.slickmap #primaryNav li li li a:hover'),
			'target4'			=>	array ('selector'	=>	'.slickmap #primaryNav #home a'),
			'target4_before'	=>	array ('selector'	=>	'.slickmap #primaryNav #home a:link::before, .slickmap #primaryNav #home a:visited::before'),
			'target4_hover'		=>	array ('selector'	=>	'.slickmap #primaryNav #home a:hover'),
			'target5'			=>	array ('selector'	=>	'.slickmap #primaryNav'),
			'target6'			=>	array ('selector'	=>	'.slickmap #primaryNav li'),
		);
		//level 1 - #primaryNav li a
			//background: $color; (if background-color≠#c3eafb)
			if( get_option( 'slickmap_css_sitemap_level1_bgcolor' ) != '#c3eafb' ) {
				$style_rules['target1']['background-color'] = get_option( 'slickmap_css_sitemap_level1_bgcolor' );
			}
			//border: 2px solid $color; (if border-color≠#b5d9ea)
			if( get_option( 'slickmap_css_sitemap_level1_bordercolor' ) != '#b5d9ea' ) {
				$style_rules['target1']['border'] = '2px solid ' . get_option( 'slickmap_css_sitemap_level1_bordercolor' );
			}
			//title text color: $color; (if color≠black)
			if( get_option( 'slickmap_css_sitemap_level1_title_text_color' ) != '#000000' ) {
				$style_rules['target1']['color'] = get_option( 'slickmap_css_sitemap_level1_title_text_color' );
			}
			//title font-size: $size; (if font-size≠14px)
			if( get_option( 'slickmap_css_sitemap_level1_title_text_size' ) != '14px' ) {
				$style_rules['target1']['font-size'] = get_option( 'slickmap_css_sitemap_level1_title_text_size' );
			}
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			if( get_option( 'slickmap_css_sitemap_general_radius' ) != '5px' ) {
				$style_rules['target1']['-webkit-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target1']['-moz-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target1']['-o-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target1']['border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
			}
			//background hover color - #primaryNav li a:hover { background-color: $color; } (if background-color≠#e2f4fd)
			if( get_option( 'slickmap_css_sitemap_level1_bgcolor_hover' ) != '#e2f4fd' ) {
				$style_rules['target1_hover']['background-color'] =  get_option( 'slickmap_css_sitemap_level1_bgcolor_hover' );
			}
			//border hover color - #primaryNav li a:hover { border-color: $color; } (if border-color≠#97bdcf)
			if( get_option( 'slickmap_css_sitemap_level1_bordercolor_hover' ) != '#97bdcf' ) {
				$style_rules['target1_hover']['border-color'] =  get_option( 'slickmap_css_sitemap_level1_bordercolor_hover' );
			}
			//path text color #primaryNav li a:link:before, #primaryNav li a:visited:before { color: $color; } (if color≠#78a9c0)
			if( get_option( 'slickmap_css_sitemap_level1_path_text_color' ) != '#78a9c0' ) {
				$style_rules['target1_before']['color'] =  get_option( 'slickmap_css_sitemap_level1_path_text_color' );
			}
			//path font-size #primaryNav li a:link:before, #primaryNav li a:visited:before { font-size: $size; } (if font-size≠10px)
			if( get_option( 'slickmap_css_sitemap_level1_path_text_size' ) != '10px' ) {
				$style_rules['target1_before']['font-size'] =  get_option( 'slickmap_css_sitemap_level1_path_text_size' );
			}

		//level 2 - #primaryNav li li a 
			//background: $color; (if background-color≠#cee3ac)
			if( get_option( 'slickmap_css_sitemap_level2_bgcolor' ) != '#cee3ac' ) {
				$style_rules['target2']['background-color'] = get_option( 'slickmap_css_sitemap_level2_bgcolor' );
			}
			//border: 2px solid $color; (if border-color≠#b8da83)
			if( get_option( 'slickmap_css_sitemap_level2_bordercolor' ) != '#b8da83' ) {
				$style_rules['target2']['border'] = '2px solid ' . get_option( 'slickmap_css_sitemap_level2_bordercolor' );
			}
			//title text color: $color; (if color≠black)
			if( get_option( 'slickmap_css_sitemap_level2_title_text_color' ) != '#000000' ) {
				$style_rules['target2']['color'] = get_option( 'slickmap_css_sitemap_level2_title_text_color' );
			}
			//title font-size: $size; (if font-size≠14px)
			if( get_option( 'slickmap_css_sitemap_level2_title_text_size' ) != '14px' ) {
				$style_rules['target2']['font-size'] = get_option( 'slickmap_css_sitemap_level2_title_text_size' );
			}
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			if( get_option( 'slickmap_css_sitemap_general_radius' ) != '5px' ) {
				$style_rules['target2']['-webkit-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target2']['-moz-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target2']['-o-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target2']['border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
			}
			//background hover color - #primaryNav li li a:hover { background-color: $color; } (if background-color≠#e7f1d7)
			if( get_option( 'slickmap_css_sitemap_level2_bgcolor_hover' ) != '#e7f1d7' ) {
				$style_rules['target2_hover']['background-color'] =  get_option( 'slickmap_css_sitemap_level2_bgcolor_hover' );
			}
			//border hover color - #primaryNav li li a:hover { border-color: $color; } (if border-color≠#94b75f)
			if( get_option( 'slickmap_css_sitemap_level2_bordercolor_hover' ) != '#94b75f' ) {
				$style_rules['target2_hover']['border-color'] =  get_option( 'slickmap_css_sitemap_level2_bordercolor_hover' );
			}
			//path text color #primaryNav li li a:link:before, #primaryNav li li a:visited:before { color: $color; } (if color≠#8faf5c)
			if( get_option( 'slickmap_css_sitemap_level2_path_text_color' ) != '#8faf5c' ) {
				$style_rules['target2_before']['color'] =  get_option( 'slickmap_css_sitemap_level2_path_text_color' );
			}
			//path font-size #primaryNav li li a:link:before, #primaryNav li li a:visited:before { font-size: $size; } (if font-size≠10px)
			if( get_option( 'slickmap_css_sitemap_level2_path_text_size' ) != '10px' ) {
				$style_rules['target2_before']['font-size'] =  get_option( 'slickmap_css_sitemap_level2_path_text_size' );
			}

		//level 3 - #primaryNav li li li a 
			//background: $color; (if background-color≠#fff7aa)
			if( get_option( 'slickmap_css_sitemap_level3_bgcolor' ) != '#fff7aa' ) {
				$style_rules['target3']['background-color'] = get_option( 'slickmap_css_sitemap_level3_bgcolor' );
			}
			//border: 2px solid $color; (if border-color≠#e3ca4b)
			if( get_option( 'slickmap_css_sitemap_level3_bordercolor' ) != '#e3ca4b' ) {
				$style_rules['target3']['border'] = '2px solid ' . get_option( 'slickmap_css_sitemap_level3_bordercolor' );
			}
			//title text color: $color; (if color≠black)
			if( get_option( 'slickmap_css_sitemap_level3_title_text_color' ) != '#000000' ) {
				$style_rules['target3']['color'] = get_option( 'slickmap_css_sitemap_level3_title_text_color' );
			}
			//title font-size: $size; (if font-size≠12px)
			if( get_option( 'slickmap_css_sitemap_level3_title_text_size' ) != '12px' ) {
				$style_rules['target3']['font-size'] = get_option( 'slickmap_css_sitemap_level3_title_text_size' );
			}
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			if( get_option( 'slickmap_css_sitemap_general_radius' ) != '5px' ) {
				$style_rules['target3']['-webkit-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target3']['-moz-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target3']['-o-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target3']['border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
			}
			//background hover color - #primaryNav li li li a:hover { background-color: $color; } (if background-color≠#fffce5)
			if( get_option( 'slickmap_css_sitemap_level3_bgcolor_hover' ) != '#fffce5' ) {
				$style_rules['target3_hover']['background-color'] =  get_option( 'slickmap_css_sitemap_level3_bgcolor_hover' );
			}
			//border hover color - #primaryNav li li li a:hover { border-color: $color; } (if border-color≠#d1b62c)
			if( get_option( 'slickmap_css_sitemap_level3_bordercolor_hover' ) != '#d1b62c' ) {
				$style_rules['target3_hover']['border-color'] =  get_option( 'slickmap_css_sitemap_level3_bordercolor_hover' );
			}
			//path text color #primaryNav li li li a:link:before, #primaryNav li li li a:visited:before { color: $color; } (if color≠#ccae14)
			if( get_option( 'slickmap_css_sitemap_level3_path_text_color' ) != '#ccae14' ) {
				$style_rules['target3_before']['color'] =  get_option( 'slickmap_css_sitemap_level3_path_text_color' );
			}
			//path font-size #primaryNav li li li a:link:before, #primaryNav li li li a:visited:before { font-size: $size; } (if font-size≠9px)
			if( get_option( 'slickmap_css_sitemap_level3_path_text_size' ) != '9px' ) {
				$style_rules['target3_before']['font-size'] =  get_option( 'slickmap_css_sitemap_level3_path_text_size' );
			}

		//home - #primaryNav #home a
			//background: $color; (if background-color≠#c3eafb)
			if( get_option( 'slickmap_css_sitemap_home_bgcolor' ) != '#c3eafb' ) {
				$style_rules['target4']['background-color'] = get_option( 'slickmap_css_sitemap_home_bgcolor' );
			}
			//border: 2px solid $color; (if border-color≠#b5d9ea)
			if( get_option( 'slickmap_css_sitemap_home_bordercolor' ) != '#b5d9ea' ) {
				$style_rules['target4']['border'] = '2px solid ' . get_option( 'slickmap_css_sitemap_home_bordercolor' );
			}
			//title text color: $color; (if color≠black)
			if( get_option( 'slickmap_css_sitemap_home_title_text_color' ) != '#000000' ) {
				$style_rules['target4']['color'] = get_option( 'slickmap_css_sitemap_home_title_text_color' );
			}
			//title font-size: $size; (if font-size≠14px)
			if( get_option( 'slickmap_css_sitemap_home_title_text_size' ) != '14px' ) {
				$style_rules['target4']['font-size'] = get_option( 'slickmap_css_sitemap_home_title_text_size' );
			}
			//(-webkit-,-o-,-moz-)border-radius: $radius; (if border-radius≠5px)
			if( get_option( 'slickmap_css_sitemap_general_radius' ) != '5px' ) {
				$style_rules['target4']['-webkit-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target4']['-moz-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target4']['-o-border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
				$style_rules['target4']['border-radius'] = get_option( 'slickmap_css_sitemap_general_radius' );
			}
			//background hover color - #primaryNav li a:hover { background-color: $color; } (if background-color≠#e2f4fd)
			if( get_option( 'slickmap_css_sitemap_level1_bgcolor_hover' ) != '#e2f4fd' ) {
				$style_rules['target4_hover']['background-color'] =  get_option( 'slickmap_css_sitemap_level1_bgcolor_hover' );
			}
			//border hover color - #primaryNav li a:hover { border-color: $color; } (if border-color≠#97bdcf)
			if( get_option( 'slickmap_css_sitemap_level1_bordercolor_hover' ) != '#97bdcf' ) {
				$style_rules['target4_hover']['border-color'] =  get_option( 'slickmap_css_sitemap_level1_bordercolor_hover' );
			}
			//path text color #primaryNav li a:link:before, #primaryNav li a:visited:before { color: $color; } (if color≠#78a9c0)
			if( get_option( 'slickmap_css_sitemap_home_path_text_color' ) != '#78a9c0' ) {
				$style_rules['target4_before']['color'] =  get_option( 'slickmap_css_sitemap_home_path_text_color' );
			}
			//path font-size #primaryNav li a:link:before, #primaryNav li a:visited:before { font-size: $size; } (if font-size≠10px)
			if( get_option( 'slickmap_css_sitemap_home_path_text_size' ) != '10px' ) {
				$style_rules['target4_before']['font-size'] =  get_option( 'slickmap_css_sitemap_home_path_text_size' );
			}
	//check if atts included any colors, change any array strings that they would override
		//if so, override array string for
			//#primaryNav li a { background-color: $color1;}
			//#primaryNav li li a { background-color: $color2;}
			//#primaryNav li li li a { background-color: $color3;}
	//add global rules for entire sitemap to array
	//show/hide gradient (if hide) background-image: none;
	if( get_option( 'slickmap_css_sitemap_general_gradient' ) == 'hide' ) {
		$style_rules['target1']['background-image'] =  'none !important';
	}
	//padding (if≠10px 0) $padding;
	$padding_array = get_option( 'slickmap_css_sitemap_general_padding' );
	$padding_string = $padding_array['top'] . ' ' . $padding_array['right'] . ' ' . $padding_array['bottom'] . ' ' . $padding_array['left'];
	if( $padding_string != '10px 0px 10px 0px' ) {
		$style_rules['target1']['padding'] =  $padding_string . ' !important';
	}
	//font stack for sitemap
	if( get_option( 'slickmap_css_sitemap_general_font_family' ) != 'Gotham, Helvetica, Arial, sans-serif' ) {
		$style_rules['target5']['font-family'] =  get_option( 'slickmap_css_sitemap_general_font_family' ) . ' !important';
	}
	//create style rules to override included stylesheet
	$style = '<style>';
	//$style .= foreach css selector in array (#primaryNav li a; #primaryNav li a:hover; #primaryNav li a:link:before, #primaryNav li a:visited:before; #primaryNav li li a; #primaryNav li li a:hover; #primaryNav li li a:link:before, #primaryNav li li a:visited:before; #primaryNav li li li a; #primaryNav li li li a:hover; #primaryNav li li li a:link:before, #primaryNav li li li a:visited:before; #primaryNav #home a; #primaryNav #home a:hover; #primaryNav #home a:link:before, #primaryNav #home a:visited:before)
	foreach( $style_rules as $key => $value ) {
		//return selector {
		$style .= $value['selector'] . ' { ';
		//foreach style rule
			foreach( $value as $k => $v ) {
			//return style rule pair from array
				$style .= $k . ': ' . $v . '; ';
			}
		//return }
		$style .= ' } ';
	}
	$style .= '</style>';
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

}	//end slickmap_css_sitemap_shortcode( $atts, $content = null )




//include slickmap css; sets defaults and display style
add_action( 'wp_enqueue_scripts', 'include_slickmap_css_sitemap_files' );
function register_slickmap_css_sitemap_files() {

	wp_register_style( 'slickmap_css', SlickMap_PLUGIN_URL . '/css/slickmap.css', array(), '1.3' );
	wp_register_script( 'slickmap_css_front_js', SlickMap_PLUGIN_URL . '/js/slickmap_css_sitemap_setclass.js', array( 'jquery' ), '1.3', true )

}	//end include_slickmap_css_sitemap_files()
