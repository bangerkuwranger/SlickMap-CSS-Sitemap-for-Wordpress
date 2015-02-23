SlickMap CSS Sitemap
====================

Wordpress plugin to create a custom HTML/CSS sitemap. Set your colors and fonts, then wrap any set of ULs in a shortcode to make an interactive sitemap. Uses Matt Everson's SlickMap CSS (astuteo.com); give him money if you dig this. 


Contributors: bangerkuwranger

Donate link: http://www.chadacarino.com/burnallmoney.html

Tags: custom site map, html, interactive, CSS, no javascript

Requires at least: 3.1

Tested up to: 4.1

Stable tag: 1.2.1

License: MIT

License URI: http://www.chadacarino.com/license-mit.html

## Description

So, you want to make a pretty, interactive sitemap without JS, crazy formatting, or a lot of work? You can use Matt Everson's fantastic [SlickMap CSS](http://astuteo.com/slickmap/) inline, or include it in your theme. You could, if you want to generate a sitemap for a simple, single WP install site, use [Pengbo's Slick HTML Sitemap plugin](http://pengbos.com/blog/slick-html-sitemap) to generate that pretty quickly. But, if you're still reading and not downloading either of those, it probably means you want to create a custom, complex sitemap that may cover different sites, subdomains, etc... but you still don't want to make complex, brittle code on your WP site to put it together. So, use this plugin to get all of the benefits of SlickMap CSS by just wrapping a series of nested unordered lists with a shortcode. The settings allow you to pick your font and colors for each layer. Updating your map is as easy as changing the elements on your page/post in the visual editor. Easy!

## Installation

1. Upload the `slickmap` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create a set of ULs, nested up to three levels deep on a page or in a post.
4. Wrap your UL block in `[slickmap]<your map>[/slickmap]`
5. Repeat wherever you want a pretty little sitemap.

## Frequently Asked Questions


- So, what does a sitemap look like?
	- You can get a pretty good idea of what a slickmap based sitemap will look like by checking out Matt’s demo here: https://www.astuteo.com/slickmap/demo/ Of course, since you can change the colors and fonts using this plugin’s settings, it may look very different by the time you’re done with it.
 
- No, what does the *code* look like?
	- Well, you don’t have to do anything fancy in the HTML; this plugin was designed to build sitemaps quickly using WordPress’s visual editor. The ‘Bulleted List’ button creates unordered lists (`<ul></ul>`) for you, and you can set which level you want each page in the sitemap to appear on by using the ‘Increase Indent’ and ‘Decrease Indent’ buttons. Basically, you are making an outline view of your site that the plugin turns into a nice visual tree. BUT, if you want a real example of what the HTML looks like, because you code all of your WordPress pages on a typewriter and scan it in as raw HTMl or something, here’s what the HTML would look like to generate Matt’s demo page linked above: 

`<ul>`

`	<li id="home"><a href="http://astuteo.com">Home</a></li>`

`	<li><a href="demo/about">About Us</a>`

`		<ul>`

`			<li><a href="demo/history">Our History</a></li>`

`			<li><a href="demo/mission">Mission Statement</a></li>`

`			<li><a href="demo/principals">Principals</a></li>`

`		</ul>`

`	</li>`

`	<li><a href="demo/services">Services</a>`

`		<ul>`

`			<li><a href="demo/design">Graphic Design</a></li>`

`			<li><a href="demo/development">Web Development</a></li>`

`			<li><a href="demo/marketing">Internet Marketing</a>`

`			<ul>`

`					<li><a href="demo/social-media">Social Media</a></li>`

`					<li><a href="demo/seo">Search Engine Optimization</a></li>`

`					<li><a href="demo/adwords">Google AdWords</a></li>`

`				</ul>`

`			</li>`

`			<li><a href="demo/copywriting">Copywriting</a></li>`

`			<li><a href="demo/photography">Photography</a></li>`

`		</ul>`

`	</li>`

`	<li><a href="demo/projects">Projects</a>`

`		<ul>`

`			<li><a href="demo/finance">Finance</a></li>`

`			<li><a href="demo/medical">Medical</a></li>`

`			<li><a href="demo/education">Education</a></li>`

`			<li><a href="demo/professional">Professional</a></li>`

`			<li><a href="demo/industrial">Industrial</a></li>`

`			<li><a href="demo/commercial">Commercial</a></li>`

`	
			<li><a href="demo/energy">Energy</a></li>`

`		</ul>`

`	</li>`

`	<li><a href="demo/contact">Contact</a>`

`		<ul>`

`			<li><a href="demo/offices">Offices</a>`

`				<ul>`

`					<li><a href="demo/map">Map</a></li>`

`					<li><a href="demo/form">Contact Form</a></li>`

`				</ul>`

`			</li>`

`		</ul>`

`	</li>	`

`</ul>`



## Changelog

* 1.2 - 4.0 Compatibility and tweaks to default css

* 1.1 - Compatibility with 3.9


## Upgrade Notice
