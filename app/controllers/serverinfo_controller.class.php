<?php
	use Classes\Utils\User;
	
    Class ServerInfo_Controller Extends CoreController {
        public static function about(){
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
            self::view('serverinfo/about', $data);
        }

        public static function bossrecords(){
            $bossRecords   =   self::model('boss_records');
            User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
                'bossrecords' => $bossRecords,
                'User' => $User,
            ];
            self::view('serverinfo/bossrecords', $data);
        }

        public static function dropfinder(){
        	$dropFinder   =   self::model('drop_finder');
        	User::run();
        	$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
              	'dropfinder' => $dropFinder,
              	'User' => $User,
            ];
            self::view('serverinfo/dropfinder', $data);
        }

        public static function drops(){
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
            self::view('serverinfo/drops', $data);
        }

        public static function terms(){
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
            self::view('serverinfo/terms', $data);
        }
    }