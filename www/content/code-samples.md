<!--
Title: WPLib Code Samples
Description: This description will go in the meta description tag
Author: Mike Schinkel
Date: 2015/04/18
-->
# WPLib Code Samples

```php
while (have_posts()) {
    the_post();
    <h1><?php the_title(); ?></h1>
}

// single-school.php
$school = new ESPN_School( $post );
<h1><?php $school->the_name(); ?></h1>
$players = $school->get_player_list();
foreach( $players as $player ) {
    <h2><?php $player->the_fullname(); ?></h2>
}
```



	while (have_posts()) {
    	the_post();
	    <h1><?php the_title(); ?></h1>
	}
