<?php

namespace Classes\Utils;

use Classes\DB\MSSQL;

class Select
{
    //TODO: clean this up, a lot of this is redundant.
    public function dobM()
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

    public function dobD()
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

    public function dobY()
    {
        echo '<select class="form-control" name="DOB_Y">';
            echo '<option value="N/A">Year</option>';
            echo '<option value="2020">2020</option>';
            echo '<option value="2019">2019</option>';
            echo '<option value="2018">2018</option>';
            echo '<option value="2017">2017</option>';
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

    public function secQuestion()
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
        for ($i = 0; $i < count($secArr); $i++) {
            $return .= '<option value="' . $i . '">' . $secArr[$i] . '</option>';
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

    public function pageShow()
    {
        echo '<select class="form-control" id="PAGE_SHOW" name="PAGE_SHOW">';
            echo '<option disabled selected>Show Page?</option>';
            echo '<option value="1">Yes</option>';
            echo '<option value="0">No</option>';
        echo '</select>';
    }

    public function reqLogin()
    {
        echo '<select class="form-control" id="req_login_select REQ_LOGIN" name="REQ_LOGIN">';
            echo '<option disabled selected>Require Login?</option>';
            echo '<option value="1">Yes</option>';
            echo '<option value="0">No</option>';
        echo '</select>';
    }

    public function acpStyle()
    {
        echo '<select class="form-control" name="STYLE_NAME">';
            echo '<option disabled selected>Select Theme*</option>';
            echo '<option value="Admin">Admin</option>';
        echo '</select>';
    }

    public function pluginOrder()
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

    public function pluginEnable()
    {
        echo '<select class="form-control" name="PLUGIN_ENABLE">';
            echo '<option disabled selected>Enable Plugin*</option>';
            echo '<option value="0">No</option>';
            echo '<option value="1">Yes</option>';
        echo '</select>';
    }

    public function backgroundColor()
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

    public function bit()
    {
        echo '<select class="form-control" name="VALUE">';
            echo '<option disabled selected>Enable/Disable</option>';
            echo '<option value="1">Enabled</option>';
            echo '<option value="0">Disabled</option>';
        echo '</select>';
    }

    public function cmsTheme()
    {
        echo '<select class="form-control" name="VALUE">';
            echo '<option disabled selected>Choose a Theme</option>';
            echo '<option value="Glazed">Glazed</option>';
            echo '<option value="Shadows">Shadows</option>';
            echo '<option value="Surface">Surface</option>';
        echo '</select>';
    }

    public function sidebarPos()
    {
        echo '<select class="form-control tac col-md-6" name="VALUE">';
            echo '<option disabled selected>Sidebar Position</option>';
            echo '<option value="0">No Sidebar</option>';
            echo '<option value="1">Left</option>';
            echo '<option value="2">Right</option>';
        echo '</select>';
    }

    public function acctBan()
    {
        echo '<select class="form-control" name="Length">';
            echo '<option disabled selected>Ban Length</option>';
            echo '<option value="12hr">12 Hours</option>';
            echo '<option value="5days">5 Days</option>';
            echo '<option value="2weeks">2 Weeks</option>';
            echo '<option value="perma">Permanent</option>';
        echo '</select>';
    }

    public function getTicketStatus()
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
