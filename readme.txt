=== Very Simple Signup Form ===
Contributors: Guido07111975
Version: 1.9
License: GNU General Public License v3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Requires at least: 3.7
Tested up to: 4.2
Stable tag: trunk
Tags: simple, responsive, signup, signupform, subscribe, subscription, event, meeting, email, honeypot, captcha, widget, sidebar, custom, style, css, editor


== Changelog ==
Version 1.9
- updated language files

Version 1.8
- several small adjustments
- updated language files 

Version 1.7
- adjusted the email headers to avoid messages go directly in junk/spam folder: added Reply-To and Return-Path
- renamed vssf_sanitize_text_field into vssf_sanitize_text_area
- updated language files

Version 1.6
- removed 'extract' from file vssf_main
- adjusted code in file vssf_main
- cleaned up code in file vssf_style

Version 1.5
- major update
- cleaned up code in file vssf_main
- added Custom Style editor: you can change the layout (CSS) of your form using the custom style page in WP dashboard
- linebreaks in textarea field are allowed now
- updated language files 

Version 1.4
- form will now use theme styling for input fields and submit button. If not supported in your theme you can activate plugin styling in file vssf_style.

Version 1.3
- replaced all divs with paragraph tags for better form display

Version 1.2
- added translatable form subject
- updated language files

Version 1.1
- adjusted plugin for use as widget only. The shortcode for displaying form on page is still supported. Do not use shortcode + widget because this may cause a conflict.
- updated language files

Version 1.0
- first stable release


== Description ==
This is a very simple responsive translation-ready signup form. 

Now visitors of your website can signup for a meeting, event and more.

It only contains Name, Email and Phone. And a simple captcha sum. 

Use the widget to display form in sidebar.

This plugin has no settingspage: new signups will be send to you by mail only.

You can change the layout (CSS) of your form using the custom style page in WP dashboard.

Question? Please take a look at the FAQ section.


= Translation =
Dutch, German, French and Spanish translation included. More translations are very welcome! Please contact me via my website.

= Credits =
Without the WordPress codex and help from the WordPress community I was not able to develop this plugin, so: thank you!

I have used these tutorials for developing the Very Simple Signup Form:

http://code.tutsplus.com/articles/creating-a-simple-contact-form-for-simple-needs--wp-27893

http://code.tutsplus.com/articles/building-custom-wordpress-widgets--wp-25241

These tutorials are released under the GNU General Public License v3 or later

Enjoy,
Guido


== Installation == 
After installation go to Appearance > Widgets and add the widget to your sidebar.

The form uses email from admin (set in Settings > General).


== Frequently Asked Questions ==
= I don't like the form layout, how can I change this? =
Form will use theme styling for input fields and submit button. 

Custom Style editor included: you can change the layout (CSS) of your form using the custom style page in WP dashboard. Max. 2000 characters allowed.

= Can I still use the shortcode from version 1.0? =
In version 1.1 I have adjusted plugin for use as widget only, because a signup form is mostly displayed in a sidebar.

The shortcode for displaying form on page is still supported. Do not use shortcode + widget because this may cause a conflict.

= Are signups listed in my dashboard? =
No, this plugin has no settingspage: new signups will be send to you by mail only.

= Why am I not receiving messages? =
1) Look also in your junk/spam folder.

2) Check info about installation and check shortcode for mistakes.

3) Install a contactform plugin (such as Contact Form 7) to determine if it's caused by Very Simple Signup Form or something else.

4) Messages are send using the wp_mail function (similar to php mail function). Maybe your hostingprovider disabled the php mail function, ask them to enable it. 

= Is my language supported too? =
You can enter all UTF-8 characters, so many languages are supported. But the plugin itself is only translated in several languages. 

= Is this plugin protected against spammers, bots, etc? =
The default WordPress sanitization function is included.

For email field:

http://codex.wordpress.org/Function_Reference/sanitize_email

For other fields:

http://codex.wordpress.org/Function_Reference/sanitize_text_field

It also contains honeypot fields and a simple captcha sum.

= I notice there are 2 invisible fields (firstname and lastname), what's up with that? =
This is part of anti-spam: these are the 2 honeypot fields

= Other question or comment? =
Please open a topic in plugin forum or send me a message via my website.


== Screenshots == 
1. Very Simple Signup Form in frontend (using Twenty Fifteen theme).

2. Very Simple Signup Form in frontend (using Twenty Fifteen theme).

3. Very Simple Signup Form Custom Style editor.