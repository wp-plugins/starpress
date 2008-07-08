=== Plugin Name ===
Contributors: frederic lasserre, olivier heinrich
Donate link: http://www.starpass.fr
Tags: micropaiement, audiotel, starpass
Requires at least: 2.5.1
Tested up to: 2.5.1
Stable tag: 1.0

Starpress is a plugin letting bloggers insert Starpass micropaiement solution inside lists and posts through a simple shortcode.

== Description ==

Starpass is a micropaiement solution for bloggers and webmasters to monetize their content on a pay-per-view basis.
Customer wanting access a protected document has to call an overtaxed phone number and is given 1 or more code(s) he enters on a form for the system to check. If validation is successfull, customer is redirected to the success url (the product he is paying for), if not to the failure one.

With Starpress plugin, do forget how hard it could be to insert php or javascript code into your posts : just insert shortcodes and get your Starpass micropaiment form working

== Installation ==

Prior to use Starpress plugin you will have to register as a Starpass affiliate on http://www.starpass.fr/ , create your first site and a new document attached to this site.

1. Upload all Starpress files to the `/wp-content/plugins/starpress` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by entering the starpress admin page
   * Partner ID : partner id as given by Starpass
   * Site ID : site id as given by Starpass
   * Show link label : text shown when in toggle-off mode (lists only)
   * Hide link label : text shown when in toggle-on mode (lists only)
1. Create a new post
1. Place `[starpress idd='xxxx']` shortcode in your post where you want the code control form to be inserted, 'xxxx' being the protected document id as given by Starpass

== Frequently Asked Questions ==

= What are the principles behind Starpass/Starpress system ? =

Suppose you have to protect some documents you only want paying customers have access to.

1. you will then create 
   - a page for the protected area (the success url, ex: http://mydomain.com/gallery/index.php)
   - a page for trapping codes failures (the failure url, ex: http://mydomain.com/error.php)
   - a page for the customer to validate codes (the control form, ex: http://mydomain.com/access.php)

1. in your Starpass webmaster area, create a new document on which you will indicate the number of codes required to access the protected area, their validity (1, 2 or 3 accesses), the success url, the failure url and the available countries (for the form to show the appropriate phone number)
1. on the form page, insert the first Starpass script wich will render the form with the proper number of code input fields
1. on the success page (and all the protected pages as well), insert the second Starpass script wich will be in charge to control whether the customer has entered valid codes or not.

= Where can I find the idd ? =

The idd is automatically defined by the Starpass system when you create a new document. You'll find it by browsing the scripts attached to this document.
Ex:

`<div id="starpass_199"></div>
<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=199&amp;datas=">
</script>`

In this example, the idd is : 199

= Does Starpress help me control access to another post ? =

Starpress' first version does permit the visitor to gain access to a protected area on your website only; this area should be outside of your blog. In the case you absolutly need/want redirect your visitor to another post after paiement, you'll have to install/activate another plugin like runPHP in order to insert/execute the Starpass protection script.

= Which types of products/services sales Starpress is focused on ? =

With Starpress, you're entitled to sell services and dematerialized products only. You **cannot** sell physical products nor receive donations through Starpress!

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot
