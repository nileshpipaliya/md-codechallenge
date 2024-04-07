=== Plugin Name ===
Plugin Name: WP Profile Listing
Author : Nilesh Pipaliya
Author URI: https://github.com/nileshpipaliya
Contributors: https://profiles.wordpress.org/nileshpipaliya/
Requires at least: 3.0.1
Tested up to: 6.5
Stable tag: 0.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin for multidots assignment. a plugin that gives a page with a list of profiles the ability to search and sort.

== Description ==

"Profile Listing Page" is a custom WordPress plugin designed to facilitate the creation of a profile listing page with search and sorting capabilities on the front end of your WordPress website. 

This plugin registers a single custom post type named "Profile" along with two taxonomies: "Skills" and "Education." Additionally, it provides the functionality to assign metadata to individual profile records.


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-profile-listing` plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
3. To add the Profile post type, include details such as skills, education, and metadata within custom fields.
4. To showcase profile listings on the front-end of your website, simply employ the [profiles] shortcode.

== Usage ==

To display the profile listing page with search and sorting functionality, add the [profiles] shortcode to any page or post. This shortcode supports various parameters for filtering and sorting the profiles:

- `Keyword` - Filters profiles based on the name.
- `Skills` - Filters profiles based on selected skills.
- `Education` - Filters profiles based on selected education.
- `Age Range` - Filters profiles based on age range.
- `Ratings` - Filters profiles based on selected ratings.
- `No of jobs competed` - Filters profiles based on number of jobs completed.
- `Years of experience` - Filters profiles based on years of experience.
- `Sorting` - Sorts profiles based on name in ascending or descending order.

== Changelog ==

= 1.0 =
* Initial release of the plugin.
