=== Very Simple Signup Form ===
Contributors: Guido07111975
Version: 1.2
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Requires at Least: 3.7
Tested up to: 4.1
Stable tag: trunk
Tags: simple, responsive, signup, signupform, subscribe, subscription, email, honeypot, captcha, widget, sidebar


== Changelog ==
Version 1.2
- adjusted plugin for use as widget only. The shortcode for displaying form on page is still supported, but do not use shortcode + widget.
- added translatable form subject
- updated language files

Version 1.0
- first stable release


== DESCRIPTION ==
This is a very simple responsive translation-ready Widget signup form. 

Now visitors of your website can signup for a meeting, event and more.

It only contains Name, Email and Phone. And a simple captcha sum. 

Use the widget to display form in sidebar.

This plugin has no settingspage: new signups will be send to you by mail only.

Dutch, German, French and Spanish translation included. 

For more info please check readme file.


== INSTALLATION == 
After installation go to Appearance > Widgets and add the widget to the sidebar.

The form uses email from admin (set in Settings > General).


== Frequently Asked Questions ==
= Can I still use the shortcode from version 1.0? =
In version 1.2 I have adjusted plugin for use as widget only, because a signup form is mostly displayed in a sidebar.

The shortcode for displaying form on page is still supported, but do not use shortcode + widget.

= Are signups listed in my dashboard? =
No, this plugin has no settingspage: new signups will be send to you by mail only.

= Why am I not receiving messages? =
1) Look also in your junk/spam folder.

2) Check info about installation and check shortcode for mistakes.

3) Messages are send using the wp-mail function, maybe your hostingprovider disabled the php mail function. Ask them to enable it. 

= Is my language supported too? =
All UTF-8 characters are allowed, so many languages are supported.
But the plugin itself is only translated in several languages. 

= Is this plugin protected against spammers, bots, etc? =
The default WordPress sanitization function is included.

For email field:

http://codex.wordpress.org/Function_Reference/sanitize_email

For other fields:

http://codex.wordpress.org/Function_Reference/sanitize_text_field

It also contains honeypot fields and a simple captcha sum.

= Other question or comment? =
Please open a topic in plugin forum or send me a message via my website.


== Screenshots == 
1. Very Simple Signup Form in frontend (using Twenty Fourteen theme).

2. Very Simple Signup Form in frontend (using Twenty Fourteen theme).


== OTHER NOTES ==
Very Simple Signup Form is based on my other plugin: Very Simple Contact Form.

This plugin is translation-ready (Dutch, German, French and Spanish translation included). 

More translations are very welcome! Please contact me via my website.

You can translate this into your own language using for example plugin Codestyling Localization: 

http://wordpress.org/plugins/codestyling-localization/


== CREDITS ==
Without the WordPress codex and help from the WordPress community I was not able to develop this plugin, so: thank you!

I used this scripts for developing the Very Simple Signup Form:

http://code.tutsplus.com/articles/creating-a-simple-contact-form-for-simple-needs--wp-27893

http://code.tutsplus.com/articles/building-custom-wordpress-widgets--wp-25241

These scripts are released under the GNU General Public License v3 or later


Enjoy,
Guido