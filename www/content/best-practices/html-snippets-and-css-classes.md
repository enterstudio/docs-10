<!--
Title: HTML Snippets and CSS Classes Should Always be Visible to Themer | WPLib Best Practices
Description: WPLib Best Practice: Always Make HTML Snippets & CSS Classes Visible to Themer
Author: Mike Schinkel
Date: 2015/04/22
-->


#Always Make HTML Snippets & CSS Classes Visible to Themer

When designing a View class, you should generally never hardcode HTML snippets and CSS classes into the actual PHP class. Instead you should create a template and put the snippets and classes into the template and then load with the `the_template()` method. 

It is important for the Themer to always know where to find any HTML & CSS classes , or at least know what HTML & CSS a method is outputting _(see below)._  

This means that a View developer should _never_ use a method that embeds HTML snippets and/or CSS classes like the following counter example.

##Counter-Example

The following View method would be counter-example of this best practice. Note the `get_headline()` methods embeds both the `<h2>` element and the CSS class `headline` inside the method:

```php
class YourSite_Article_View {
	...

	function get_headline() {

		echo '<h2 class="headline">' $this->headline() . '</h2>';
	
	}

	...
}

```

##The Best Practice

Those hardcoded references to both `<h2>` and `headline` content should be stored in a template file maybe named `article-headline.php` that would look like this:

```php
<h2 class="headline"><?php $entity->the_headline(); ?></h2>
```

And it would be loaded by the following line in a theme template file:
 
```php
<?php $entity->the_template( 'article-headline' ); ?>
```

##Using Template Parameters
For a template to be reusable it might need to have parameters passed in. Consider the prior example but with an optional value for `class`.  You can pass the parameters as a string or as an array; these two calls to `the_template()` would behave identically:

 
```php
<?php $entity->the_template( 'article-headline', 'class=featured' ); ?>

<?php $entity->the_template( 'article-headline', array(
	'class' => 'featured',
 ); ?>
```

Within the template file you can use the special `$template->class` variable which will always exist even if `class` is not passed to `the_template()`. The `$template` variable is an instance of the special `WPLib_Template_Vars` class that captures all property accesses with a magic `__get()` method and returns `null` if a value for the property name was not passed into `the_template()`.

```php
<h2 class="headline {$template->class}"><?php $entity->the_headline(); ?></h2>
```


 
```php
<?php $this->the_template( 'article-headline' ); ?>
```

##Exception: Simple HTML
An exception to this best practice is that a method can output HTML for a single element assuming all the attributes are passed in.  

The following example shows a method that outputs an `<a>` element where the CSS class `'invert-on-hover'` is added as the class attribute:

```php
<?php $this->the_article_title_link( 'class=invert-on-hover' ); ?>
```
Actually `_link` is a _"Well-Known Suffix"_ in WPLib meaning that any method with that name should always return a valid HTML `<a>` element.

```php
class YourSite_Article_View {
	...

	function get_article_title_link( $args ) {
		$args = wp_parse_args( $args, array(
			'class' = null,
		));
		$link = '<a href="%s" class="%s">%s</a>';
		echo sprintf( $link,
			$this->permalink(),
			$args[ 'class' ],
			$this->the_title(),
		);	
	}
}		
```
Note #1: The method `the_article_title_link()` will automatically call `get_article_title_link()` and its return value will automatically be passed to `wp_kses_post()` then `echo`ed. If you do not want to use `wp_kses_post()` for sanitization then you can declare `the_article_title_link()` yourself.

Note #2: Rather than use `sprintf()` as above you should consider using `WPLib::get_permalink_html()`. 

##Exception: Standardized HTML Snippets and CSS Classes

- External Standard, i.e. Schema.org
- Company/Project Standards
