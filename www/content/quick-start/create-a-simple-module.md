#Create a Simple Module
Let's create a _"Latest News"_ Module to display a banner at the top of every page.

1. **Create a `/modules/` subfolder** in your Application directory:
	- `~/lawpress-app/modules/`
	- _(For this step and the ones that follow we will use `~/` to replace `~/Sites/LawPress/www/wp-content/mu-plugins/`)_ 

1. **Create a subfolder for your actual Module**:
	- `~/lawpress-app/modules/latest-news`

1. **Create a Module Main File**:
	- `~/lawpress-app/modules/latest-news/latest-news.php`
		- _The folder name and file name **must match.**_
	- Then add the following code:
    
	    ```php
		<?php
		class _LawPress_Latest_News extends WPLib_Module_Base {
			static function on_load() {
				self::register_helper( __CLASS__, 'LawPress' );
			}
			static function the_latest_news_html() {
				?>
				<div id="latest-news" style="background:red;text-align:center;color:white;">
					<?php echo 'This is your Latest News!'; ?>
				</div>
				<?php
			}
		}
		_LawPress_Latest_News::on_load();
		```
1. **Register the Module** in the Application:
	- In `~/lawpress-app/lawpress-app.php` add the following method:

		```php
		static function on_load() {
			self::register_module( 'latest-news' );
		}
		```

	- At the end of `~/lawpress-app/lawpress-app.php` add this call:

		```php
		LawPress::on_load();
		```

1. **Document `_LawPress_Latest_News` as a Mixin** in the Application:
	- Add this PHPDoc header to `~/lawpress-app/lawpress-app.php` on the line above the class declaration  _(class declaration shown for context):_

		```php
		/**
		 * Class LawPress
		 *
		 * @mixin _LawPress_Latest_News
		 */
		class LawPress extends WPLib_App_Base {
		```


1. You now have a simple Module that you can use in your Theme. 
	- You should test your site to make sure it loads without breaking, though you will not see any changes yet.

## _What Did We Just Do?_
We created a simple module whose Main file had a Main class `_LawPress_Latest_News` with an output method `the_latest_news_html()` and we registered the Module in the Application so that the Application will load the Module and make its functionality available.

###Notes:
- This Module is not very practical because we hardcoded the latest news and the CSS to keep the example short.
- In WPLib we use the `the_` prefix to render output and the `_html` suffix to  generate _safe_ HTML output. More on that later.
- The leading underscore on `_LawPress_Latest_News` indicates we will not reference by name outside its own file.
- The call to `self::register_helper()` registers the class  `_LawPress_Latest_News` as a _**"Helper"**_, i.e. a class that adds its static methods to either the Application class `LawPress`. You'll see that in use next.
- The `@mixin` indicates to [**PhpStorm**](https://www.jetbrains.com/phpstorm/) _(if you are savvy enough to use it)_ that the `_LawPress_Latest_News` contributes its methods to the `LawPress` class. This step is not required for working code but does ease programming with WPLib.

<hr>
##NEXT: [Use the Simple Module in a Theme Template](/quick-start/use-the-simple-module-in-a-theme-template) 
##BACK: [Create a Theme Class](/quick-start/create-a-theme-class) 
##UP: [QuickStart](/quick-start) 
