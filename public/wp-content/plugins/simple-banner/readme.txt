=== Simple Banner - Easily add multiple Banners/Bars/Notifications/Announcements to the top or bottom of your website ===
Contributors: rpetersen29
Donate link: https://www.paypal.me/rpetersenDev
Tags: banner, bar, announcement, notification, notice
Requires at least: 3.0.1
Tested up to: 6.9.0
Stable tag: 3.1.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Display a simple banner/bar at the top or bottom of your website. Now with multi-banner support.

== Description ==

This plugin makes it easy to display a simple announcement banner or bar at the top of your website. You can easily customize the color of the links, text, and background of the bar from within the settings. You can also customize to your heart's desire by adding your own custom CSS. There's also a fancy preview section within the settings so you can see your changes before you save them.

= Now with multi-banner support =
With Pro features you can display up to 5 separate banners on your site. Banners can be shown simultaneously or plan weeks of banners by showing them consecutively. 

== Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins > Add New'
2. Search for 'Simple Banner'
3. Activate 'Simple Banner' from your Plugins page.
4. Visit 'Simple Banner' in the sidebar to create a new banner.

= From WordPress.org =

1. Download 'Simple Banner'.
2. Upload the 'simple-banner' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
3. Activate 'Simple Banner' from your Plugins page.
4. Visit 'Simple Banner' in the sidebar to create a new banner.

== Frequently Asked Questions ==

= What does the banner look like in my DOM? =

This is how the banner will look in your HTML:

`<code>
    <div id="simple-banner" class="simple-banner">
      <div class="simple-banner-text">
        <span>
          YOUR SIMPLE BANNER TEXT HERE
        </span>
      </div>
    </div>
</code>
`

= The banner or changes to the banner aren't showing up, or are only showing up when I'm logged in, what's wrong? =

Your browser frequently caches scripts associated with a website in order to improve speed and performance. There are also some
wordpress plugins that cache scripts to improve performance. If you aren't seeing your banner or the changes you made to the banner,
first clear your browser cache and if that doesn't work, look for any plugin that bundles or caches scripts and clear that as well.

= Why is my banner covering my header or behind my header? =

Your theme probably uses absolute positioning for its header in this case. Try changing the positioning of your banner or change "Prepend element" to <code><header></code> and see if that helps. If none of this works, you may need a custom solution for your banner. You can either try to find another plugin that suits your needs or you can purchase the pro version and open a support ticket to fix your situation.

= Is there a Pro version? =

Yes, but you should look through the support topics before you decide if you need the pro version.

= Does this plugin use cookies? =

Yes, they are used only if you enable the close button. These cookies fall under the category of "strictly necessary cookies" and do not need consent from the user, more information <a target="_blank" href="https://gdpr.eu/cookies/">here</a>. 
If cookies are disabled on the user's browser, the banners close button expiration setting will not work and the banner will show on each refresh.

= How do I re-enable my banner after I hit the close button =

You can clear your browser's cookies or in the browser's console you can execute:

`document.cookie = "simplebannerclosed=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
`

You can also set your Close button expiration to blank, 0, or a date in the past. This method may require a refresh or two of the browser on your website page.

= I have the Divi theme and the banner isn't showing. =

Try setting the "Prepend element" setting to <code>header</code>. If that doesn't work, set your banner position to <code>relative</code> and try this in 'Website Custom CSS':

`#main-header:not(.et-fixed-header) {
  position: relative;
}`
`#top-header:not(.et-fixed-header) {
  position: relative;
}`

== Screenshots ==

1. This is the first screen shot.
2. This is the second screen shot.
3. This is the third screen shot.
4. This is the settings page... and the fourth screen shot.
4. This is the fifth screen shot.

== Changelog ==

= 3.1.3 =
* Test against wp 6.9.0

= 3.1.2 =
* Bug fixes

= 3.1.1 =
* Bug fixes

= 3.1.0 =
* New visual updates

= 3.0.10 =
* Bug fixes, test against wp 6.8.2

= 3.0.9 =
* Bug fixes

= 3.0.8 =
* Test against wp 6.8.1, style changes

= 3.0.7 =
* Test against wp 6.8.0, minor bugfix

