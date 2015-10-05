<!--
Title: WPLib Overview
Description: This description will go in the meta description tag
Author: Mike Schinkel
Date: 2015/04/18
Template: front-page
-->
# WPLib Oveview
WPLib is a **Foundation Library** for use by agencies and internal development teams when building complex WordPress sites. 

WPLib allows coders to be build, maintain and evolve a WordPress site without the typical breakage that occurs when using the common theme development practices found in theming tutorials throughout the web.

##What is a "Foundation Library?"
WordPress defines both of the terms _"plugin"_ and _"theme"_, but WPLib is really neither of those. For WPLib we define a new term to describe it: _"Foundation Library"_  

But to define _Foundation Library_ let us first define plugin and theme as well as our own more fundamental term _"component"_ for contrast:

- _**Component**_ - A packaged collection of source code -- such as code packaged in a `.ZIP` file -- made available for others to use in their WordPress sites, plugins and themes. 
- **Plugin** - A component that provides extra functionality beyond WordPress itself. Plugins can be installed and configured by end-users and site-builders.
- **Theme** - A component that encapsulates a website's look and feel and includes but is not limited to layout, colors, fonts and  pages templates. Themes can be installed and configured by an end-user or a site-builder.

Thus a **Foundation Library** is a component used by a professional coder to form the basis of a website. It provides the base layer for both a site's theme and a site-specific plugin.



##The MVE Architecture Pattern
WPLib enables developers to follow a [software architecture pattern](http://en.wikipedia.org/wiki/Software_architecture#Architectural_styles_and_patterns) designed to allow coders to develop complex sites and/or applications on top of WordPress-as-a-Platform.

The pattern is similar to the well-known MVC pattern where "M" stands for **_Model_** and "V" stands for **_View_**.  

But instead of a **_Controller_** WPLIb uses an **_Entity_** which, for those steeped in pattern lore the entity, is most like a **_Facade_** pattern that delegates to either the Model or the View.

Thus WPLib is not a feature-rich library of WordPress functionality but is instead **simply code designed to make implementing the MVE pattern easy**.

##Entities
As mentioned, core to the WPLib architecture are **Entities**. Example entities handled by WPLib include, but are not limited to:

- Posts
- Taxonomy Terms
- Users
- Comments

WPLib provides base classes for each of these types of Entities, and has lower level classes that allow creation of more specific types of Entities.


##Design Principles
WPLib is opinionated and has explicit philosophy behind its design. Key principles include:

- **Compatibility** _with common WordPress coding practices, both forward and backward_

- **Strict Naming Conventions** _to reduce efforts required for naming and to maximize consistency within team development._

- **Prescriptive Code Patterns** _to reduce decisions about where code should reside and to enable the application of the [DRY principle](http://en.wikipedia.org/wiki/Don't_repeat_yourself)._

- **Automatic Sanitization** _to simplify templates and make it possible to ensure proper sanitization via Unit Testing._

- **Minimal Templates** _to make templates more readable and minimize duplication of logic that occurs when using common WordPress coding practices (for example: using `WP_Query` in a theme template is a WPLib [_anti-pattern_](http://en.wikipedia.org/wiki/Anti-pattern).)_



For details see [Design Principles](/design-principles).

