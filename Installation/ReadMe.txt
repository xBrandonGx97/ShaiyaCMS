Everything in here is required, ofcourse you can edit the scripts to not need all of this..
It's only like this because I use all of these custom scripts on my database.

All of your Accounts that are in Users_Master also needs to be in WEB_Presence for the website to work correctly,
you can do so with a simple script like so:

Also make sure that the useruid's match or the website will throw a bunch of issues.

INSERT INTO ShaiyaCMS.dbo.WEB_PRESENCE 
(UserID,DisplayName,Pw,Admin,Status,UserIP)
SELECT UserID,UserID,Pw,Admin,Status,UserIP FROM PS_UserData.dbo.Users_Master

To change pages:
./assets/classes/Paging.php

To change settings:
./assets/classes/Settings.php

Content files:
./assets/content/

Everything should be pretty easy to use and user friendly =)