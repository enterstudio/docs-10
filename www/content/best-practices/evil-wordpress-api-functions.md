<!--
Title: Functions of the WordPress API to Avoid | WPLib Best Practices
Description: WPLib Best Practice: Functions of the WordPress API to Avoid
Author: Mike Schinkel
Date: 2015/04/26
-->


#Functions of the WordPress API to Avoid

The following functions can be rightly called _"evil"_ as they can easily break other code in your site/app and/or can be broken by code changes made elsewhere in your site/app. 

##The Loop
Avoid The Loop and all functions related to [**The Loop**](https://codex.wordpress.org/The_Loop).  

Here is an example of The Loop code:
	
	if ( have_posts() ):
		while ( have_posts() ):
		the_post(); ?>
		<h1><?php the_title(); ?></h1>
			<?php the_content(); 
		endwhile;
	endif;

Use a List object rather than The Loop. 

	$articles = YourApp_Article::get_list();
	if ( $articles->count() ):
		foreach( $articles as $article ): ?>
			<h1><?php article->the_title(); ?></h1>
			<?php article->the_content(); 
		endforeach;
	endif;

Using List objects is more robust as they do not rely on global variables in the same manner as does The Loop.

##wp_reset_postdata()
The `wp_reset_postdata()` function arbitrarily sets global variables and is typically used to restore an environment after a `setup_postdata()`. 

But `wp_reset_postdata()` does not actually restore what came before, it sets the environment to a default state instead. If there was a variable in global scope that conflicts, _(such as an object stored in a variable named `$page`)_, calling `wp_reset_postdata()` breaks code elsewhere.  

Here is an example of how `wp_reset_postdata()` might be used _**(provide a better example):**_


	function get_content_html() {
		setup_postdata( $this->post() );
		$content = get_the_content();
		wp_reset_postdata();
		return $content;
	}

Using WPLib we can instead do this:

	function get_content_html() {
		$saved = $this->setup_postdata();
		$content = get_the_content();
		$this->restore_postdata( $saved );
		return $content;
	}

And that is much less likely to break surrounding code.

Of course `wp_reset_postdata()` is a recommended WordPress API function but this is a perfect example of how WPLib can improve robustness of your WordPress applications.

	
##Template Tags that Rely on Global Data.

###Template Tags that are Purely Evil

###Template Tags that are Evil If Unqualified
These template tags are okay to use if qualified with a `$post` or `$post_id` or other relevant parameter.  

- `	get_the_title()`
 
However, it is generally better to use WPLib's instance methods than these functions because the former are designed to be robust where some of the template tags have issues with accessing or updating global variables.




##query_posts()

