=== BP Push Notification ===
Contributors: aheadzen
Tags: buddypress, notification, push notification, mobile application
Requires at least : 4.0.0
Tested up to: 4.2.2
Stable tag: 2.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


Buddypress notification display by push notification  to  mobile application.


==Description==

Send the notification to the mobile app as per settings of buddypress.

The will add notification 
	-- on voting pluign (by aheadzen) like click.
	-- activity mention notification
	-- activity comments & reply post
	
The alert notification will display as alert on the screen with message.
	
The plugin require curl to send notification in addition you should  add your application on https://apps.ionic.io/apps

How to user API  ::
------------------
* Register New User Device Token POST method : 
http://SITEURL.COM/

Data should POST
-----------------
action  --  value should be "register_device"
plugin -- value should be "push"
pw  -- current user password
user_id   -- current user id
platform -- device platform like windows/android/ios
device_token -- your device token


* Get New User Device Token : http://SITEURL.COM/?plugin=push&action=get_device_token
* Send User Notification as per settings :  http://SITEURL.COM/?plugin=push&action=send_user_notification

Automatic notification sent for ::
------------------------------------
--> activity comments
--> notification mention
--> bp activity add
		--> votes like unlike
		--> Group activity
--> bp notification


==Installation==

* upload the plugin folder to your WordPress plugin folder (/wp-content/plugins)
* activate the plugin through the 'Plugins' menu in WordPress or by using the link provided by the plugin installer
* add your apiSecret & androidAppId from plugin setting of wp-admin > Settings > Push Notification


== Screenshots ==
1. Plugin Activation
3. Plugin Settings




==Changelog==

=1.0.0=
* Fresh Public setup

=2.0.0=
* Send notification from buddy press meta
* Notification on group update
* Notifications on liked page comments

=2.0.1=
* Register Device to Post Method

=2.0.2=
* Push API included namespace :: "push"

=2.0.3=
* New push notification method added : Ionic PushBots Notification

=2.0.4=
* Security change added

=2.0.5=
* push notification working for 
	-- activity new comments
	-- group new activity
	-- Follow Member
	-- member profile like
	-- profile photo like
	-- post like
	-- activity commnet like
	-- post comments like
	-- group like
	-- topic & post like
	
=2.0.6=
* push error solved.

=2.0.7=
* Notification not working properly - Solved.

=2.0.8=
* admin setting was not working - solved.

=2.0.9=
* User device register via user token - related code added.