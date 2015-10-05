# Install WPLib

First install WPLib as a [**Must-Use Plugin**](http://gregrickaby.com/create-mu-plugin-for-wordpress/):


1. Go to your WordPress **Site's content folder**.
	- For example: `~/Sites/LawPress/www/wp-content/` 
1. Create a **Must-Use Plugin folder** if one does not already exist:
	- For example: `~/Sites/LawPress/www/wp-content/mu-plugins/`
1. Install WPLib **into a subfolder** <sup>**[+]**</sup> within the Must-Use Plugin Library:
	- **Download** WPLib as a `.zip` file from [**here**](https://github.com/wplib/wplib/archive/master.zip). 
	- **Unzip** into a WPLib folder inside your Must-Use Plugins folder:
		- For example: `~/Sites/LawPress/www/wp-content/mu-plugins/wplib/`
	- <sup>**[+]**</sup> If you are familiar with GIT you can **clone** [**the Git repository**](https://github.com/wplib/wplib.git) instead of downloading and unzipping the `.zip` file.
1. **Create a loader file** inside your Must-Use Plugins folder:
	- For example: `~/Sites/LawPress/www/wp-content/mu-plugins/plugin-loader.php`
	- Add this code to `plugin-loader.php`:

	```php
	<?php
	/**
	 * Plugin Name: Plugin Loader
	 */
	require __DIR__ . '/wplib/wplib.php';
	```

	
1. WPLib is now installed for your site.
	- You should test your site to make sure it loads without breaking, though you will not see any changes yet.


## _What Did We Just Do?_
- We added WPLib as a Must-Use plugin so it will always be available on every page load. 

- We could also have installed as a regular plugin where it would need to be activated -- which makes little sense given that WPLib will become a requirement for your site to operate correctly -- or included in a theme, if you don't have access to the plugin directories such as on some managed multi-site implementations.

**Note:** The name `plugin-loader.php` is arbitrary, so you could use whatever name you like. But as WPLib places a high value on consistency, we hope you will use the same name.

<hr>
##NEXT: [Create an Application](/quick-start/create-an-application) 
##UP: [QuickStart](/quick-start) 
