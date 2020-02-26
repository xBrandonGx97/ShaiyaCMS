<?php
	use Classes\Utils\Browser;
	use Classes\Utils\User;
	use Classes\Utils\Data;
	
    Class User_Controller Extends CoreController {
    	public static function profile(){
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
            self::view('user/profile', $data);
        }
        public static function donate(){
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
            self::view('user/donate', $data);
        }
        public static function donate_complete(){
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
            self::view('user/donate_complete', $data);
        }
        public static function donate_process(){
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
            self::view('user/donate_process', $data);
        }
        public static function logout(){
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
            ];
            self::view('user/logout', $data);
        }
        public static function messages(){
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
            self::view('user/messages', $data);
        }
        public static function promotions(){
    		$promotions		=	self::model('Promotions');
    		User::run();
			$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
				'User' => $User,
				'promotions' => $promotions,
            ];
            self::view('user/promotions', $data);
        }
        public static function pvprewards(){
    		$rewards		=	self::model('PvPRewards');
    		User::run();
			$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
				'User' => $User,
				'Browser' => Browser::run(),
				'rewards' => $rewards,
            ];
            self::view('user/pvprewards', $data);
        }
        public static function referers(){
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
            self::view('user/referers', $data);
        }
        public static function settings(){
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
            self::view('user/settings', $data);
        }
        public static function support(){
    		$support		=	self::model('Support');
    		User::run();
			$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
				'User' => $User,
				'support' => $support,
            ];
            self::view('user/support', $data);
        }
        public static function user($id){
        	echo 'id: ' .$id.'<br>';
            echo 'user';
        }
        public static function vote(){
    		$vote		=	self::model('Vote');
    		User::run();
			$User			=	User::_fetch_User();
            $data=['pageData'=>[
                'index' =>  'index',
                'title' =>  'Home',
                'zone' =>  'CMS',
                'nav' =>  true
              ],
				'User' => $User,
				'vote' => $vote
            ];
            self::view('user/vote', $data);
        }
    }