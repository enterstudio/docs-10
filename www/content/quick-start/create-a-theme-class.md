#Create a Theme Class

1. In your site's Theme's directory create `lawpress-theme.php` with the following code:

    ```php
    <?php
    class LawPress_Theme extends WPLib_Theme_Base {   
    }    
    ```

1. Add the following line to the top of your theme's `functions.php` file to load your `LawPress_Theme` class:

	```php
	require( __DIR__ . '/lawpress-theme.php' );
	```

1. You now have a Theme class you can augment later.
	- You should test your site to make sure it loads without breaking, though you will not see any changes yet.

## _What Did We Just Do?_
- We created an empty class for a `$theme` object to inherits the functionality of `WPLib_Theme_Base`. Later you can also add general-purpose theme properties and methods for use in your theme template files.
- We added the code needed to load your `LawPress_Theme` class after your theme in setup on page load by WordPress prior to make it available within your theme template files.



<hr>
##NEXT: [Create a Simple Module](/quick-start/create-a-simple-module) 
##BACK: [Create an Application](/quick-start/create-an-application) 
##UP: [QuickStart](/quick-start) 
