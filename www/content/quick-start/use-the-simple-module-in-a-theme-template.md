#Use the Simple Module in a Theme Template 
Now let's add the banner to every page in your site's theme.

1. Open your theme's `header.php` and add the following code to the end of the file _(assumes the end of the file is in HTML context, not PHP context):_
    
    ```php
	<?php LawPress::the_latest_news_html(); ?>
	```
	
1. You now should have a red _"Latest News"_ header on every page of your website.
	- You now have **something you can view** on your site. Test it!

### _What Did We Just Do?_
We added a white on red banner to be displayed at the top of every page on your site.

####Notes:
- Calling `the_latest_news_html()` using `LawPress` instead of `_LawPress_Latest_News` was made possible by the _**Helper**_ functionality in WPLib. 
- This Helper functionality allows you to build large Applications with your code in a well-organized set of files but it makes it much easier for your themers to learn your API since they only need to learn the method names and not all the class names.


<hr>
##NEXT: More Coming Soon...
##BACK: [Create a Simple Module](/quick-start/create-a-simple-module) 
##UP: [QuickStart](/quick-start) 