= 3.0.6 =
* Clear caches on settings save

= 3.0.5 =
* Test against wp 6.7.2, minor bugfixes

= 3.0.4 =
* Test against wp 6.7.1, minor bugfixes

= 3.0.3 =
* Add back wp_body_open

= 3.0.2 =
* False text bug fix

= 3.0.1 =
* Bug fix, check for undefined

= 3.0.0 =
* New multi-banner feature, removed support for wp_body_open

= 2.17.4 =
* tested to WP 6.6.1

= 2.17.3 =
* Bug fixes

= 2.17.2 =
* Bug fixes

= 2.17.1 =
* Fix relative paths in preview banner, tested to WP 6.5

= 2.17.0 =
* New disabled page paths feature

= 2.16.0 =
* New prepend element feature

= 2.15.4 =
* Bug fixes

= 2.15.3 =
* New start after date feature

= 2.15.2 =
* z-index now configurable

= 2.15.1 =
* Aria label on close button, addEventListener instead of onscroll

= 2.15.0 =
* New insert inside element feature

= 2.14.2 =
* More bug fixes

= 2.14.1 =
* Bug fix

= 2.14.0 =
* Wordpress 6.2 support, close button expiration supports fractional days, new remove after date feature

= 2.13.3 =
* Even more bug fixes

= 2.13.2 =
* More bug fixes

= 2.13.1 =
* Bug fixes

= 2.13.0 =
* New pro version payment system

= 2.12.3 =
* Support for WPML/Polylang

= 2.12.2 =
* Support for WP 6.1

= 2.12.1 =
* Bug fix

= 2.12.0 =
* Security improvements

= 2.11.0 =
* New feature: ability to change expiration date by specific time

= 2.10.9 =
* Bug fix in preview banner.

= 2.10.8 =
* Fix security bug in admin panel.

= 2.10.7 =
* Bug fix for XSS.

= 2.10.6 =
* Bug fix for console error.

= 2.10.5 =
* Bug fixes & improvements.

= 2.10.4 =
* More changes to stop scammers.

= 2.10.3 =
* Change to stop scam security sites from emailing me.

= 2.10.2 =
* Bug fixes for sites with no `administrator` role.

= 2.10.1 =
* Bug fixes. Remove some unnecessary script params.

= 2.10.0 =
* Bug fixes for disabled pages checkboxes, added experimental feature to disable banner on posts.

= 2.9.4 =
* Bug fixes for disabled pages array.

= 2.9.3 =
* Bug fixes for disabled pages.

= 2.9.2 =
* Bug fixes and added close button color setting.

= 2.9.1 =
* Bug fixes and additional variables added to debug mode.

= 2.9.0 =
* Added close button and settings.
* Add `.simple-banner-button` class to allow custom close button styles.
* Preview banner now scrolls with you down the page.
* Updated documentation regarding cookies.
* Other bug fixes.

= 2.8.0 =
* Add `.simple-banner-text` class to allow custom text styles. Removed text from page source code when disabled.

= 2.7.0 =
* Add `.simple-banner-scrolling` class to allow custom scrolling styles.

= 2.6.0 =
* Add option to use Wordpress action `wp_open_body` for banner insertion.

= 2.5.0 =
* Added Font Size option, changed layout for better preview banner visibility.

= 2.4.7 =
* Fix bug to permissions removal.

= 2.4.6 =
* Banner now shows in sidebar upon activation.

= 2.4.5 =
* Fix permissions clearout method.

= 2.4.4 =
* Fix php error.

= 2.4.3 =
* Fix bug for that hid banner on pages with no id, fix some permissions issues.

= 2.4.2 =
* Disable header margin/padding when banner is hidden or disabled, fixed homepage disabling bug, added option to keep/remove custom css/js when disabled or hidden.

= 2.4.1 =
* PHP warning fix.

= 2.4.0 =
* Added some new fields (hiding, position, and header top margin/padding) to help with banner customization.

= 2.3.0 =
* Added permissions adding and updated documentation.

= 2.2.3 =
* CSS Changes.

= 2.2.2 =
* Added version number to css and js file to force update on version change.

