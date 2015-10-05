## Create an Application

We'll call our App _"LawPress":_ 

1. **Create a subfolder** in your Must-Use Plugins directory:
	- For example: `~/Sites/LawPress/www/wp-content/mu-plugins/lawpress-app/`

1. **Create a Main file** for your Application in `lawpress-app.php` and add the following code:
    
    ```php
	<?php
    class LawPress extends WPLib_App_Base {
        static function on_load() {
            WPLib::register_helper( __CLASS__, 'WPLib' );
        }
    }
	LawPress::on_load();
	```
1. Add the following line to the end of your `plugin-loader.php`:


	```php
	require __DIR__ . '/lawpress-app/lawpress-app.php';
	```

1. You now have a WPLib Application as a starting point for your application.
	- You should test your site to make sure it loads without breaking, though you will not see any changes yet.

	
### _What Did We Just Do?_
We created an **Application** class that will be where we will add global methods needed for our LawPress applications such as `LawPress::get_practice_areas( $args )` and also where we can store our general purpose hooks for our application.

### _Comparison to a Plugin?_
An Application and a Plugin are similar in many ways, but an plugin can provide functionality of practically any type, and for any given website there is **only one (1) Application** specifically provides functionality that defines the nature of a website. 

### _Comparison to a Theme?_
WordPress themes were intended to provide only the look and feel for a WordPress site but many have grown to be full applications themselves.  

For example, [AppThemes](https://www.appthemes.com/) has the theme [**HireBee**](https://www.appthemes.com/themes/hirebee/) which implements a freelance marketplace. If HireBee were refactored for WPLib then HireBee would become an Application and its look and feel would be implemented as a Theme separated from the Application's functionality.

Thus the benefit of an Application is that complementary themes can be very small and a new look and feel can easily be added.


<hr>
##NEXT: [Create a Theme Class](/quick-start/create-a-theme-class) 
##BACK: [Install WPLib](/quick-start/install-wplib)
##UP: [QuickStart](/quick-start) 
