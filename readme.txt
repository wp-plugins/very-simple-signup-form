=== Very Simple Signup Form ===
Contributors: Guido07111975
Version: 1.0
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Requires at Least: 3.7
Tested up to: 4.1
Stable tag: trunk
Tags: simple, responsive, signup, signupform, subscribe, subscription, email, honeypot, captcha, widget


== Changelog ==
Version 1.0
- first stable release


== DESCRIPTION ==
This is a very simple responsive translation-ready signup form. 

It only contains Name, Email and Phone. And a simple captcha sum. 

Use shortcode [signup] to display form on page or use the widget to display form in sidebar. 

Dutch, German, French and Spanish translation included. 

For more info please check readme file.


== INSTALLATION == 
After installation please add shortcode [signup] on your signup page for displaying the form. 

In this case messages will be send to email from admin (Settings > General).

If you want to use another email, use shortcode [signup email_to="your-email-here"].

And if you want to use multiple email, use shortcode [signup email_to="first-email-here, second-email-here"].

Note: the sidebar widget uses shortcode [signup].


== Frequently Asked Questions ==
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