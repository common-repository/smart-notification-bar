=== Smart Notification Bar ===

Plugin Name: Smart Notification Bar
Plugin URI: https://smartnotificationbar.com/
Description: The easiest way to display smart notifications for your visitors to boost sales or display important information
Author: Ferenc Forgacs
Contributors: ferkho
Author URI: https://ecommerce-platforms.com/
Requires at least: 5.0
Tested up to: 6.0.0
Stable tag: 1.0.0
Version: 1.0.0
Requires PHP: 5.6.20
Text Domain: smart_notification_bar
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

# Show the right message to the right visitors and grow your business

Smart Notification Bar can help you to easily target your visitors with the best message to drive more sales and grow engagement.
Display a message to visitors who came from Facebook, Google, an email campaign, an ad campaign, and much more.

## Display a notification bar on your whole site or only on some of your pages

With it’s targeting features, Smart Notification Bar makes it possible to display a notification bar on your whole website or only on some defined pages. This makes it easy to display product realted information, discounts, and other useful messages.

## Target visitors who came from Google, Facebook, an email campaign and more

Smart Notification Bar can recognize the source channel of your visitors. You can use this feature to display a targeted message to those who came from a defined source. Source recognition is highly customizable, which makes it possible to target any of your visitors.

## Drive your visitors to the right direction with an animated call to action button

Besides text content, you can display a call to action button in your notification bar. To grab the attention of your visitors set an animation to your button. You can also choose from different layouts. Emojis are also supported to help you make your content “pop”.

## Customize the look and feel of your notification bar with custom backgrounds

With the built-in colorpicker you can easily find the right color combination for your notification bar. When a color is not enough, you can also use a background image. You can control not just the background but all the color settings for every part of your notification bar.

## Target mobile devices or display your message only on desktop

The space on mobile is limited and sometimes its hard to find the right message that works both on mobile and desktop. With Smart Notification Bar you don’t have to worry about this as you have the option to display the notification bar only on mobile, desktop or both.

## Move faster with the help of the built-in notification bar templates

When you don't want to spend too much time designing your notification bar, you have the option to choose one from the built-in simple and holiday templates.

## Guides

* [Display free shipping information for your visitors in a notification bar](https://smartnotificationbar.com/free-shipping-notification-bar.html)
* [Show great deals for your visitors in a notification bar](https://smartnotificationbar.com/sales-information-in-notification-bar.html)
* [Highlight limited time offers in a notification bar](https://smartnotificationbar.com/limited-time-offers-displayed-in-a-notification-bar.html)
* [Grow your conversion rate from search by surprising your visitors with a discount code](https://smartnotificationbar.com/grow-your-conversion-rate-from-search-by-surprising-your-visitors-with-a-discount-code.html)

== Installation ==

Use the automatic installation process via your WordPress admin or follow these steps to add Smart Notification Bar to your website:

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. After you activated the plugin, a new section will become visible at the navigation of your WordPress admin, called 🔔 Notification Bars
4. Click on that and create your first Smart Notification Bar

== Frequently Asked Questions ==

= Can I have multiple active Notification Bars on my website? =

Yes, you can. If you have multiple active notification bars on your website, the plugin will go through to following order to display the correct one to your visitors:

* detect the visitor's device (desktop or mobile)
* check the referrer information (is a user came from Facebook, Google)
* check the parameters in the URL to identify unique sources
* check if the notification bar is allowed to be visible on the page the user visited
* check if the user closed the notification bar previously

If multiple notification bars match all the criteria checked above, the plugin will display the one that is the newest.

= The notification bar is not showing up on my website. What could be the problem? =

If the notification bar shows in preview but not in the live site after you have verified its Visibility settings, please check your CDN or caching plugins, as changing settings or purging caches will almost always fix the problem.

If you can't see your notification bar on your website, check the following things:

* make sure that your notification bar is active and the "visible from" and "visible to" dates are correct
* check that the notification bar is allowed to be displayed on desktop or mobile
* check the targeting options of your notification bar (display for every visitor or only to those who came from a specific source)
* if you are targeting your notification bar to visitors who came from a specific source make sure that you test it with the right parameters or by visiting your website from the defined source
* check if you selected to keep the notification bar hidden after someone closed it
* if you use a cache plugin (like WP Rocket, WP Super Cache, W3 Total Cache, etc) make sure that you clear your cache after you enabled a notification bar (if you are using parameters to display a notification bar for your visitors, in some cases you also have to manually disable caching based on [query strings](https://docs.wp-rocket.me/article/971-caching-query-strings))

If all of these settings seem to be fine, it's also possible that your notification bar is not compatible with your theme. Feel free to get in touch if you experience an issue like that.

= How can I update the plugin? =

When a new version of the plugin becomes available, you'll see a notification about it at the administration area of your WordPress site. Then, you can update it the same way you do with other plugins. Make sure you create a backup of your files and database before the update. If you have any troubles during the update, feel free to get in touch.

= Is Smart Notification Bar working on mobile? =

Yes. The plugin was built with a mobile first approach and is working perfectly both on desktop and mobile devices.

= Is Smart Notification Bar AdBlock safe? =

Yes. All parts of your notification bars are AdBlock safe.

= Is Smart Notification Bar GDPR ready? =

Yes. The plugin is not collecting any user information and only using cookies that are essential to make it work properly.

= What happens if I remove the plugin from my site? =

If you remove the plugin from your site, all notification bars will be removed from the database right after you removed the plugin so none of them will show up on your site anymore.

= I accidentally deleted the plugin. Can I restore the notificaiton bars somehow? =

If you have a backup from your database you can try to revert your site to the state where the plugin was still installed. If you don't have a backup, get in touch with your hosting provider, they probably have a security backup.

= I accidentally deleted a notification bar. Can I restore it somehow? =

No, the notification bar and its settings got removed from the database when you confirmed the delete request.

= Can I change the design of the notification bar? =

Yes, you have several options to [change the look and feel](https://smartnotificationbar.com/customize-the-look-and-feel-of-your-notification-bar-with-custom-backgrounds.html) of your notification bar.

== Screenshots ==

1. Preview on desktop
2. Preview on mobile
3. General settings
4. Schedule settings
5. Content settings
6. Design settings
7. Notification Bar templates
8. Position settings
9. Call to action button settings
10. Button animation options
11. Close button settings
12. Targeting options
13. Additional targeting options

== Upgrade Notice ==


== Changelog ==

= 1.0 =
* Initial release