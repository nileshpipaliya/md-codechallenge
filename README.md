# WP Profile Listing

This plugin registers a single custom post type named "Profile" along with two taxonomies: "Skills" and "Education." Additionally, it provides the functionality to assign metadata to individual profile records.

## Installation

This section describes how to install the plugin and get it working.

e.g.

1. Upload `wp-profile-listing` plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
3. To add the Profile post type, include details such as skills, education, and metadata within custom fields.
4. To showcase profile listings on the front-end of your website, simply employ the [profiles] shortcode.

## Usage

To display the profile listing page with search and sorting functionality, add the [profiles] shortcode to any page or post. This shortcode supports various parameters for filtering and sorting the profiles:

## Search Filters

The profile listing page allows users to search and filter the profiles based on the following search parameters:

- `Keyword` - Filters profiles based on the name.
- `Skills` - Filters profiles based on selected skills.
- `Education` - Filters profiles based on selected education.
- `Age Range` - Filters profiles based on age range.
- `Ratings` - Filters profiles based on selected ratings.
- `No of jobs competed` - Filters profiles based on number of jobs completed.
- `Years of experience` - Filters profiles based on years of experience.
- `Sorting` - Sorts profiles based on name in ascending or descending order.

## License

This plugin is released under the [GPLv2](http://www.gnu.org/licenses/gpl-2.0.html) or later license.
