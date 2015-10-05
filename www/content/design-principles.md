<!--
Title: Design Principles of WPLib
Description: The Design Principles of WPLib
Author: Mike Schinkel
Date: 2015/04/28
-->

#Design Principles of WPLib
WPLib is a **relatively opinionated foundation library** with many conventions over configuration, and it was designed with a clear vision or what we want to achieve.

##Built for Agency and Internal Corporate Developers

WPLib was **_not_** built for an altruistic vision of democratizing publishing, as was WordPress itself. We think the WordPress team is doing a mighty fine job as is and we doubt they really need our help.

Instead WPLib was built first and foremost **for software developers (a.k.a. _"coders"_) using WordPress as a platform to address business needs**. It is that group &mdash; _those who are often frustrated with WordPress because of the dearth of support for business use_ &mdash; whose needs we are attempting to address with WPLib.

##Embraces and Extends WordPress

WPLib believes in WordPress, and in it's core architecture. We appreciate how easy it is to modify and extend for the uninitiated, and how that has contributed in part to its overwhelming success as a web content management system and web application platform.

But WPLib also believes that many of the standard WordPress development practices can easily lead developers to create of a house of cards which can cause cost overruns, lack of agility, and even project failure. WPLib was conceived to overcome those issues.

##Believes in Compatibility
Important to the WPLib philosophy is that WPLib be _compatible_ with common theme coding practices. 

What this means a development team can use WPLib to build a website but, if needed, any WordPress developer can extend the website using common WordPress coding practices without being incompatible with WPLib. 

The downside, of course, is that adding non-WPLib-aware code to a WPLib site results in the site becoming less maintainable. However, it will still be more maintainable than if the entire site were developed using common coding practices. 

##Embraces Object-Orientation

WPLib is unapologetically object-oriented.  OOP is not difficult to learn, at least not the OOP required to use WPLib, but if you have an irrational aversion to OOP then WPLib will not be your cup of tea.

##Embraces MV* (Model/View/etc.)

WPLib is an MV* foundation library for WordPress. It offers base Model, View and other classes for wrapping Post Types, Taxonomy Terms and Users as well as other entity types. 

WPLib does NOT try to gut WordPress and replace it's URL rewriting engine.  Instead WPLib co-exists peacefully with WordPress and most existing plugins and themes.  WPLib does offer a module for URL Routing but that module layers on top of WordPress' existing internal routing logic.

##Embraces Modularity

WPLib has a minimal core and the rest of its functionality is and will later be delivered as modules.

##Assumes PhpStorm 

The developers of WPLib have found that PhpStorm has no significant competition when it comes to empowering WordPress developers and that anyone who is developing PHP scripts for WordPress is severely handicapped if they are not using PhpStorm.

As such WPLib assumes PhpStorm.  We don't recommend attempting to build WPLib sites or apps without it as it would simply be too confusing to do so.

##Assumes a Persistent Object Cache

Given the availability of advanced WordPress hosting today it does not make sense for any agency or corporation to deploy a new WordPress site that does not have persistent object cache available.  As such WPLib assumes a persistent object cache.  

Any WPLib implementation that does implement a persistent object cache will likely see performance degradation as the code complexity and site traffic grows.

##Assumes Local Development with Testing, Staging and Production Servers

asadsad

##Assumes Version Control

asadsad

##Favors Strict Naming Conventions
By following strict naming conventions we can minimize the effort required when naming identifiers in code and make it easier for a developer to understand code written by another developer. We believe this will improve code consistency across many developers as well as over time.

Further, strict naming conventions enable shortcuts to be baked into WPLib and they allow WPLib to allow certain things, such as sanitization to happen automatically.

### The `the_` prefix
In WPLib we use the `the_` prefix for anything that will echo output:

	$person = new YourSite_Person( $post );
	$person->the_fullname();

Note we do **NOT** use a `render_` prefix for output.  **Because. We just don't.**

And the `the_` prefix is generated automatically, in most cases.  Simply define a method `fullname()` or `get_fullname()` in the `Person` model class and `the_fullname()` will echo the return value.

Point of note, WPLib code should not use the `render_` prefix for output because having two conventions for the same thing can cause confusion.

### Suffixes like `_url`, `_attr`

When we use any of the well-known suffixes defined by WPLib we will get automatic sanitization, i.e.:

- `_url` - Automatically sanitized by `esc_url()`
- `_attr` - Automatically sanitized by `esc_attr()`

For example, the following would automatically call `esc_url()` and `esc_attr()`, respectively, and this would be fully testable:

	$person = new YourSite_Person( $post );
	?><img src="<?php $person->the_avatar_url(); ?>" 
		   alt="<?php $person->the_fullname_attr(); ?>"><?php 

Note that above we only need to declare `get_fullname()` and `the_fullname_attr()` will automatically exist and apply `echo esc_attr()` to the return value of `get_fullname()`.


##Prescribes Emergent Code Patterns

By prescribing what code should go where WPLib helps reduce the decisions that coders need to make and minimize the amount of logic duplication that is normally rampant throughout a complex WordPress site.

The following are just some of the prescriptive aspects of WPLib; more details to come later:

