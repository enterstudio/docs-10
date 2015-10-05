#WPLib
##Modules
- Allows structuring of code

##Items 
- Wraps Models and Views
- Never use Model or View objects directly, always uses an Item object, except maybe within the View code itself.

###Method Name Prefix
####`the_` --> `echo`
- This prefix performs an `echo` on the model method with the name after stripping the prefix:
 
		$item = LawPress_Event();	// This is an Item wrapping $post_type='lp_event'
		$item->the_title();  		// echo esc_html( $this->title() )
		$item->the_title_html(); 	// echo wp_kses_post( $this->title() )

###Method Name Suffixes
####`_attr()` --> `esc_attr()`
- When `$item->the_data_attr()` is called the return of value of `$item->model->data()` is passed to `esc_attr()` and then `echo`ed.

#### `_url()` --> `esc_url()`
- When `$item->the_data_url()` is called the return of value of `$item->model->data()` is passed to `esc_url()` and then `echo`ed.

#### `_html()` --> `wp_kses_post()`
- When `$item->the_data_html()` is called the return of value of `$item->model->data()` is passed to `wp_kses_post()` and then `echo`ed.

#### n/a --> `esc_html()`
-  When `$item->the_data()` is called the return of value of `$item->model->data()` is passed to `esc_html()` and then `echo`ed.

##Models
- Define Models, don't use direct instances of them except maybe in the View class.

##Views
- Define View, don't use direct instances of them.

##Lists 
- Array-like object containing a list of items

		LawPress_Practice_Area::get_list()->the_template( 'practice-area-card' );
       	
        // The above is the same as the below
       
       	foreach( LawPress_Practice_Area::get_list() as $practice_area ) {
       
	       $practice_area->the_template( 'practice-area-card' );
        
       	}

##Helpers 
- Classes that allows adding of their static methods to WPLib, an app ora theme class.

		$solution_list = LawPress::get_event_list();
		
		// The above becomes possible with a helper class like below

		class LawPress_Events {
			static function on_load() {
				self::register_helper( __CLASS__, 'WPLib' );
			}
			static function get_event_list() {
				return static::get_list();
			}
		}
		LawPress_Events::on_load();


