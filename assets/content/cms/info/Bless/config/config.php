<?php
$CMSVersion="1.4.1";



$path_p = $_SERVER['DOCUMENT_ROOT'];
$path_pages= $path_p."/assets/content/cms/info/Bless/config/pages.php"; // <-- Here, the full path. $path = htdocs folder (on xampp), edit after the first "/"

//=========SHAIYA LEGACY MAIN CONFIG=========//
$ServerName = "Shaiya Legacy"; //Put the server name
$CServerName = "Lyros Games"; //Put your dev group or you servername
$ServerEmail = "contact@lyrosgames.com";//Put server contact email


$server="127.0.0.1";//GameServer IP
$port1="30800";//Login Server Port
$port2="30810";//Game Server Port
$maxslot="100";//Max In-Game Slots

//Configuration for email (Configured for gmail currently)
$smtp_user = "n/a"; //Your gmail email | ex. example@gmail.com
$smtp_pass = "n/a"; //Your gmail password
$reply_to_email = "contact@lyrosgames.com"; //Email players can reply to
$reply_to_name = "Shaiya Legacy"; //Can be your server's name

// social network
$YTURL='https://www.youtube.com/embed/Eyfc5mkC3n0'; //Put a youtube embed movie link
$facebookurl_s="https://www.facebook.com/Shaiya-Legacy-Official-1062502147098369/";//Lien page facebook
$youtubeurl_s="https://www.youtube.com/user/LyrosGames/";//Lien chaine youtube
$twitterurl_s="https://twitter.com/LyrosGames";//Lien compte twitter
$boost = 0;	//Online Players Boost (exemple: 5 will add 5 online players to each races (Vails, Humans ect..) and so it will increase the total Online Players to $boost * 4 so by 20)


//Server Decs
$FlashNews="No important announcement.";//TopBar message
$MetaWebDesc="Legacy is a unique shaiya server. Instant level (HM) or Leveling (UM).
                     Legacy Shaiya is a PvE / PvP EP 6. Continuous development
					 and various events in a friendly community. 
					 Join us now!";


//========DATABASE CONNEXION STRING=========//

// Database configuration parameters
	$dbHost = '127.0.0.1';
	$dbUser = 'Velo001';
	$dbPass = 'RQIZGv7HyOgN09A3';

	$dbConn = @odbc_connect("Driver={SQL Server};Server=".$dbHost.";",$dbUser,$dbPass) or die('Database Connection Error!');
	if(!$dbConn){
		echo("Connection failed:".odbc_errormsg());
	} 


//========SLIDER CONFIG PART===============//

			/*1st SLIDE*/
$IconURL1	=	"img/annonces/annonces-icon/1.png";//Icon link
$PicURL1	=	"img/annonces/annonces-img/1.jpg";//Picture link
$MetaDesc1	=	"<strong>Cantabilie ! (PvP Zone 20-30)</strong> <br> Fight Aeglos in the icy landscape of Cantabilie! His power is an incomparable power!<br> Dare you confront him? ";//Meta desc (hiden, you'll have to put some text in your picture if you want some text)

			/*2st SLIDE*/
$IconURL2	=	"img/annonces/annonces-icon/2.png";
$PicURL2	=	"img/annonces/annonces-img/2.jpg";
$MetaDesc2	=	"<strong>Discover Pantanasa & Theodores</strong> <br> Monsters as magical as monstrous await you, will you defend yourself ?";

			/*3rd SLIDE*/
$IconURL3	=	"img/annonces/annonces-icon/3.png";
$PicURL3	=	"img/annonces/annonces-img/3.jpg";
$MetaDesc3	=	"<strong>Make the meeting of Estival !</strong> <br>This monster has an extraordinary mastery of fire ! Estival lies in the plains of the desert and he is waiting for an opponent ...";

			/*4th SLIDE*/
$IconURL4	=	"img/annonces/annonces-icon/4.png";
$PicURL4	=	"img/annonces/annonces-img/4.jpg";
$MetaDesc4	=	"<strong>Canyon Of Greed</strong> <br> In this canyon you will find huge creatures and a terrifying monster carved with rock nicknamed Opalus!";

			/*5th SLIDE*/
$IconURL5	=	"img/annonces/annonces-icon/5.png";
$PicURL5	=	"img/annonces/annonces-img/5.jpg";
$MetaDesc5	=	"<strong>Etania: A new world !</strong> <br> This new map contains various creatures and a winged monster overpowered. Fight it and get exclusive items!</strong>";

			/*6th SLIDE*/
$IconURL6	=	"img/annonces/annonces-icon/6.png";
$PicURL6	=	"img/annonces/annonces-img/6.jpg";
$MetaDesc6	=	"<strong>Proelium ! (PvP Zone 1-15)</strong> <br> Confront yourself to death knight located in the depths of Proelium! Watch your back, the opposing faction could occur!";

			/*7th SLIDE*/
$IconURL7	=	"img/annonces/annonces-icon/7.png";
$PicURL7	=	"img/annonces/annonces-img/7.jpg";
$MetaDesc7	=	"<strong>Hivernal: Mistress of Jungle</strong> <br> The jungle is a dangerous area where countless creatures are hiding. One of them differs incredible control of water ... ";

			/*8th SLIDE*/
$IconURL8	=	"img/annonces/annonces-icon/8.png";
$PicURL8	=	"img/annonces/annonces-img/8.jpg";
$MetaDesc8	=	"<strong>Hares: A massive force</strong> <br> A destructive power took hold of him. ! his thirst for revenge is endless. Hares awaits you !";

include_once($path_pages);

?>