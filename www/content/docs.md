<!--
Title: WPLib Documentation
Description: The PHP-based Classes provided by WPLib
Author: Mike Schinkel
Date: 2015/04/22
-->

#WPLib Documentation
<hr>
##Application-Level Classes
These are the types of application-level classes that are of concern to end users because they should expose functionality that end-users are interested in.

###Post Classes
For WordPress standard and custom post types. 

Examples include `WPLib_Post` and `WPLib_Page` which wrap and extend the `WP_Post` for `$post_type='post'` and `$post_type='page'`, respectively.

###Term Classes
For WordPress terms of standard and custom taxonomies.

Examples include `WPLib_Category_Term` and `WPLib_Post_Tag_Term` which wrap and extend the WordPress Term `object` for `$taxonomy='category'` and `$taxonomy='post_tag'`, respectively.

###User Classes
For WordPress users of different standard and custom roles.

###Archive Page Classes
For Archive Pages so they can be treated on peer with other Pages.

<hr>
##Foundation Level Classes
These are the core level classes that comprise the core architecture of WPLib.

###Model Classes
Classes containing properties and methods of posts, terms, users, etc.

###View Classes
Classes containing output methods for posts, terms, users, etc.

###Entity Classes
Wrapper classes for Models and Views that allow instantiating a single class.

###List Classes
Collection classes that contain Entities and/or other object types. List classes _effectively_ extend [ArrayObject](http://php.net/manual/en/class.arrayobject.php) _(although WPLib implements the same interfaces instead of actually extending ArrayObject.)_

###Cache Classes
Named classes that encapsulate a persistently-cached set of data.

###Shortcode Classes
Yeah, of course.

