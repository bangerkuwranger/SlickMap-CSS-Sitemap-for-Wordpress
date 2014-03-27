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
	add_options_page( 'SlickMap CSS Sitemap Options', 'SlickMap Options', 'manage_options', 'slickmap_css_sitemap_menu', 'slickmap_css_sitemap_menu_content');
}

add_action('admin_menu', 'slickmap_css_sitemap_menu');

function slickmap_css_sitemap_menu_content() {

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
	if (substr($content, 0, 4) == '<ul>') {
		$sitemap_structure = substr($content, 4);
	}
	else {
		$sitemap_structure = $content . '</ul>';
	}
	//concatenate all content for output
	$sitemap = '<ul id="primaryNav">';
	//style tag here
	$sitemap .= $style;
	// modified ul content here
	$sitemap .= $sitemap_structure;
	//final output of sitemap
    return $sitemap;
}
add_shortcode( 'slickmap', 'slickmap_css_sitemap_shortcode_shortcode' );

//include slickmap css; sets defaults and display style
function include_slickmap_css_sitemap_style() {
	wp_enqueue_style ( 'slickmap_css', plugins_url().'/slickmap/slickmap.css' );
}

add_action( 'wp_enqueue_scripts', 'include_slickmap_css_sitemap_style' );