= 2.2.1 =
* Removed addslashes version of text now that message is handled via js.

= 2.2.0 =
* Optimized scripts for loading banner, added debug mode for troubleshooting.

= 2.1.3 =
* Change pro version payment link again.

= 2.1.2 =
* Change pro version payment link.

= 2.1.1 =
* Add jQuery back for compatibility issues.

= 2.1.0 =
* Removed jQuery dependency from project.

= 2.0.7 =
* Fixed settings page bugs, tested to Wordpress v5.0.2.

= 2.0.6 =
* Fixed script bug.

= 2.0.5 =
* Fixed svn repo files.

= 2.0.4 =
* Fix bug with banner text newlines.

= 2.0.3 =
* Update Donate button color.

= 2.0.2 =
* Fixed script loading bug again.

= 2.0.1 =
* Fixed script loading bug.

= 2.0.0 =
* Added Pro version features.

= 1.4.1 =
* Fix bugs with preview banner onchange events and escape attributes with Simple Banner Text instead of converting to html codes.

= 1.4.0 =
* Added Donate button, small settings page CSS tweaks.

= 1.3.0 =
* You can now use single quotes or double quotes for Simple Banner Text.

= 1.2.1 =
* Rollback use of esc_attr() with banner text for now as it broke all links from showing properly.

= 1.2.0 =
* Improve code structure for preview banner, add inner html preview. Banner text uses esc_attr().

= 1.1.0 =
* Add text to show scoping of custom CSS.

= 1.0.5 =
* Tested on recent Wordpress versions

= 1.0.4 =
* Removed CSS that caused banner to disappear on screens less than 900px wide.

= 1.0.3 =
* Fix for themes with padding and margin applied to body.

= 1.0.2 =
* Fixed banner for themes that don't already have jquery added.

= 1.0.1 =
* Fixed readme and added logo.

= 1.0.0 =
* First Version.

== Upgrade Notice ==

= 3.1.3 =
* Test against wp 6.9.0

= 3.1.2 =
* Bug fixes

= 3.1.1 =
* Bug fixes

= 3.1.0 =
* New visual updates

= 3.0.10 =
* Bug fixes, test against wp 6.8.2

= 3.0.9 =
* Bug fixes

= 3.0.8 =
* Test against wp 6.8.1, style changes

= 3.0.7 =
* Test against wp 6.8.0, minor bugfix

= 3.0.6 =
* Clear caches on settings save

= 3.0.5 =
* Test against wp 6.7.2, minor bugfixes

= 3.0.4 =
* Test against wp 6.7.1, minor bugfixes

= 3.0.3 =
* Add back wp_body_open

= 3.0.2 =
* False text bug fix

= 3.0.1 =
* Bug fix, check for undefined

= 3.0.0 =
* New multi-banner feature, removed support for wp_body_open

= 2.17.4 =
* tested to WP 6.6.1

= 2.17.3 =
* Bug fixes

= 2.17.2 =
* Bug fixes

= 2.17.1 =
* Fix relative paths in preview banner, tested to WP 6.5

= 2.17.0 =
* New disabled page paths feature

= 2.16.0 =
* New prepend element feature

= 2.15.4 =
* Bug fixes

= 2.15.3 =
* New start after date feature

= 2.15.2 =
* z-index now configurable

= 2.15.1 =
* Aria label on close button, addEventListener instead of onscroll

= 2.15.0 =
* New insert inside element feature

= 2.14.2 =
* More bug fixes

= 2.14.1 =
* Bug fix

= 2.14.0 =
* Wordpress 6.2 support, close button expiration supports fractional days, new remove after date feature

= 2.13.3 =
* Even more bug fixes

= 2.13.2 =
* More bug fixes

= 2.13.1 =
* Bug fixes

= 2.13.0 =
* New pro version payment system

= 2.12.3 =
* Support for WPML/Polylang

= 2.12.2 =
* Support for WP 6.1

= 2.12.1 =
* Bug fix

= 2.12.0 =
* Security improvements

= 2.11.0 =
* New feature: ability to change expiration date by specific time

= 2.10.9 =
* Bug fix in preview banner.

