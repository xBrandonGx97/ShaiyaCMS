<?php

   namespace Classes\Utils;

    use Classes\DB\MSSQL;

    class Select
    {
        public function dobm()
        {
            echo '<select class="form-control" name="DOB_M">';
            echo '<option value="na">Month</option>';
            echo '<option value="1">January</option>';
            echo '<option value="2">February</option>';
            echo '<option value="3">March</option>';
            echo '<option value="4">April</option>';
            echo '<option value="5">May</option>';
            echo '<option value="6">June</option>';
            echo '<option value="7">July</option>';
            echo '<option value="8">August</option>';
            echo '<option value="9">September</option>';
            echo '<option value="10">October</option>';
            echo '<option value="11">November</option>';
            echo '<option value="12">December</option>';
            echo '</select>';
        }

        public function dobd()
        {
            echo '<select class="form-control" name="DOB_D">';
            echo '<option value="na">Day</option>';
            echo '<option value="1">1</option>';
            echo '<option value="2">2</option>';
            echo '<option value="3">3</option>';
            echo '<option value="4">4</option>';
            echo '<option value="5">5</option>';
            echo '<option value="6">6</option>';
            echo '<option value="7">7</option>';
            echo '<option value="8">8</option>';
            echo '<option value="9">9</option>';
            echo '<option value="10">10</option>';
            echo '<option value="11">11</option>';
            echo '<option value="12">12</option>';
            echo '<option value="13">13</option>';
            echo '<option value="14">14</option>';
            echo '<option value="15">15</option>';
            echo '<option value="16">16</option>';
            echo '<option value="17">17</option>';
            echo '<option value="18">18</option>';
            echo '<option value="19">19</option>';
            echo '<option value="20">20</option>';
            echo '<option value="21">21</option>';
            echo '<option value="22">22</option>';
            echo '<option value="23">23</option>';
            echo '<option value="24">24</option>';
            echo '<option value="25">25</option>';
            echo '<option value="26">26</option>';
            echo '<option value="27">27</option>';
            echo '<option value="28">28</option>';
            echo '<option value="29">29</option>';
            echo '<option value="30">30</option>';
            echo '<option value="31">31</option>';
            echo '</select>';
        }

        public function doby()
        {
            echo '<select class="form-control" name="DOB_Y">';
            echo '<option value="N/A">Year</option>';
            echo '<option value="2016">2016</option>';
            echo '<option value="2015">2015</option>';
            echo '<option value="2014">2014</option>';
            echo '<option value="2013">2013</option>';
            echo '<option value="2012">2012</option>';
            echo '<option value="2011">2011</option>';
            echo '<option value="2010">2010</option>';
            echo '<option value="2009">2009</option>';
            echo '<option value="2008">2008</option>';
            echo '<option value="2007">2007</option>';
            echo '<option value="2006">2006</option>';
            echo '<option value="2005">2005</option>';
            echo '<option value="2004">2004</option>';
            echo '<option value="2003">2003</option>';
            echo '<option value="2002">2002</option>';
            echo '<option value="2001">2001</option>';
            echo '<option value="2000">2000</option>';
            echo '<option value="1999">1999</option>';
            echo '<option value="1998">1998</option>';
            echo '<option value="1997">1997</option>';
            echo '<option value="1996">1996</option>';
            echo '<option value="1995">1995</option>';
            echo '<option value="1994">1994</option>';
            echo '<option value="1993">1993</option>';
            echo '<option value="1992">1992</option>';
            echo '<option value="1991">1991</option>';
            echo '<option value="1990">1990</option>';
            echo '<option value="1989">1989</option>';
            echo '<option value="1988">1988</option>';
            echo '<option value="1987">1987</option>';
            echo '<option value="1986">1986</option>';
            echo '<option value="1985">1985</option>';
            echo '<option value="1984">1984</option>';
            echo '<option value="1983">1983</option>';
            echo '<option value="1982">1982</option>';
            echo '<option value="1981">1981</option>';
            echo '<option value="1980">1980</option>';
            echo '<option value="1979">1979</option>';
            echo '<option value="1978">1978</option>';
            echo '<option value="1977">1977</option>';
            echo '<option value="1976">1976</option>';
            echo '<option value="1975">1975</option>';
            echo '<option value="1974">1974</option>';
            echo '<option value="1973">1973</option>';
            echo '<option value="1972">1972</option>';
            echo '<option value="1971">1971</option>';
            echo '<option value="1970">1970</option>';
            echo '<option value="1969">1969</option>';
            echo '<option value="1968">1968</option>';
            echo '<option value="1967">1967</option>';
            echo '<option value="1966">1966</option>';
            echo '<option value="1965">1965</option>';
            echo '<option value="1964">1964</option>';
            echo '<option value="1963">1963</option>';
            echo '<option value="1962">1962</option>';
            echo '<option value="1961">1961</option>';
            echo '<option value="1960">1960</option>';
            echo '<option value="1959">1959</option>';
            echo '<option value="1958">1958</option>';
            echo '<option value="1957">1957</option>';
            echo '<option value="1956">1956</option>';
            echo '<option value="1955">1955</option>';
            echo '<option value="1954">1954</option>';
            echo '<option value="1953">1953</option>';
            echo '<option value="1952">1952</option>';
            echo '<option value="1951">1951</option>';
            echo '<option value="1950">1950</option>';
            echo '<option value="1949">1949</option>';
            echo '<option value="1948">1948</option>';
            echo '<option value="1947">1947</option>';
            echo '<option value="1946">1946</option>';
            echo '<option value="1945">1945</option>';
            echo '<option value="1944">1944</option>';
            echo '<option value="1943">1943</option>';
            echo '<option value="1942">1942</option>';
            echo '<option value="1941">1941</option>';
            echo '<option value="1940">1940</option>';
            echo '</select>';
        }

        public function sec_question()
        {
            // Security Questions
            $secArr = [
                'Please select a security question.',
                'What is your Favorite color?',
                'What is your Mothers maiden name?',
                'What is your middle name?',
                'What was your childhood nickname?',
                'What is the name of your childhood best friend',
                'In what city or town did your mother and father meet?',
                'What is your favorite sports team?',
                'What is your favorite movie?',
                'What is your favorite sport?',
                'What is your pets name?',
                'What is your favorite food?',
                'What was the make of your first car?',
                'What was the name of the hospital where you were born',
                'In what town were you born?',
                'What was the name of the high school you attended?',
                'What school did you attend for sixth grade?',
                'What was the last name of your third grade teacher?',
                'What was the last name of your eighth grade teacher?',
                'What was your first job?',
                'What is the first name of the person you first kissed?',
                'What is the last name of the teacher who gave you your first failing grade?',
                'What was the name of your favorite teacher in high school',
                'What is the name of the street where you grew up?',
                'What is the name of your favorite cousin?',
                'Who was your childhood hero?',
                'What is the name of the place your wedding reception was held?',
                'What is your favorite holiday?',
                'Where did you spend your honeymoon?',
                'Who was your date on prom night?',
                'What town was your father born in?',
                'What town was your mother born in?',
                'Where did you meet your spouse?',
                'Where/how did you meet your bestfriend?',
                'How old were you when you first flew on a plane?',
                'Where did you go the first time you flew on a plane?',
                'What is the first name of your best friend in high school?',
                'What was the name of your first pet?',
                'What was the first thing you learned to cook?',
                'What was the first film you saw in the theatre?',
                'What is the name of your favorite artist?',
                'What is your favorite song?',
                'Who is your favorite author?',
                'What is your favorite book?',
                'What was your best summer?',
                'Who was your best man at your wedding?',
                'Who was your maid of honor at your wedding?',
                'What is your dream job/career?',
                'What is your dream car?',
                'In what year did you graduate high school?',
                'In what year did you graduate college?',
                'What is your fathers middle name?',
                'What is your mothers middle name?'
            ];

            $return = '<select class="form-control tac" name="SecQuestion">';
            for ($i = 0;$i < count($secArr);$i++) {
                $return .= '<option value="' . $i . '">' . $secArr[$i] . '</option>';
            }
            $return .= '</select>';

            return $return;
        }

        public function getForumDestinations($forumID)
        {
            MSSQL::query('SELECT ForumID,ForumName FROM ShaiyaCMS.dbo.FORUMS');
            $res = MSSQL::resultSet();
            $return = '<select class="form-control tac" name="Destination">';
            foreach ($res as $name) {
                if ($forumID == $name->ForumID) {
                    $return .= '<option value="' . $name->ForumID . '" selected>' . $name->ForumName . '</option>';
                } else {
                    $return .= '<option value="' . $name->ForumID . '">' . $name->ForumName . '</option>';
                }
            }
            $return .= '</select>';

            return $return;
        }

        public function gender()
        {
            echo '<select class="form-control tac" name="Gender">';
            echo '<option value="N/A">Gender</option>';
            echo '<option value="Male">Male</option>';
            echo '<option value="Female">Female</option>';
            echo '<option value="Trans-Male">Trans-Male</option>';
            echo '<option value="Trans-Female">Trans-Female</option>';
            echo '<option value="Other">Prefer Not To Say</option>';
            echo '</select>';
        }

        public function color()
        {
            echo '<select class="form-control tac" name="Color">';
            echo '<option										value="na">Color</option>';
            echo '<option class="badge badge-primary tac"		value="0">Primary</option>';
            echo '<option class="badge badge-secondary tac"		value="1">Secondary</option>';
            echo '<option class="badge badge-success tac"		value="2">Success</option>';
            echo '<option class="badge badge-danger tac"		value="3">Danger</option>';
            echo '<option class="badge badge-warning tac"		value="4">Warning</option>';
            echo '<option class="badge badge-info tac"			value="5">Info</option>';
            echo '<option class="badge badge-light tac"			value="6">Light</option>';
            echo '<option class="badge badge-dark tac"			value="7">Dark</option>';
            echo '</select>';
        }

        public function PageShow()
        {
            echo '<select class="form-control" id="PAGE_SHOW" name="PAGE_SHOW">';
            echo '<option disabled selected>Show Page?</option>';
            echo '<option value="1">Yes</option>';
            echo '<option value="0">No</option>';
            echo '</select>';
        }

        public function ReqLogin()
        {
            echo '<select class="form-control" id="req_login_select REQ_LOGIN" name="REQ_LOGIN">';
            echo '<option disabled selected>Require Login?</option>';
            echo '<option value="1">Yes</option>';
            echo '<option value="0">No</option>';
            echo '</select>';
        }

        public function ACPStyle()
        {
            echo '<select class="form-control" name="STYLE_NAME">';
            echo '<option disabled selected>Select Theme*</option>';
            echo '<option value="Admin">Admin</option>';
            echo '</select>';
        }

        public function PluginOrder()
        {
            echo '<select class="form-control" name="PLUGIN_ORDER">';
            echo '<option disabled selected>Plugin Order*</option>';
            echo '<option value="0">0</option>';
            echo '<option value="1">1</option>';
            echo '<option value="2">2</option>';
            echo '<option value="3">3</option>';
            echo '<option value="4">4</option>';
            echo '<option value="5">5</option>';
            echo '<option value="6">6</option>';
            echo '<option value="7">7</option>';
            echo '<option value="8">8</option>';
            echo '<option value="9">9</option>';
            echo '</select>';
        }

        public function PluginEnable()
        {
            echo '<select class="form-control" name="PLUGIN_ENABLE">';
            echo '<option disabled selected>Enable Plugin*</option>';
            echo '<option value="0">No</option>';
            echo '<option value="1">Yes</option>';
            echo '</select>';
        }

        public function BackgroundColor()
        {
            echo '<select class="form-control tac col-md-6" name="VALUE">';
            echo '<option class="tac" disabled selected>Background Color</option>';
            echo '<option 												value="">None</option>';
            echo '<option class="badge badge-primary tac"				value="bg-primary">Primary</option>';
            echo '<option class="badge badge-secondary tac"				value="bg-secondary">Secondary</option>';
            echo '<option class="badge badge-success tac"				value="bg-success">Success</option>';
            echo '<option class="badge badge-danger tac"				value="bg-danger">Danger</option>';
            echo '<option class="badge badge-warning tac"				value="bg-warning">Warning</option>';
            echo '<option class="badge badge-info tac"					value="bg-info">Info</option>';
            echo '<option class="badge badge-light tac"					value="bg-light">Light</option>';
            echo '<option class="badge badge-dark tac"					value="bg-dark">Dark</option>';
            echo '<option class="badge badge-white tac text-dark"		value="bg-white">White</option>';
            echo '<option class="badge badge-white tac bg-black"		value="bg-black">Black</option>'; // custom color
                echo '<option class="badge badge-white tac bg-grey-black"	value="bg-grey black">Grey-Black</option>'; // custom color
            echo '</select>';
        }

        public function Bit()
        {
            echo '<select class="form-control" name="VALUE">';
            echo '<option disabled selected>Enable/Disable</option>';
            echo '<option value="1">Enabled</option>';
            echo '<option value="0">Disabled</option>';
            echo '</select>';
        }

        public function CMSTheme()
        {
            echo '<select class="form-control" name="VALUE">';
            echo '<option disabled selected>Choose a Theme</option>';
            echo '<option value="Glazed">Glazed</option>';
            echo '<option value="Shadows">Shadows</option>';
            echo '<option value="Surface">Surface</option>';
            echo '</select>';
        }

        public function SidebarPos()
        {
            echo '<select class="form-control tac col-md-6" name="VALUE">';
            echo '<option disabled selected>Sidebar Position</option>';
            echo '<option value="0">No Sidebar</option>';
            echo '<option value="1">Left</option>';
            echo '<option value="2">Right</option>';
            echo '</select>';
        }

        public function AcctBan()
        {
            echo '<select class="form-control" name="Length">';
            echo '<option disabled selected>Ban Length</option>';
            echo '<option value="12hr">12 Hours</option>';
            echo '<option value="5days">5 Days</option>';
            echo '<option value="2weeks">2 Weeks</option>';
            echo '<option value="perma">Permanent</option>';
            echo '</select>';
        }

        public function PANE_BG_COLOR()
        {
            echo '<select class="form-control" id="VALUE" name="VALUE">';
            echo '<option disabled selected>Color Picker</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0F8FF" value="240,248,255">AliceBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FAEBD7" value="250,235,215">AntiqueWhite</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFEFDB" value="255,239,219">AntiqueWhite1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEDFCC" value="238,223,204">AntiqueWhite2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC0B0" value="205,192,176">AntiqueWhite3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8378" value="139,131,120">AntiqueWhite4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7FFFD4" value="127,255,212">Aquamarine</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7FFFD4" value="127,255,212">Aquamarine1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#76EEC6" value="118,238,198">Aquamarine2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#66CDAA" value="102,205,170">Aquamarine3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#458B74" value="069,139,116">Aquamarine4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0FFFF" value="240,255,255">Azure</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0FFFF" value="240,255,255">Azure1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E0EEEE" value="224,238,238">Azure2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C1CDCD" value="193,205,205">Azure3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#838B8B" value="131,139,139">Azure4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F5F5DC" value="245,245,220">Beige</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE4C4" value="255,228,196">Bisque</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE4C4" value="255,228,196">Bisque1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EED5B7" value="238,213,183">Bisque2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDB79E" value="205,183,158">Bisque3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7D6B" value="139,125,107">Bisque4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#000000" value="000,000,000">Black</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFEBCD" value="255,228,196">BlanchedAlmond</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0000FF" value="000,000,255">Blue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0000FF" value="000,000,255">Blue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0000EE" value="000,000,238">Blue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0000CD" value="000,000,205">Blue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00008B" value="000,000,139">Blue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8A2BE2" value="138,043,226">BlueViolet</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A52A2A" value="165,042,042">Brown</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF4040" value="255,064,064">Brown1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE3B3B" value="238,059,059">Brown2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD3333" value="205,051,051">Brown3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B2323" value="139,035,035">Brown4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DEB887" value="222,184,135">Burlywood</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFD39B" value="255,211,155">Burlywood1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEC591" value="238,197,145">Burlywood2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDAA7D" value="205,170,125">Burlywood3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7355" value="139,115,085">Burlywood4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#5F9EA0" value="095,158,160">CadetBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#98F5FF" value="152,245,255">CadetBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8EE5EE" value="142,229,238">CadetBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7AC5CD" value="122,197,205">CadetBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#53868B" value="083,134,139">CadetBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7FFF00" value="127,255,000">Chartreuse</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7FFF00" value="127,255,000">Chartreuse1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#76EE00" value="118,238,000">Chartreuse2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#66CD00" value="102,205,000">Chartreuse3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#458B00" value="069,139,000">Chartreuse4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D2691E" value="210,105,030">Chocolate</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF7F24" value="255,127,036">Chocolate1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE7621" value="238,118,033">Chocolate2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD661D" value="205,102,029">Chocolate3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B4513" value="139,069,019">Chocolate4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF7F50" value="255,127,080">Coral</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF7256" value="255,114,086">Coral1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE6A50" value="238,106,080">Coral2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD5B45" value="205,091,069">Coral3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B3E2F" value="139,062,047">Coral4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6495ED" value="100,149,237">CornflowerBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF8DC" value="255,248,220">Cornsilk</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF8DC" value="255,248,220">Cornsilk1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE8CD" value="238,232,205">Cornsilk2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC8B1" value="205,200,177">Cornsilk3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8878" value="139,136,120">Cornsilk4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FFFF" value="000,255,255">Cyan</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FFFF" value="000,255,255">Cyan1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00EEEE" value="000,238,238">Cyan2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00CDCD" value="000,205,205">Cyan3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#008B8B" value="000,139,139">Cyan4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00008B" value="000,000,139">DarkBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#008B8B" value="000,139,139">DarkCyan</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B8860B" value="184,134,011">DarkGoldenrod</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFB90F" value="255,185,015">DarkGoldenrod1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEAD0E" value="238,173,014">DarkGoldenrod2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD950C" value="205,149,012">DarkGoldenrod3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B6508" value="139,101,008">DarkGoldenrod4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A9A9A9" value="169,169,169">DarkGray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#006400" value="000,100,000">DarkGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BDB76B" value="189,183,107">DarkKhaki</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B008B" value="139,000,139">DarkMagenta</option>';
            echo '<option class="badge badge-white tac" style="background-color:#556B2F" value="085,107,047">DarkOliveGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CAFF70" value="202,255,112">DarkOliveGreen1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BCEE68" value="188,238,104">DarkOliveGreen2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A2CD5A" value="162,205,090">DarkOliveGreen3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6E8B3D" value="110,139,061">DarkOliveGreen4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF8C00" value="255,140,000">DarkOrange</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF7F00" value="255,127,000">DarkOrange1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE7600" value="238,118,000">DarkOrange2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD6600" value="205,102,000">DarkOrange3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B4500" value="139,069,000">DarkOrange4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9932CC" value="153,050,204">DarkOrchid</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BF3EFF" value="191,062,255">DarkOrchid1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B23AEE" value="178,058,238">DarkOrchid2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9A32CD" value="154,050,205">DarkOrchid3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#68228B" value="104,034,139">DarkOrchid4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B0000" value="139,000,000">DarkRed</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E9967A" value="233,150,122">DarkSalmon</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8FBC8F" value="143,188,143">DarkSeaGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C1FFC1" value="193,255,193">DarkSeaGreen1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B4EEB4" value="180,238,180">DarkSeaGreen2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9BCD9B" value="155,205,155">DarkSeaGreen3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#698B69" value="105,139,105">DarkSeaGreen4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#483D8B" value="072,061,139">DarkSlateBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#2F4F4F" value="047,079,079">DarkSlateGray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#97FFFF" value="151,255,255">DarkSlateGray1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8DEEEE" value="141,238,238">DarkSlateGray2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#79CDCD" value="121,205,205">DarkSlateGray3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#528B8B" value="082,139,139">DarkSlateGray4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00CED1" value="000,206,209">DarkTurquoise</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9400D3" value="148,000,211">DarkViolet</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF1493" value="255,020,147">DeepPink</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF1493" value="255,020,147">DeepPink1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE1289" value="238,018,137">DeepPink2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD1076" value="205,016,118">DeepPink3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B0A50" value="139,010,080">DeepPink4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00BFFF" value="000,191,255">DeepSkyBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00BFFF" value="000,191,255">DeepSkyBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00B2EE" value="000,178,238">DeepSkyBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#009ACD" value="000,154,205">DeepSkyBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00688B" value="000,104,139">DeepSkyBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#696969" value="105,105,105">DimGray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1E90FF" value="030,144,255">DodgerBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1E90FF" value="030,144,255">DodgerBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1C86EE" value="028,134,238">DodgerBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1874CD" value="024,116,205">DodgerBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#104E8B" value="016,078,139">DodgerBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B22222" value="178,034,034">Firebrick</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF3030" value="255,048,048">Firebrick1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE2C2C" value="238,044,044">Firebrick2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD2626" value="205,038,038">Firebrick3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B1A1A" value="139,026,026">Firebrick4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFAF0" value="255,250,240">FloralWhite</option>';
            echo '<option class="badge badge-white tac" style="background-color:#228B22" value="034,139,034">ForestGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DCDCDC" value="220,220,220">Gainsboro</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F8F8FF" value="248,248,255">GhostWhite</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFD700" value="255,215,000">Gold</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFD700" value="255,215,000">Gold1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEC900" value="238,201,000">Gold2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDAD00" value="205,173,000">Gold3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7500" value="139,117,000">Gold4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DAA520" value="218,165,032">Goldenrod</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFC125" value="255,193,037">Goldenrod1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEB422" value="238,180,034">Goldenrod2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD9B1D" value="205,155,029">Goldenrod3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B6914" value="139,105,020">Goldenrod4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BEBEBE" value="190,190,190">Gray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#000000" value="000,000,000">Gray0</option>';
            echo '<option class="badge badge-white tac" style="background-color:#030303" value="003,003,003">Gray1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1A1A1A" value="026,026,026">Gray10</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFFFF" value="255,255,255">Gray100</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1C1C1C" value="028,028,028">Gray11</option>';
            echo '<option class="badge badge-white tac" style="background-color:#1F1F1F" value="031,031,031">Gray12</option>';
            echo '<option class="badge badge-white tac" style="background-color:#212121" value="033,033,033">Gray13</option>';
            echo '<option class="badge badge-white tac" style="background-color:#242424" value="036,036,036">Gray14</option>';
            echo '<option class="badge badge-white tac" style="background-color:#262626" value="038,038,038">Gray15</option>';
            echo '<option class="badge badge-white tac" style="background-color:#292929" value="041,041,041">Gray16</option>';
            echo '<option class="badge badge-white tac" style="background-color:#2B2B2B" value="043,043,043">Gray17</option>';
            echo '<option class="badge badge-white tac" style="background-color:#2E2E2E" value="046,046,046">Gray18</option>';
            echo '<option class="badge badge-white tac" style="background-color:#303030" value="048,048,048">Gray19</option>';
            echo '<option class="badge badge-white tac" style="background-color:#050505" value="005,005,005">Gray2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#333333" value="051,051,051">Gray20</option>';
            echo '<option class="badge badge-white tac" style="background-color:#363636" value="054,054,054">Gray21</option>';
            echo '<option class="badge badge-white tac" style="background-color:#383838" value="056,056,056">Gray22</option>';
            echo '<option class="badge badge-white tac" style="background-color:#3B3B3B" value="059,059,059">Gray23</option>';
            echo '<option class="badge badge-white tac" style="background-color:#3D3D3D" value="061,061,061">Gray24</option>';
            echo '<option class="badge badge-white tac" style="background-color:#404040" value="064,064,064">Gray25</option>';
            echo '<option class="badge badge-white tac" style="background-color:#424242" value="066,066,066">Gray26</option>';
            echo '<option class="badge badge-white tac" style="background-color:#454545" value="069,069,069">Gray27</option>';
            echo '<option class="badge badge-white tac" style="background-color:#474747" value="071,071,071">Gray28</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4A4A4A" value="074,074,074">Gray29</option>';
            echo '<option class="badge badge-white tac" style="background-color:#080808" value="008,008,008">Gray3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4D4D4D" value="077,077,077">Gray30</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4F4F4F" value="079,079,079">Gray31</option>';
            echo '<option class="badge badge-white tac" style="background-color:#525252" value="082,082,082">Gray32</option>';
            echo '<option class="badge badge-white tac" style="background-color:#545454" value="084,084,084">Gray33</option>';
            echo '<option class="badge badge-white tac" style="background-color:#575757" value="087,087,087">Gray34</option>';
            echo '<option class="badge badge-white tac" style="background-color:#595959" value="089,089,089">Gray35</option>';
            echo '<option class="badge badge-white tac" style="background-color:#5C5C5C" value="092,092,092">Gray36</option>';
            echo '<option class="badge badge-white tac" style="background-color:#5E5E5E" value="094,094,094">Gray37</option>';
            echo '<option class="badge badge-white tac" style="background-color:#616161" value="097,097,097">Gray38</option>';
            echo '<option class="badge badge-white tac" style="background-color:#636363" value="099,099,099">Gray39</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0A0A0A" value="010,010,010">Gray4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#666666" value="102,102,102">Gray40</option>';
            echo '<option class="badge badge-white tac" style="background-color:#696969" value="105,105,105">Gray41</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6B6B6B" value="107,107,107">Gray42</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6E6E6E" value="110,110,110">Gray43</option>';
            echo '<option class="badge badge-white tac" style="background-color:#707070" value="112,112,112">Gray44</option>';
            echo '<option class="badge badge-white tac" style="background-color:#737373" value="115,115,115">Gray45</option>';
            echo '<option class="badge badge-white tac" style="background-color:#757575" value="117,117,117">Gray46</option>';
            echo '<option class="badge badge-white tac" style="background-color:#787878" value="120,120,120">Gray47</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7A7A7A" value="122,122,122">Gray48</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7D7D7D" value="125,125,125">Gray49</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0D0D0D" value="013,013,013">Gray5</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7F7F7F" value="127,127,127">Gray50</option>';
            echo '<option class="badge badge-white tac" style="background-color:#828282" value="130,130,130">Gray51</option>';
            echo '<option class="badge badge-white tac" style="background-color:#858585" value="133,133,133">Gray52</option>';
            echo '<option class="badge badge-white tac" style="background-color:#878787" value="135,135,135">Gray53</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8A8A8A" value="138,138,138">Gray54</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8C8C8C" value="140,140,140">Gray55</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8F8F8F" value="143,143,143">Gray56</option>';
            echo '<option class="badge badge-white tac" style="background-color:#919191" value="145,145,145">Gray57</option>';
            echo '<option class="badge badge-white tac" style="background-color:#949494" value="148,148,148">Gray58</option>';
            echo '<option class="badge badge-white tac" style="background-color:#969696" value="150,150,150">Gray59</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0F0F0F" value="015,015,015">Gray6</option>';
            echo '<option class="badge badge-white tac" style="background-color:#999999" value="153,153,153">Gray60</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9C9C9C" value="156,156,156">Gray61</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9E9E9E" value="158,158,158">Gray62</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A1A1A1" value="161,161,161">Gray63</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A3A3A3" value="163,163,163">Gray64</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A6A6A6" value="166,166,166">Gray65</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A8A8A8" value="168,168,168">Gray66</option>';
            echo '<option class="badge badge-white tac" style="background-color:#ABABAB" value="171,171,171">Gray67</option>';
            echo '<option class="badge badge-white tac" style="background-color:#ADADAD" value="173,173,173">Gray68</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B0B0B0" value="176,176,176">Gray69</option>';
            echo '<option class="badge badge-white tac" style="background-color:#121212" value="018,018,018">Gray7</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B3B3B3" value="179,179,179">Gray70</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B5B5B5" value="181,181,181">Gray71</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B8B8B8" value="184,184,184">Gray72</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BABABA" value="186,186,186">Gray73</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BDBDBD" value="189,189,189">Gray74</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BFBFBF" value="191,191,191">Gray75</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C2C2C2" value="194,194,194">Gray76</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C4C4C4" value="196,196,196">Gray77</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C7C7C7" value="199,199,199">Gray78</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C9C9C9" value="201,201,201">Gray79</option>';
            echo '<option class="badge badge-white tac" style="background-color:#141414" value="020,020,020">Gray8</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CCCCCC" value="204,204,204">Gray80</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CFCFCF" value="207,207,207">Gray81</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D1D1D1" value="209,209,209">Gray82</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D4D4D4" value="212,212,212">Gray83</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D6D6D6" value="214,214,214">Gray84</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D9D9D9" value="217,217,217">Gray85</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DBDBDB" value="219,219,219">Gray86</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DEDEDE" value="222,222,222">Gray87</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E0E0E0" value="224,224,224">Gray88</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E3E3E3" value="227,227,227">Gray89</option>';
            echo '<option class="badge badge-white tac" style="background-color:#171717" value="023,023,023">Gray9</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E5E5E5" value="229,229,229">Gray90</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E8E8E8" value="232,232,232">Gray91</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EBEBEB" value="235,235,235">Gray92</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EDEDED" value="237,237,237">Gray93</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0F0F0" value="240,240,240">Gray94</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F2F2F2" value="242,242,242">Gray95</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F5F5F5" value="245,245,245">Gray96</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F7F7F7" value="247,247,247">Gray97</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FAFAFA" value="250,250,250">Gray98</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FCFCFC" value="252,252,252">Gray99</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FF00" value="000,255,000">Green</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FF00" value="000,255,000">Green1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00EE00" value="000,238,000">Green2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00CD00" value="000,205,000">Green3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#008B00" value="000,139,000">Green4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#ADFF2F" value="173,255,047">GreenYellow</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0FFF0" value="240,255,240">Honeydew</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0FFF0" value="240,255,240">Honeydew1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E0EEE0" value="224,238,224">Honeydew2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C1CDC1" value="193,205,193">Honeydew3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#838B83" value="131,139,131">Honeydew4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF69B4" value="255,105,180">HotPink</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF6EB4" value="255,110,180">HotPink1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE6AA7" value="238,106,167">HotPink2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD6090" value="205,096,144">HotPink3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B3A62" value="139,058,098">HotPink4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF6A6A" value="255,106,106">IndianRed1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE6363" value="238,099,099">IndianRed2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD5555" value="205,085,085">IndianRed3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B3A3A" value="139,058,058">IndianRed4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFFF0" value="255,255,240">Ivory</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFFF0" value="255,255,240">Ivory1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEEEE0" value="238,238,224">Ivory2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDCDC1" value="205,205,193">Ivory3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8B83" value="139,139,131">Ivory4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F0E68C" value="240,230,140">Khaki</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF68F" value="255,246,143">Khaki1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE685" value="238,230,133">Khaki2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC673" value="205,198,115">Khaki3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B864E" value="139,134,078">Khaki4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E6E6FA" value="230,230,250">Lavender</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF0F5" value="255,240,245">LavenderBlush</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF0F5" value="255,240,245">LavenderBlush1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE0E5" value="238,224,229">LavenderBlush2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC1C5" value="205,193,197">LavenderBlush3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8386" value="139,131,134">LavenderBlush4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7CFC00" value="124,252,000">LawnGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFACD" value="255,250,205">LemonChiffon</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFACD" value="255,250,205">LemonChiffon1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE9BF" value="238,233,191">LemonChiffon2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC9A5" value="205,201,165">LemonChiffon3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8970" value="139,137,112">LemonChiffon4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#ADD8E6" value="173,216,230">LightBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BFEFFF" value="191,239,255">LightBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B2DFEE" value="178,223,238">LightBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9AC0CD" value="154,192,205">LightBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#68838B" value="104,131,139">LightBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F08080" value="240,128,128">LightCoral</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E0FFFF" value="224,255,255">LightCyan</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E0FFFF" value="224,255,255">LightCyan1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D1EEEE" value="209,238,238">LightCyan2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B4CDCD" value="180,205,205">LightCyan3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7A8B8B" value="122,139,139">LightCyan4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEDD82" value="238,221,130">LightGoldenrod</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFEC8B" value="255,236,139">LightGoldenrod1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEDC82" value="238,220,130">LightGoldenrod2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDBE70" value="205,190,112">LightGoldenrod3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B814C" value="139,129,076">LightGoldenrod4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FAFAD2" value="250,250,210">LightGoldenrodYellow</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D3D3D3" value="211,211,211">LightGray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#90EE90" value="144,238,144">LightGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFB6C1" value="255,182,193">LightPink</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFAEB9" value="255,174,185">LightPink1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEA2AD" value="238,162,173">LightPink2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD8C95" value="205,140,149">LightPink3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B5F65" value="139,095,101">LightPink4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFA07A" value="255,160,122">LightSalmon</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFA07A" value="255,160,122">LightSalmon1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE9572" value="238,149,114">LightSalmon2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD8162" value="205,129,098">LightSalmon3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B5742" value="139,087,066">LightSalmon4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#20B2AA" value="032,178,170">LightSeaGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#87CEFA" value="135,206,250">LightSkyBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B0E2FF" value="176,226,255">LightSkyBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A4D3EE" value="164,211,238">LightSkyBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8DB6CD" value="141,182,205">LightSkyBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#607B8B" value="096,123,139">LightSkyBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8470FF" value="132,112,255">LightSlateBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#778899" value="119,136,153">LightSlateGray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B0C4DE" value="176,196,222">LightSteelBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CAE1FF" value="202,225,255">LightSteelBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BCD2EE" value="188,210,238">LightSteelBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A2B5CD" value="162,181,205">LightSteelBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6E7B8B" value="110,123,139">LightSteelBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFFE0" value="255,255,224">LightYellow</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFFE0" value="255,255,224">LightYellow1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEEED1" value="238,238,209">LightYellow2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDCDB4" value="205,205,180">LightYellow3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8B7A" value="139,139,122">LightYellow4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#32CD32" value="050,205,050">LimeGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FAF0E6" value="250,240,230">Linen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF00FF" value="255,000,255">Magenta</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF00FF" value="255,000,255">Magenta1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE00EE" value="238,000,238">Magenta2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD00CD" value="205,000,205">Magenta3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B008B" value="139,000,139">Magenta4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B03060" value="176,048,096">Maroon</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF34B3" value="255,052,179">Maroon1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE30A7" value="238,048,167">Maroon2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD2990" value="205,041,144">Maroon3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B1C62" value="139,028,098">Maroon4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#66CDAA" value="102,205,170">MediumAquamarine</option>';
            echo '<option class="badge badge-white tac" style="background-color:#0000CD" value="000,000,205">MediumBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BA55D3" value="186,085,211">MediumOrchid</option>';
            echo '<option class="badge badge-white tac" style="background-color:#E066FF" value="224,102,255">MediumOrchid1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D15FEE" value="209,095,238">MediumOrchid2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B452CD" value="180,082,205">MediumOrchid3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7A378B" value="122,055,139">MediumOrchid4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9370DB" value="147,112,219">MediumPurple</option>';
            echo '<option class="badge badge-white tac" style="background-color:#AB82FF" value="171,130,255">MediumPurple1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9F79EE" value="159,121,238">MediumPurple2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8968CD" value="137,104,205">MediumPurple3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#5D478B" value="093,071,139">MediumPurple4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#3CB371" value="060,179,113">MediumSeaGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7B68EE" value="123,104,238">MediumSlateBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FA9A" value="000,250,154">MediumSpringGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#48D1CC" value="072,209,204">MediumTurquoise</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C71585" value="199,021,133">MediumVioletRed</option>';
            echo '<option class="badge badge-white tac" style="background-color:#191970" value="025,025,112">MidnightBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F5FFFA" value="245,255,250">MintCream</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE4E1" value="255,228,225">MistyRose</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE4E1" value="255,228,225">MistyRose1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EED5D2" value="238,213,210">MistyRose2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDB7B5" value="205,183,181">MistyRose3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7D7B" value="139,125,123">MistyRose4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE4B5" value="255,228,181">Moccasin</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFDEAD" value="255,222,173">NavajoWhite</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFDEAD" value="255,222,173">NavajoWhite1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EECFA1" value="238,207,161">NavajoWhite2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDB38B" value="205,179,139">NavajoWhite3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B795E" value="139,121,094">NavajoWhite4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#000080" value="000,000,128">NavyBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FDF5E6" value="253,245,230">OldLace</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6B8E23" value="107,142,035">OliveDrab</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C0FF3E" value="192,255,062">OliveDrab1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B3EE3A" value="179,238,058">OliveDrab2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9ACD32" value="154,205,050">OliveDrab3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#698B22" value="105,139,034">OliveDrab4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFA500" value="255,165,000">Orange</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFA500" value="255,165,000">Orange1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE9A00" value="238,154,000">Orange2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD8500" value="205,133,000">Orange3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B5A00" value="139,090,000">Orange4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF4500" value="255,069,000">OrangeRed</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF4500" value="255,069,000">OrangeRed1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE4000" value="238,064,000">OrangeRed2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD3700" value="205,055,000">OrangeRed3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B2500" value="139,037,000">OrangeRed4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DA70D6" value="218,112,214">Orchid</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF83FA" value="255,131,250">Orchid1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE7AE9" value="238,122,233">Orchid2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD69C9" value="205,105,201">Orchid3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B4789" value="139,071,137">Orchid4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE8AA" value="238,232,170">PaleGoldenrod</option>';
            echo '<option class="badge badge-white tac" style="background-color:#98FB98" value="152,251,152">PaleGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9AFF9A" value="154,255,154">PaleGreen1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#90EE90" value="144,238,144">PaleGreen2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7CCD7C" value="124,205,124">PaleGreen3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#548B54" value="084,139,084">PaleGreen4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#AFEEEE" value="175,238,238">PaleTurquoise</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BBFFFF" value="187,255,255">PaleTurquoise1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#AEEEEE" value="174,238,238">PaleTurquoise2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#96CDCD" value="150,205,205">PaleTurquoise3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#668B8B" value="102,139,139">PaleTurquoise4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DB7093" value="219,112,147">PaleVioletRed</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF82AB" value="255,130,171">PaleVioletRed1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE799F" value="238,121,159">PaleVioletRed2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD6889" value="205,104,137">PaleVioletRed3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B475D" value="139,071,093">PaleVioletRed4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFEFD5" value="255,239,213">PapayaWhip</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFDAB9" value="255,218,185">PeachPuff</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFDAB9" value="255,218,185">PeachPuff1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EECBAD" value="238,203,173">PeachPuff2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDAF95" value="205,175,149">PeachPuff3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7765" value="139,119,101">PeachPuff4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD853F" value="205,133,063">Peru</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFC0CB" value="255,192,203">Pink</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFB5C5" value="255,181,197">Pink1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEA9B8" value="238,169,184">Pink2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD919E" value="205,145,158">Pink3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B636C" value="139,099,108">Pink4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#DDA0DD" value="221,160,221">Plum</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFBBFF" value="255,187,255">Plum1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEAEEE" value="238,174,238">Plum2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD96CD" value="205,150,205">Plum3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B668B" value="139,102,139">Plum4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B0E0E6" value="176,224,230">PowderBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A020F0" value="160,032,240">Purple</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9B30FF" value="155,048,255">Purple1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#912CEE" value="145,044,238">Purple2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7D26CD" value="125,038,205">Purple3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#551A8B" value="085,026,139">Purple4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF0000" value="255,000,000">Red</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF0000" value="255,000,000">Red1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE0000" value="238,000,000">Red2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD0000" value="205,000,000">Red3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B0000" value="139,000,000">Red4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#BC8F8F" value="188,143,143">RosyBrown</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFC1C1" value="255,193,193">RosyBrown1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEB4B4" value="238,180,180">RosyBrown2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD9B9B" value="205,155,155">RosyBrown3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B6969" value="139,105,105">RosyBrown4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4169E1" value="065,105,225">RoyalBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4876FF" value="072,118,255">RoyalBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#436EEE" value="067,110,238">RoyalBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#3A5FCD" value="058,095,205">RoyalBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#27408B" value="039,064,139">RoyalBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B4513" value="139,069,019">SaddleBrown</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FA8072" value="250,128,114">Salmon</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF8C69" value="255,140,105">Salmon1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE8262" value="238,130,098">Salmon2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD7054" value="205,112,084">Salmon3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B4C39" value="139,076,057">Salmon4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F4A460" value="244,164,096">SandyBrown</option>';
            echo '<option class="badge badge-white tac" style="background-color:#2E8B57" value="046,139,087">SeaGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#54FF9F" value="084,255,159">SeaGreen1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4EEE94" value="078,238,148">SeaGreen2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#43CD80" value="067,205,128">SeaGreen3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#2E8B57" value="046,139,087">SeaGreen4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF5EE" value="255,245,238">Seashell</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFF5EE" value="255,245,238">Seashell1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE5DE" value="238,229,222">Seashell2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC5BF" value="205,197,191">Seashell3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8682" value="139,134,130">Seashell4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#A0522D" value="160,082,045">Sienna</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF8247" value="255,130,071">Sienna1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE7942" value="238,121,066">Sienna2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD6839" value="205,104,057">Sienna3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B4726" value="139,071,038">Sienna4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#87CEEB" value="135,206,235">SkyBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#87CEFF" value="135,206,255">SkyBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7EC0EE" value="126,192,238">SkyBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6CA6CD" value="108,166,205">SkyBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4A708B" value="074,112,139">SkyBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6A5ACD" value="106,090,205">SlateBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#836FFF" value="131,111,255">SlateBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#7A67EE" value="122,103,238">SlateBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6959CD" value="105,089,205">SlateBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#473C8B" value="071,060,139">SlateBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#708090" value="112,128,144">SlateGray</option>';
            echo '<option class="badge badge-white tac" style="background-color:#C6E2FF" value="198,226,255">SlateGray1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#B9D3EE" value="185,211,238">SlateGray2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9FB6CD" value="159,182,205">SlateGray3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#6C7B8B" value="108,123,139">SlateGray4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFAFA" value="255,250,250">Snow</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFAFA" value="255,250,250">Snow1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEE9E9" value="238,233,233">Snow2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDC9C9" value="205,201,201">Snow3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8989" value="139,137,137">Snow4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FF7F" value="000,255,127">SpringGreen</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00FF7F" value="000,255,127">SpringGreen1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00EE76" value="000,238,118">SpringGreen2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00CD66" value="000,205,102">SpringGreen3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#008B45" value="000,139,069">SpringGreen4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4682B4" value="070,130,180">SteelBlue</option>';
            echo '<option class="badge badge-white tac" style="background-color:#63B8FF" value="099,184,255">SteelBlue1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#5CACEE" value="092,172,238">SteelBlue2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#4F94CD" value="079,148,205">SteelBlue3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#36648B" value="054,100,139">SteelBlue4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D2B48C" value="210,180,140">Tan</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFA54F" value="255,165,079">Tan1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE9A49" value="238,154,073">Tan2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD853F" value="205,133,063">Tan3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B5A2B" value="139,090,043">Tan4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D8BFD8" value="216,191,216">Thistle</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE1FF" value="255,225,255">Thistle1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EED2EE" value="238,210,238">Thistle2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDB5CD" value="205,181,205">Thistle3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7B8B" value="139,123,139">Thistle4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF6347" value="255,099,071">Tomato</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF6347" value="255,099,071">Tomato1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE5C42" value="238,092,066">Tomato2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD4F39" value="205,079,057">Tomato3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B3626" value="139,054,038">Tomato4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#40E0D0" value="064,224,208">Turquoise</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00F5FF" value="000,245,255">Turquoise1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00E5EE" value="000,229,238">Turquoise2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00C5CD" value="000,197,205">Turquoise3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#00868B" value="000,134,139">Turquoise4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE82EE" value="238,130,238">Violet</option>';
            echo '<option class="badge badge-white tac" style="background-color:#D02090" value="208,032,144">VioletRed</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FF3E96" value="255,062,150">VioletRed1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EE3A8C" value="238,058,140">VioletRed2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CD3278" value="205,050,120">VioletRed3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B2252" value="139,034,082">VioletRed4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F5DEB3" value="245,222,179">Wheat</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFE7BA" value="255,231,186">Wheat1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EED8AE" value="238,216,174">Wheat2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDBA96" value="205,186,150">Wheat3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B7E66" value="139,126,102">Wheat4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFFFF" value="255,255,255">White</option>';
            echo '<option class="badge badge-white tac" style="background-color:#F5F5F5" value="245,245,245">WhiteSmoke</option>';
            echo '<option class="badge badge-white tac" style="background-color:#FFFF00" value="255,255,000">Yellow1</option>';
            echo '<option class="badge badge-white tac" style="background-color:#EEEE00" value="238,238,000">Yellow2</option>';
            echo '<option class="badge badge-white tac" style="background-color:#CDCD00" value="205,205,000">Yellow3</option>';
            echo '<option class="badge badge-white tac" style="background-color:#8B8B00" value="139,139,000">Yellow4</option>';
            echo '<option class="badge badge-white tac" style="background-color:#9ACD32" value="154,205,050">YellowGreen</option>';
            echo '</select>';
        }

        public function PANE_BG_TRANS()
        {
            echo '<select class="form-control" id="VALUE" name="VALUE">';
            echo '<option disabled selected>Color Transparency</option>';
            echo '<option value=".05">5%</option>';
            echo '<option value=".10">10%</option>';
            echo '<option value=".15">15%</option>';
            echo '<option value=".20">20%</option>';
            echo '<option value=".25">25%</option>';
            echo '<option value=".30">30%</option>';
            echo '<option value=".35">35%</option>';
            echo '<option value=".40">40%</option>';
            echo '<option value=".45">45%</option>';
            echo '<option value=".50">50%</option>';
            echo '<option value=".55">55%</option>';
            echo '<option value=".60">60%</option>';
            echo '<option value=".65">65%</option>';
            echo '<option value=".70">70%</option>';
            echo '<option value=".75">75%</option>';
            echo '<option value=".80">80%</option>';
            echo '<option value=".85">85%</option>';
            echo '<option value=".90">90%</option>';
            echo '<option value=".95">95%</option>';
            echo '<option value="1">100%</option>';
            echo '</select>';
        }

        public function _getTicketStatus()
        {
            echo '<select name="Status" class="form-control" id="Status">';
            echo '<option disabled selected>Select Status Type*</option>';
            echo '<option value="1">New</option>';
            echo '<option value="2">Updated</option>';
            echo '<option value="3">Awaiting Response</option>';
            echo '<option value="4">Closed</option>';
            echo '</select>';
        }
    }
