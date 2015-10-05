#WP Launch Plan


##MVE

- Model
- View
- Entity

- List

##Auto-Escaping

##Auto-defined Properties & Methods
- `$name` - use this if a real property.
- `name()` - use this if a real method, is a virtual property.
- `get_name( $args )` methods - A (mathematical) function of $args
- `$name` - virtual properties - unless in a string, i.e. `"x{$this->name}?y"`.


##Mixins

##Helpers
- Goal: Single "global" "namespace" for a "function-like" API.
- Namespace=WPLib, or {App}

##Runmodes


##Modules

R2
Post / Page / Term / User / Comment
Image / Video/ Audio / Media Object
Shortcodes
Relationships
Cron

Page Builder
Social Actions
Caching
Person / Place / Event / Organization / Service Object
Support for Users, Comments and Taxonomy Terms
Forms / Fields
URL Routing
Email
Transient notice
Licensing
Upgrade Routines

Revision Tracking (Cache Busting)