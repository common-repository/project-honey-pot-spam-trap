=== Project Honey Pot Spam Trap ===
Contributors: awensley
Donate link: http://andrewensley.com/donate/
Tags: spam, anti-spam, link, links, embed, plugin, random, url, spambot, project-honey-pot, projecthoneypot, crawler, harvester, security, httpbl
Requires at least: 2.8
Tested up to: 3.1
Stable tag: 1.0.1

Automatically scatters invisible links to Project Honey Pot spam traps throughout your wordpress blog to help catch and stop spammers.

== Description ==

This plugin automatically scatters invisible links to [Project Honey Pot](http://www.projecthoneypot.org/) spam traps 
throughout your wordpress blog to help catch and stop spammers.

Project Honey Pot is the first and only distributed system for identifying spammers and the spambots they use 
to scrape addresses from your website. Using the Project Honey Pot system you can install addresses that are 
custom-tagged to the time and IP address of a visitor to your site. If one of these addresses begins receiving 
email Project Honey Pot not only can tell that the messages are spam, but also the exact moment when the address 
was harvested and the IP address that gathered it.

Install this plugin to help contribute to the project and catch spammers by hiding links to honey pots (spam traps)
in your blog.  The links are never visible to human visitors, but the spambots and crawlers follow them straight into
the traps.

Note: this plugin will not directly prevent spam on your site, but will help prevent spam for everyone by helping to catch the spammers.

If you also want to use the Project Honey Pot API to detect and block spammers from your site, try the [http:BL plugin](http://wordpress.org/extend/plugins/httpbl/).

== Installation ==

Follow these instructions to install the plugin.

1. [Install a honey pot on your site](http://www.projecthoneypot.org/manage_honey_pots.php) or get a [quick link](http://www.projecthoneypot.org/manage_quicklink.php)
2. Unzip the files from the download file
3. Upload the entire `project-honey-pot` folder to your `/wp-content/plugins/` directory
4. Activate the plugin through the 'Plugins' menu in WordPress
5. Go to the Project Honey Pot options page and enter at least one honey pot URL
6. Enjoy knowing that you are helping to make the world a better place

== Frequently Asked Questions ==

None yet

== Screenshots ==

1. The options page

== Upgrade Notice ==

= 1.0.1 =
* Fixed upgrade bug, gave images and links margin and padding of 0, and made sure this plugin's hook actions occur last.

== Changelog ==

= 1.0.1 =
* Fixed upgrade bug that caused saved settings to be overwritten.
* Fixed incorrect link on settings page.
* Gave images and links that weren't explicitly hidden margin and padding of 0.
* Gave this plugin's hooks last priority, which should hopefully ensure they are the last hooks to process content.

= 1.0.0 =
* Initial release

== Features ==

* Outputs randomly generated invisible links to honey pots in order to catch spambots
* Specify a locally installed honey pot, a quick link to someone else's honey pot, or both
* Check if the current visitor is listed in Project Honey Pot's [HTTP:BlackList](http://www.projecthoneypot.org/services_overview.php)
* Output links to all visitors or just those listed in the HTTP:BL
* Fully customize each location in which links are inserted

== License ==

This plugin is released under the [GPLv3](http://www.gnu.org/licenses/gpl-3.0.html) license and comes with ABSOLUTELY NO WARRANTY, to the extent permitted by applicable law.  I make no guarantee this plugin will work for you.

== Support ==

For support, please visit the [plugin page](http://andrewensley.com/projects/project-honey-pot-wordpress-plugin/)
