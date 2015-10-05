<!--
Title: Code Smells to Avoid | WPLib Best Practices
Description: WPLib Best Practice: Code Smells to Avoid
Author: Mike Schinkel
Date: 2015/04/26
-->


#Code Smells to Avoid when using WPLib

One of Wikipedia's definitions of a _"[_Code Smell_](http://en.wikipedia.org/wiki/Code_smell)"_ s:

> _"(Code) smells are certain structures in the code that indicate violation of fundamental design principles and negatively impact design quality"._

Wikipedia goes on to say:
> _"Code smells are usually not bugs—they are not technically incorrect and do not currently prevent the program from functioning. Instead, they indicate weaknesses in design that may be slowing down development or increasing the risk of bugs or failures in the future."_

So that is the context for these code smells to avoid; approaches to working with WPLib that would indicate a misuse or a misunderstanding of how the objects in WPLib are intended to be used.

##Escaping the Output of `get_` Methods

In general `get_` methods should not have their return values escaped, even in Views.  The output of `get_` methods should be assumed to be raw and unescaped.

Instead either use the `the_` methods with explicit escaping based on method name suffix or using escaping at the point of output:

	<a href="<?php $entity->the_url(); ?>">
		<?php $entity->the_title(); ?>
	</a>
	
Or:

	<a href="<?php esc_url( $entity->get_url() ); ?>">
		<?php esc_html( $entity->the_title() ); ?>
	</a>
	

##Declaration of `the_` Methods in a View
Although **not always a code smell**, `the_` methods in a View are often code  it is because `the_` methods are generated automatically. Better to simply document them with PHPDoc than to hardcode them.

For example, there is no need to create `the_name()` method as follows in a View _(and also using `get_the_title()` is a [code smell](code-smells)):_

	function the_name() {
		echo esc_html( get_the_title( $this->post() ) );
	}
	
Instead just define one of the following in a Model and `the_name()` will automatically exist and be sanitized with `esc_html()`:

	function name() {
		return $this->title();
	}

Or: 

	function get_name() {
		return $this->title();
	}

Of course you should declare `the_name()` with PHPDoc in the header of the View class like so:

	/**
	 * Class YourSite_Your_View
	 * 
 	 * @var void the_name()
 	 */
 	class YourSite_Your_View {
 		// Class code goes here
 	}
 	
##Naming View Methods with a `_link_html()` Suffix
By WPLib convention `_link()` as a suffix on a View Method implies HTML, so no need to double up _(and doing so might even confuse WPLib at times, so better safe than sorry.)_