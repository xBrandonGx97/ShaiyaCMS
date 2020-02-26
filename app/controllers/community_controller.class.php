<?php
	use Classes\Utils\User;

    Class Community_Controller extends CoreController {
        public static function discord(){
        	User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
              	'User' => $User,
            ];
            self::view('community/discord', $data);
        }

        public static function downloads(){
        	User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
              	'User' => $User,
            ];
            self::view('community/downloads', $data);
        }

        public static function guildrankings(){
            $guildRankingsModel   =   self::model('guild_rankings');
            User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
                'guildrankings' => $guildRankingsModel->getGuildRankings(),
                'User' => $User,
            ];
            self::view('community/guildrankings', $data);
        }

        public static function guilds(){
        	User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
              	'User' => $User,
            ];
            self::view('community/guilds', $data);
        }

        public static function news(){
            $newsModel            =   self::model('news');
            User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
                'news' => $newsModel->getNews(),
                'User' => $User,
            ];
            self::view('community/news', $data);
        }

        public static function patchnotes(){
            $patchNotesModel      =   self::model('patch_notes');
            User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
                'patchnotes' => $patchNotesModel->getPatchNotes(),
                'User' => $User,
            ];
            self::view('community/patchnotes', $data);
        }

        public static function pvprankings(){
        	User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
              	'User' => $User,
            ];
            self::view('community/pvprankings', $data);
        }

        public static function staffteam(){
        	User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
              	'User' => $User,
            ];
            self::view('community/staffteam', $data);
        }
    }