= 2.10.8 =
* Fix security bug in admin panel.

= 2.10.7 =
* Bug fix for XSS.

= 2.10.6 =
* Bug fix for console error.

= 2.10.5 =
* Bug fixes & improvements.

= 2.10.4 =
* More changes to stop scammers.

= 2.10.3 =
* Change to stop scam security sites from emailing me.

= 2.10.2 =
* Bug fixes for sites with no `administrator` role.

= 2.10.1 =
* Bug fixes. Remove some unnecessary script params.

= 2.10.0 =
* Bug fixes for disabled pages checkboxes, added experimental feature to disable banner on posts.

= 2.9.4 =
* Bug fixes for disabled pages array.

= 2.9.3 =
* Bug fixes for disabled pages.

= 2.9.2 =
* Bug fixes and added close button color setting.

= 2.9.1 =
* Bug fixes and additional variables added to debug mode.

= 2.9.0 =
* Added close button and settings.
* Add `.simple-banner-button` class to allow custom close button styles.
* Preview banner now scrolls with you down the page.
* Updated documentation regarding cookies.
* Other bug fixes.

= 2.8.0 =
* Add `.simple-banner-text` class to allow custom text styles. Removed text from page source code when disabled.

= 2.7.0 =
* Add `.simple-banner-scrolling` class to allow custom scrolling styles.

= 2.6.0 =
* Add option to use Wordpress action `wp_open_body` for banner insertion.

= 2.5.0 =
* Added Font Size option, changed layout for better preview banner visibility.

= 2.4.7 =
* Fix bug to permissions removal.

= 2.4.6 =
* Banner now shows in sidebar upon activation.

= 2.4.5 =
* Fix permissions clearout method.

= 2.4.4 =
* Fix php error.

= 2.4.3 =
* Fix bug for that hid banner on pages with no id, fix some permissions issues.
*
= 2.4.2 =
* Disable header margin/padding when banner is hidden or disabled, fixed homepage disabling bug, added option to keep/remove custom css/js when disabled or hidden.

= 2.4.1 =
* PHP warning fix.

= 2.4.0 =
* Added some new fields (hiding, position, and header top margin/padding) to help with banner customization.

= 2.3.0 =
* Added permissions adding and updated documentation.

= 2.2.3 =
* CSS Changes.

= 2.2.2 =
Added version number to css and js file to force update on version change.

= 2.2.1 =
Removed addslashes version of text now that message is handled via js.

= 2.2.0 =
Optimized scripts for loading banner, added debug mode for troubleshooting.

= 2.1.2 =
Changed pro version payment link again.

= 2.1.2 =
Changed pro version payment link.

= 2.1.1 =
Added jQuery back for compatibility issues.

= 2.1.0 =
Removed jQuery dependency from project.

= 2.0.7 =
Bug fixes for settings page.

= 2.0.6 =
Bug fixes for script.

= 2.0.5 =
Repo fixes.

= 2.0.4 =
Bug fixes for scripts.

= 2.0.4 =
Bug fixes for banner text.

= 2.0.3 =
Update Donate button color.

= 2.0.2 =
Bug fixes for pro version.

= 2.0.1 =
Bug fixes with script load.

= 2.0.0 =
Added Pro version features.

= 1.4.1 =
Fix preview banner bugs, Simple Banner can accept all formats.

= 1.4.0 =
Add Donate button and change some form CSS.

= 1.3.0 =
Replace double quotes with single quotes in Simple Banner Text.

= 1.2.1 =
Bug fix with links.

= 1.2.0 =
You can now preview text in the preview banner up top.

= 1.1.0 =
Added ".simple-banner { }" around Simple Banner Custom CSS to show that custom CSS is scoped to the banner and hopefully eliminate some support issues about custom CSS. No functionality changes.

= 1.0.5 =
No code changes.

= 1.0.4 =
Now showing on mobile for most popular themes.

= 1.0.3 =
Additional fixes for more themes, specifically "Twenty *" themes by Wordpress.

= 1.0.2 =
If your banner didn't work before, it probably does now.

= 1.0.1 =
Just updated some stuff for the readme. No functionality change.

= 1.0.0 =
This is the first version.