###Entity Classes 
Your Entity Classes inherit from `YourSite_Entity_Base` which should inherit from `WPLib_Entity_Base`. This class should have on `on_load()` method in which any actions or filters that are needed are added and those actions and filters would hook `static` methods in the class. And the Entity should _(almost?)_ never have any properties or instance methods.

###Model Classes
Your Model Classes inherit from `YourSite_Model_Base` which should inherit from `WPLib_Model_Base` and should contain all instance properties and methods that are free of output context _(i.e. HTML5 vs. JSON, for example)_  Model classes should _(almost?)_ never have any `static` methods.

###View Classes
Your View Classes inherit from `YourSite_View_Base` which should inherit from `WPLib_View_Base` and should provide only instance methods that are specific to the output context _(i.e. HTML5 vs. JSON, for example)_. However, View methods should _(almost?)_ never encapsulate any markup code that the themer might want to see and/or change, such as CSS classes.  

An example View method might be `$person->get_fullname_link([$args])` which outputs the HTML needed to display a person's full name surrounded as the hyperlink to the person's page. `$args` would be optional, but if passed could be either an array or string in [URL query format](https://php.net/http_build_query) containing CSS classes or any other link attributes. See `WPLib::get_permalink_html()` for details on valid parameters.

###Template Parts
Although we could encapsulate HTML fragments into view class methods WPLib expects HTML that might need to be updated by a themer to live in a Template Part which can be found in the `/partials/` subdirectory of a theme.  Template parts are included by using the view method `the_template( $base_filename )`.

###Helper Methods
Helper methods are `static` methods contained in `Helper Classes` that contribute methods to the central class for a WPLib-based WordPress site or application, i.e. `YourSite`. Helper methods provide a central namespace so themers and other site coders do not need to understand the full object hierarchy of WPLib and the site/app to use it. Examples of helper methods might be `YourSite::get_person_list()` and `YourSite::current_url()`.

##Values Minimal Templates
When using WPLib conventions, templates should have minimal PHP and Javascript code and should not have any business logic contained within. The business logic should instead be encapsulated into `Model`, `View` and `List` classes

##Embraces Minimal Syntax
Primarily this means we don't use `public` when we declare functions because doing so it **redundant** and adds to the visual complexity of code We also use `var` instead of `public` to declare properties in classes.

And we recommend that you do not do so either.

##Promotes Automated Sanitization
Rather than requiring templates to be literally **littered** with sanitization function calls making the nature of the template much harder to understand _(and this is what WordPress VIP promotes as a best practice!)_ WPLib uses naming conventions to implement sanitation. 

And unlike [**the approaches promoted by WordPress VIP**](https://vip.wordpress.com/documentation/best-practices/security/validating-sanitizing-escaping/), WPLib's approach should be able to be verified by automated code scanning and via Unit Testing.

##Themers Need Never Guess about HTML, CSS classes and/or Sub-Templates
Although we use objects and methods in View classes, the View methods should never obscure the HTML that will be generated from the Themer. For more details read this [**best practice document**](/best-practices/html-snippets-and-css-classes).

##Judicious Use of Class Constants
Given that WPLib is object-oriented and that PHP does not have the annotations of Java WPLib uses a few well-known class constants as key to its architecture.  For example, the `POST_TYPE` and `TAXONOMY` constants are used with Post and Taxonomy Term classes, respectively, for example:

	class YourSite_Brand extends WPLib_Post_Base {
		const POST_TYPE = 'ys_brand';
		
		/* 
		 * ... properties and methods go here.
		 */
	}
	
	class YourSite_Region extends WPLib_Term_Base {
		const TAXONOMY = 'ys_region';
		
		/* 
		 * ... properties and methods go here.
		 */
	}
	
##Evolvable Functions and Methods

Functions and Methods often accept parameters, and over time developers find need to pass more parameters to existing functions. The unenlightened approach is to simply add additional parameters, i.e. a 2nd, 3rd, 4th and so one and include default values to make them optional. But doing so can result in calls that look like this

	my_brand_function( $brand, null, null, $parent_id );
	
That's why we use two patterns we call `$args` and `$by`:

###The $args pattern
With the `$args` pattern a developer includes the absolutely required parameter as real parameters and then anything else gets passed in as a named array element in `$args`. So the above call might look like this:

	my_brand_function( $brand, array( 
		'parent_id' => $parent_id,
	));
	
Then in the function or method itself the `$args` pattern is collected and defaulted like so:

	function my_brand_function( $brand, $args = array() ) {
		$args = wp_parse_args( $args, array(
			'css_class' => false,
			'post_type' => 'any',
			'posts_per_page' => 999,
			'parent_id' => false,
		));	
		/*
		 * The guts of the function goes here.
		 */ 
	}
	
###The $by pattern
When writing a look function you often have different types of values that are able to lookup the same thing. So that's were we use a `$by` parameter:

	function get_post_by( $by, $value ) {
		switch ( $by ) {
			case 'slug':
			case 'post_name':
				$criteria['name'] = trim( $value );
				break;

			case 'post_id':
			case 'post_ID':
			case 'id':
			case 'ID':
				$criteria['p'] = intval( $value );
				break;
		}
		/*
		 * The guts of the function goes here.
		 */ 
	}
 