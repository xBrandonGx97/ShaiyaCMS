<?php

namespace Classes\Utils;

class Colors
{
    private $colors = [
        'AliceBlue' => [
            'hex' => 'F0F8FF',
            'rgb' => '240,248,255'
        ],
        'AntiqueWhite' => [
            'hex' => 'FAEBD7',
            'rgb' => '250,235,215'
        ],
        'AntiqueWhite1' => [
            'hex' => 'FFEFDB',
            'rgb' => '255,239,219'
        ],
        'AntiqueWhite2' => [
            'hex' => 'EEDFCC',
            'rgb' => '238,223,204'
        ],
        'AntiqueWhite3' => [
            'hex' => 'CDC0B0',
            'rgb' => '205,192,176'
        ],
        'AntiqueWhite4' => [
            'hex' => '8B8378',
            'rgb' => '139,131,120'
        ],
        'Aquamarine' => [
            'hex' => '7FFFD4',
            'rgb' => '127,255,212'
        ],
        'Aquamarine1' => [
            'hex' => '7FFFD4',
            'rgb' => '127,255,212'
        ],
        'Aquamarine2' => [
            'hex' => '76EEC6',
            'rgb' => '118,238,198'
        ],
        'Aquamarine3' => [
            'hex' => '66CDAA',
            'rgb' => '102,205,170'
        ],
        'Aquamarine4' => [
            'hex' => '458B74',
            'rgb' => '069,139,116'
        ],
        'Azure' => [
            'hex' => 'F0FFFF',
            'rgb' => '240,255,255'
        ],
        'Azure1' => [
            'hex' => 'F0FFFF',
            'rgb' => '240,255,255'
        ],
        'Azure2' => [
            'hex' => 'E0EEEE',
            'rgb' => '224,238,238'
        ],
        'Azure3' => [
            'hex' => 'C1CDCD',
            'rgb' => '193,205,205'
        ],
        'Azure4' => [
            'hex' => '838B8B',
            'rgb' => '131,139,139'
        ],
        'Beige' => [
            'hex' => 'F5F5DC',
            'rgb' => '245,245,220'
        ],
        'Bisque' => [
            'hex' => 'FFE4C4',
            'rgb' => '255,228,196'
        ],
        'Bisque1' => [
            'hex' => 'FFE4C4',
            'rgb' => '255,228,196'
        ],
        'Bisque2' => [
            'hex' => 'EED5B7',
            'rgb' => '238,213,183'
        ],
        'Bisque3' => [
            'hex' => 'CDB79E',
            'rgb' => '205,183,158'
        ],
        'Bisque4' => [
            'hex' => '8B7D6B',
            'rgb' => '139,125,107'
        ],
        'Black' => [
            'hex' => '000000',
            'rgb' => '000,000,000'
        ],
        'BlanchedAlmond' => [
            'hex' => 'FFEBCD',
            'rgb' => '255,228,196'
        ],
        'Blue' => [
            'hex' => '0000FF',
            'rgb' => '000,000,255'
        ],
        'Blue1' => [
            'hex' => '0000FF',
            'rgb' => '000,000,255'
        ],
        'Blue2' => [
            'hex' => '0000EE',
            'rgb' => '000,000,238'
        ],
        'Blue3' => [
            'hex' => '0000CD',
            'rgb' => '000,000,205'
        ],
        'Blue4' => [
            'hex' => '00008B',
            'rgb' => '000,000,139'
        ],
        'BlueViolet' => [
            'hex' => '8A2BE2',
            'rgb' => '138,043,226'
        ],
        'Brown' => [
            'hex' => 'A52A2A',
            'rgb' => '165,042,042'
        ],
        'Brown1' => [
            'hex' => 'FF4040',
            'rgb' => '255,064,064'
        ],
        'Brown2' => [
            'hex' => 'EE3B3B',
            'rgb' => '238,059,059'
        ],
        'Brown3' => [
            'hex' => 'CD3333',
            'rgb' => '205,051,051'
        ],
        'Brown4' => [
            'hex' => '8B2323',
            'rgb' => '139,035,035'
        ],
        'Burlywood' => [
            'hex' => 'DEB887',
            'rgb' => '222,184,135'
        ],
        'Burlywood1' => [
            'hex' => 'FFD39B',
            'rgb' => '255,211,155'
        ],
        'Burlywood2' => [
            'hex' => 'EEC591',
            'rgb' => '238,197,145'
        ],
        'Burlywood3' => [
            'hex' => 'CDAA7D',
            'rgb' => '205,170,125'
        ],
        'Burlywood4' => [
            'hex' => '8B7355',
            'rgb' => '139,115,085'
        ],
        'CadetBlue' => [
            'hex' => '5F9EA0',
            'rgb' => '095,158,160'
        ],
        'CadetBlue1' => [
            'hex' => '98F5FF',
            'rgb' => '152,245,255'
        ],
        'CadetBlue2' => [
            'hex' => '8EE5EE',
            'rgb' => '142,229,238'
        ],
        'CadetBlue3' => [
            'hex' => '7AC5CD',
            'rgb' => '122,197,205'
        ],
        'CadetBlue4' => [
            'hex' => '53868B',
            'rgb' => '083,134,139'
        ],
        'Chartreuse' => [
            'hex' => '7FFF00',
            'rgb' => '127,255,000'
        ],
        'Chartreuse1' => [
            'hex' => '7FFF00',
            'rgb' => '127,255,000'
        ],
        'Chartreuse2' => [
            'hex' => '76EE00',
            'rgb' => '118,238,000'
        ],
        'Chartreuse3' => [
            'hex' => '66CD00',
            'rgb' => '102,205,000'
        ],
        'Chartreuse4' => [
            'hex' => '458B00',
            'rgb' => '069,139,000'
        ],
        'Chocolate' => [
            'hex' => 'D2691E',
            'rgb' => '210,105,030'
        ],
        'Chocolate1' => [
            'hex' => 'FF7F24',
            'rgb' => '255,127,036'
        ],
        'Chocolate2' => [
            'hex' => 'EE7621',
            'rgb' => '238,118,033'
        ],
        'Chocolate3' => [
            'hex' => 'CD661D',
            'rgb' => '205,102,029'
        ],
        'Chocolate4' => [
            'hex' => '8B4513',
            'rgb' => '139,069,019'
        ],
        'Coral' => [
            'hex' => 'FF7F50',
            'rgb' => '255,127,080'
        ],
        'Coral1' => [
            'hex' => 'FF7256',
            'rgb' => '255,114,086'
        ],
        'Coral2' => [
            'hex' => 'EE6A50',
            'rgb' => '238,106,080'
        ],
        'Coral3' => [
            'hex' => 'CD5B45',
            'rgb' => '205,091,069'
        ],
        'Coral4' => [
            'hex' => '8B3E2F',
            'rgb' => '139,062,047'
        ],
        'CornflowerBlue' => [
            'hex' => '6495ED',
            'rgb' => '100,149,237'
        ],
        'Cornsilk' => [
            'hex' => 'FFF8DC',
            'rgb' => '255,248,220'
        ],
        'Cornsilk1' => [
            'hex' => 'FFF8DC',
            'rgb' => '255,248,220'
        ],
        'Cornsilk2' => [
            'hex' => 'EEE8CD',
            'rgb' => '238,232,205'
        ],
        'Cornsilk3' => [
            'hex' => 'CDC8B1',
            'rgb' => '205,200,177'
        ],
        'Cornsilk4' => [
            'hex' => '8B8878',
            'rgb' => '139,136,120'
        ],
        'Cyan' => [
            'hex' => '00FFFF',
            'rgb' => '000,255,255'
        ],
        'Cyan1' => [
            'hex' => '00FFFF',
            'rgb' => '000,255,255'
        ],
        'Cyan2' => [
            'hex' => '00EEEE',
            'rgb' => '000,238,238'
        ],
        'Cyan3' => [
            'hex' => '00CDCD',
            'rgb' => '000,205,205'
        ],
        'Cyan4' => [
            'hex' => '008B8B',
            'rgb' => '000,139,139'
        ],
        'DarkBlue' => [
            'hex' => '00008B',
            'rgb' => '000,000,139'
        ],
        'DarkCyan' => [
            'hex' => '008B8B',
            'rgb' => '000,139,139'
        ],
        'DarkGoldenrod' => [
            'hex' => 'B8860B',
            'rgb' => '184,134,011'
        ],
        'DarkGoldenrod1' => [
            'hex' => 'FFB90F',
            'rgb' => '255,185,015'
        ],
        'DarkGoldenrod2' => [
            'hex' => 'EEAD0E',
            'rgb' => '238,173,014'
        ],
        'DarkGoldenrod3' => [
            'hex' => 'CD950C',
            'rgb' => '205,149,012'
        ],
        'DarkGoldenrod4' => [
            'hex' => '8B6508',
            'rgb' => '139,101,008'
        ],
        'DarkGray' => [
            'hex' => 'A9A9A9',
            'rgb' => '169,169,169'
        ],
        'DarkGreen' => [
            'hex' => '006400',
            'rgb' => '000,100,000'
        ],
        'DarkKhaki' => [
            'hex' => 'BDB76B',
            'rgb' => '189,183,107'
        ],
        'DarkMagenta' => [
            'hex' => '8B008B',
            'rgb' => '139,000,139'
        ],
        'DarkOliveGreen' => [
            'hex' => '556B2F',
            'rgb' => '085,107,047'
        ],
        'DarkOliveGreen1' => [
            'hex' => 'CAFF70',
            'rgb' => '202,255,112'
        ],
        'DarkOliveGreen2' => [
            'hex' => 'BCEE68',
            'rgb' => '188,238,104'
        ],
        'DarkOliveGreen3' => [
            'hex' => 'A2CD5A',
            'rgb' => '162,205,090'
        ],
        'DarkOliveGreen4' => [
            'hex' => '6E8B3D',
            'rgb' => '110,139,061'
        ],
        'DarkOrange' => [
            'hex' => 'FF8C00',
            'rgb' => '255,140,000'
        ],
        'DarkOrange1' => [
            'hex' => 'FF7F00',
            'rgb' => '255,127,000'
        ],
        'DarkOrange2' => [
            'hex' => 'EE7600',
            'rgb' => '238,118,000'
        ],
        'DarkOrange3' => [
            'hex' => 'CD6600',
            'rgb' => '205,102,000'
        ],
        'DarkOrange4' => [
            'hex' => '8B4500',
            'rgb' => '139,069,000'
        ],
        'DarkOrchid' => [
            'hex' => '9932CC',
            'rgb' => '153,050,204'
        ],
        'DarkOrchid1' => [
            'hex' => 'BF3EFF',
            'rgb' => '191,062,255'
        ],
        'DarkOrchid2' => [
            'hex' => 'B23AEE',
            'rgb' => '178,058,238'
        ],
        'DarkOrchid3' => [
            'hex' => '9A32CD',
            'rgb' => '154,050,205'
        ],
        'DarkOrchid4' => [
            'hex' => '68228B',
            'rgb' => '104,034,139'
        ],
        'DarkRed' => [
            'hex' => '8B0000',
            'rgb' => '139,000,000'
        ],
        'DarkSalmon' => [
            'hex' => 'E9967A',
            'rgb' => '233,150,122'
        ],
        'DarkSeaGreen' => [
            'hex' => '8FBC8F',
            'rgb' => '143,188,143'
        ],
        'DarkSeaGreen1' => [
            'hex' => 'C1FFC1',
            'rgb' => '193,255,193'
        ],
        'DarkSeaGreen2' => [
            'hex' => 'B4EEB4',
            'rgb' => '180,238,180'
        ],
        'DarkSeaGreen3' => [
            'hex' => '9BCD9B',
            'rgb' => '155,205,155'
        ],
        'DarkSeaGreen4' => [
            'hex' => '698B69',
            'rgb' => '105,139,105'
        ],
        'DarkSlateBlue' => [
            'hex' => '483D8B',
            'rgb' => '072,061,139'
        ],
        'DarkSlateGray' => [
            'hex' => '2F4F4F',
            'rgb' => '047,079,079'
        ],
        'DarkSlateGray1' => [
            'hex' => '97FFFF',
            'rgb' => '151,255,255'
        ],
        'DarkSlateGray2' => [
            'hex' => '8DEEEE',
            'rgb' => '141,238,238'
        ],
        'DarkSlateGray3' => [
            'hex' => '79CDCD',
            'rgb' => '121,205,205'
        ],
        'DarkSlateGray4' => [
            'hex' => '528B8B',
            'rgb' => '082,139,139'
        ],
        'DarkTurquoise' => [
            'hex' => '00CED1',
            'rgb' => '000,206,209'
        ],
        'DarkViolet' => [
            'hex' => '9400D3',
            'rgb' => '148,000,211'
        ],
        'DeepPink' => [
            'hex' => 'FF1493',
            'rgb' => '255,020,147'
        ],
        'DeepPink1' => [
            'hex' => 'FF1493',
            'rgb' => '255,020,147'
        ],
        'DeepPink2' => [
            'hex' => 'EE1289',
            'rgb' => '238,018,137'
        ],
        'DeepPink3' => [
            'hex' => 'CD1076',
            'rgb' => '205,016,118'
        ],
        'DeepPink4' => [
            'hex' => '8B0A50',
            'rgb' => '139,010,080'
        ],
        'DeepSkyBlue' => [
            'hex' => '00BFFF',
            'rgb' => '000,191,255'
        ],
        'DeepSkyBlue1' => [
            'hex' => '00BFFF',
            'rgb' => '000,191,255'
        ],
        'DeepSkyBlue2' => [
            'hex' => '00B2EE',
            'rgb' => '000,178,238'
        ],
        'DeepSkyBlue3' => [
            'hex' => '009ACD',
            'rgb' => '000,154,205'
        ],
        'DeepSkyBlue4' => [
            'hex' => '00688B',
            'rgb' => '000,104,139'
        ],
        'DimGray' => [
            'hex' => '696969',
            'rgb' => '105,105,105'
        ],
        'DodgerBlue' => [
            'hex' => '1E90FF',
            'rgb' => '030,144,255'
        ],
        'DodgerBlue1' => [
            'hex' => '1E90FF',
            'rgb' => '030,144,255'
        ],
        'DodgerBlue2' => [
            'hex' => '1C86EE',
            'rgb' => '028,134,238'
        ],
        'DodgerBlue3' => [
            'hex' => '1874CD',
            'rgb' => '024,116,205'
        ],
        'DodgerBlue4' => [
            'hex' => '104E8B',
            'rgb' => '016,078,139'
        ],
        'Firebrick' => [
            'hex' => 'B22222',
            'rgb' => '178,034,034'
        ],
        'Firebrick1' => [
            'hex' => 'FF3030',
            'rgb' => '255,048,048'
        ],
        'Firebrick2' => [
            'hex' => 'EE2C2C',
            'rgb' => '238,044,044'
        ],
        'Firebrick3' => [
            'hex' => 'CD2626',
            'rgb' => '205,038,038'
        ],
        'Firebrick4' => [
            'hex' => '8B1A1A',
            'rgb' => '139,026,026'
        ],
        'FloralWhite' => [
            'hex' => 'FFFAF0',
            'rgb' => '255,250,240'
        ],
        'ForestGreen' => [
            'hex' => '228B22',
            'rgb' => '034,139,034'
        ],
        'Gainsboro' => [
            'hex' => 'DCDCDC',
            'rgb' => '220,220,220'
        ],
        'GhostWhite' => [
            'hex' => 'F8F8FF',
            'rgb' => '248,248,255'
        ],
        'Gold' => [
            'hex' => 'FFD700',
            'rgb' => '255,215,000'
        ],
        'Gold1' => [
            'hex' => 'FFD700',
            'rgb' => '255,215,000'
        ],
        'Gold2' => [
            'hex' => 'EEC900',
            'rgb' => '238,201,000'
        ],
        'Gold3' => [
            'hex' => 'CDAD00',
            'rgb' => '205,173,000'
        ],
        'Gold4' => [
            'hex' => '8B7500',
            'rgb' => '139,117,000'
        ],
        'Goldenrod' => [
            'hex' => 'DAA520',
            'rgb' => '218,165,032'
        ],
        'Goldenrod1' => [
            'hex' => 'FFC125',
            'rgb' => '255,193,037'
        ],
        'Goldenrod2' => [
            'hex' => 'EEB422',
            'rgb' => '238,180,034'
        ],
        'Goldenrod3' => [
            'hex' => 'CD9B1D',
            'rgb' => '205,155,029'
        ],
        'Goldenrod4' => [
            'hex' => '8B6914',
            'rgb' => '139,105,020'
        ],
        'Gray' => [
            'hex' => 'BEBEBE',
            'rgb' => '190,190,190'
        ],
        'Gray0' => [
            'hex' => '000000',
            'rgb' => '000,000,000'
        ],
        'Gray1' => [
            'hex' => '030303',
            'rgb' => '003,003,003'
        ],
        'Gray10' => [
            'hex' => '1A1A1A',
            'rgb' => '026,026,026'
        ],
        'Gray100' => [
            'hex' => 'FFFFFF',
            'rgb' => '255,255,255'
        ],
        'Gray11' => [
            'hex' => '1C1C1C',
            'rgb' => '028,028,028'
        ],
        'Gray12' => [
            'hex' => '1F1F1F',
            'rgb' => '031,031,031'
        ],
        'Gray13' => [
            'hex' => '212121',
            'rgb' => '033,033,033'
        ],
        'Gray14' => [
            'hex' => '242424',
            'rgb' => '036,036,036'
        ],
        'Gray15' => [
            'hex' => '262626',
            'rgb' => '038,038,038'
        ],
        'Gray16' => [
            'hex' => '292929',
            'rgb' => '041,041,041'
        ],
        'Gray17' => [
            'hex' => '2B2B2B',
            'rgb' => '043,043,043'
        ],
        'Gray18' => [
            'hex' => '2E2E2E',
            'rgb' => '046,046,046'
        ],
        'Gray19' => [
            'hex' => '303030',
            'rgb' => '048,048,048'
        ],
        'Gray2' => [
            'hex' => '050505',
            'rgb' => '005,005,005'
        ],
        'Gray20' => [
            'hex' => '333333',
            'rgb' => '051,051,051'
        ],
        'Gray21' => [
            'hex' => '363636',
            'rgb' => '054,054,054'
        ],
        'Gray22' => [
            'hex' => '383838',
            'rgb' => '056,056,056'
        ],
        'Gray23' => [
            'hex' => '3B3B3B',
            'rgb' => '059,059,059'
        ],
        'Gray24' => [
            'hex' => '3D3D3D',
            'rgb' => '061,061,061'
        ],
        'Gray25' => [
            'hex' => '404040',
            'rgb' => '064,064,064'
        ],
        'Gray26' => [
            'hex' => '424242',
            'rgb' => '066,066,066'
        ],
        'Gray27' => [
            'hex' => '454545',
            'rgb' => '069,069,069'
        ],
        'Gray28' => [
            'hex' => '474747',
            'rgb' => '071,071,071'
        ],
        'Gray29' => [
            'hex' => '4A4A4A',
            'rgb' => '074,074,074'
        ],
        'Gray3' => [
            'hex' => '080808',
            'rgb' => '008,008,008'
        ],
        'Gray30' => [
            'hex' => '4D4D4D',
            'rgb' => '077,077,077'
        ],
        'Gray31' => [
            'hex' => '4F4F4F',
            'rgb' => '079,079,079'
        ],
        'Gray32' => [
            'hex' => '525252',
            'rgb' => '082,082,082'
        ],
        'Gray33' => [
            'hex' => '545454',
            'rgb' => '084,084,084'
        ],
        'Gray34' => [
            'hex' => '575757',
            'rgb' => '087,087,087'
        ],
        'Gray35' => [
            'hex' => '595959',
            'rgb' => '089,089,089'
        ],
        'Gray36' => [
            'hex' => '5C5C5C',
            'rgb' => '092,092,092'
        ],
        'Gray37' => [
            'hex' => '5E5E5E',
            'rgb' => '094,094,094'
        ],
        'Gray38' => [
            'hex' => '616161',
            'rgb' => '097,097,097'
        ],
        'Gray39' => [
            'hex' => '636363',
            'rgb' => '099,099,099'
        ],
        'Gray4' => [
            'hex' => '0A0A0A',
            'rgb' => '010,010,010'
        ],
        'Gray40' => [
            'hex' => '666666',
            'rgb' => '102,102,102'
        ],
        'Gray41' => [
            'hex' => '696969',
            'rgb' => '105,105,105'
        ],
        'Gray42' => [
            'hex' => '6B6B6B',
            'rgb' => '107,107,107'
        ],
        'Gray43' => [
            'hex' => '6E6E6E',
            'rgb' => '110,110,110'
        ],
        'Gray44' => [
            'hex' => '707070',
            'rgb' => '112,112,112'
        ],
        'Gray45' => [
            'hex' => '737373',
            'rgb' => '115,115,115'
        ],
        'Gray46' => [
            'hex' => '757575',
            'rgb' => '117,117,117'
        ],
        'Gray47' => [
            'hex' => '787878',
            'rgb' => '120,120,120'
        ],
        'Gray48' => [
            'hex' => '7A7A7A',
            'rgb' => '122,122,122'
        ],
        'Gray49' => [
            'hex' => '7D7D7D',
            'rgb' => '125,125,125'
        ],
        'Gray5' => [
            'hex' => '0D0D0D',
            'rgb' => '013,013,013'
        ],
        'Gray50' => [
            'hex' => '7F7F7F',
            'rgb' => '127,127,127'
        ],
        'Gray51' => [
            'hex' => '828282',
            'rgb' => '130,130,130'
        ],
        'Gray52' => [
            'hex' => '858585',
            'rgb' => '133,133,133'
        ],
        'Gray53' => [
            'hex' => '878787',
            'rgb' => '135,135,135'
        ],
        'Gray54' => [
            'hex' => '8A8A8A',
            'rgb' => '138,138,138'
        ],
        'Gray55' => [
            'hex' => '8C8C8C',
            'rgb' => '140,140,140'
        ],
        'Gray56' => [
            'hex' => '8F8F8F',
            'rgb' => '143,143,143'
        ],
        'Gray57' => [
            'hex' => '919191',
            'rgb' => '145,145,145'
        ],
        'Gray58' => [
            'hex' => '949494',
            'rgb' => '148,148,148'
        ],
        'Gray59' => [
            'hex' => '969696',
            'rgb' => '150,150,150'
        ],
        'Gray6' => [
            'hex' => '0F0F0F',
            'rgb' => '015,015,015'
        ],
        'Gray60' => [
            'hex' => '999999',
            'rgb' => '153,153,153'
        ],
        'Gray61' => [
            'hex' => '9C9C9C',
            'rgb' => '156,156,156'
        ],
        'Gray62' => [
            'hex' => '9E9E9E',
            'rgb' => '158,158,158'
        ],
        'Gray63' => [
            'hex' => 'A1A1A1',
            'rgb' => '161,161,161'
        ],
        'Gray64' => [
            'hex' => 'A3A3A3',
            'rgb' => '163,163,163'
        ],
        'Gray65' => [
            'hex' => 'A6A6A6',
            'rgb' => '166,166,166'
        ],
        'Gray66' => [
            'hex' => 'A8A8A8',
            'rgb' => '168,168,168'
        ],
        'Gray67' => [
            'hex' => 'ABABAB',
            'rgb' => '171,171,171'
        ],
        'Gray68' => [
            'hex' => 'ADADAD',
            'rgb' => '173,173,173'
        ],
        'Gray69' => [
            'hex' => 'B0B0B0',
            'rgb' => '176,176,176'
        ],
        'Gray7' => [
            'hex' => '121212',
            'rgb' => '018,018,018'
        ],
        'Gray70' => [
            'hex' => 'B3B3B3',
            'rgb' => '179,179,179'
        ],
        'Gray71' => [
            'hex' => 'B5B5B5',
            'rgb' => '181,181,181'
        ],
        'Gray72' => [
            'hex' => 'B8B8B8',
            'rgb' => '184,184,184'
        ],
        'Gray73' => [
            'hex' => 'BABABA',
            'rgb' => '186,186,186'
        ],
        'Gray74' => [
            'hex' => 'BDBDBD',
            'rgb' => '189,189,189'
        ],
        'Gray75' => [
            'hex' => 'BFBFBF',
            'rgb' => '191,191,191'
        ],
        'Gray76' => [
            'hex' => 'C2C2C2',
            'rgb' => '194,194,194'
        ],
        'Gray77' => [
            'hex' => 'C4C4C4',
            'rgb' => '196,196,196'
        ],
        'Gray78' => [
            'hex' => 'C7C7C7',
            'rgb' => '199,199,199'
        ],
        'Gray79' => [
            'hex' => 'C9C9C9',
            'rgb' => '201,201,201'
        ],
        'Gray8' => [
            'hex' => '141414',
            'rgb' => '020,020,020'
        ],
        'Gray80' => [
            'hex' => 'CCCCCC',
            'rgb' => '204,204,204'
        ],
        'Gray81' => [
            'hex' => 'CFCFCF',
            'rgb' => '207,207,207'
        ],
        'Gray82' => [
            'hex' => 'D1D1D1',
            'rgb' => '209,209,209'
        ],
        'Gray83' => [
            'hex' => 'D4D4D4',
            'rgb' => '212,212,212'
        ],
        'Gray84' => [
            'hex' => 'D6D6D6',
            'rgb' => '214,214,214'
        ],
        'Gray85' => [
            'hex' => 'D9D9D9',
            'rgb' => '217,217,217'
        ],
        'Gray86' => [
            'hex' => 'DBDBDB',
            'rgb' => '219,219,219'
        ],
        'Gray87' => [
            'hex' => 'DEDEDE',
            'rgb' => '222,222,222'
        ],
        'Gray88' => [
            'hex' => 'E0E0E0',
            'rgb' => '224,224,224'
        ],
        'Gray89' => [
            'hex' => 'E3E3E3',
            'rgb' => '227,227,227'
        ],
        'Gray9' => [
            'hex' => '171717',
            'rgb' => '023,023,023'
        ],
        'Gray90' => [
            'hex' => 'E5E5E5',
            'rgb' => '229,229,229'
        ],
        'Gray91' => [
            'hex' => 'E8E8E8',
            'rgb' => '232,232,232'
        ],
        'Gray92' => [
            'hex' => 'EBEBEB',
            'rgb' => '235,235,235'
        ],
        'Gray93' => [
            'hex' => 'EDEDED',
            'rgb' => '237,237,237'
        ],
        'Gray94' => [
            'hex' => 'F0F0F0',
            'rgb' => '240,240,240'
        ],
        'Gray95' => [
            'hex' => 'F2F2F2',
            'rgb' => '242,242,242'
        ],
        'Gray96' => [
            'hex' => 'F5F5F5',
            'rgb' => '245,245,245'
        ],
        'Gray97' => [
            'hex' => 'F7F7F7',
            'rgb' => '247,247,247'
        ],
        'Gray98' => [
            'hex' => 'FAFAFA',
            'rgb' => '250,250,250'
        ],
        'Gray99' => [
            'hex' => 'FCFCFC',
            'rgb' => '252,252,252'
        ],
        'Green' => [
            'hex' => '00FF00',
            'rgb' => '000,255,000'
        ],
        'Green1' => [
            'hex' => '00FF00',
            'rgb' => '000,255,000'
        ],
        'Green2' => [
            'hex' => '00EE00',
            'rgb' => '000,238,000'
        ],
        'Green3' => [
            'hex' => '00CD00',
            'rgb' => '000,205,000'
        ],
        'Green4' => [
            'hex' => '008B00',
            'rgb' => '000,139,000'
        ],
        'GreenYellow' => [
            'hex' => 'ADFF2F',
            'rgb' => '173,255,047'
        ],
        'Honeydew' => [
            'hex' => 'F0FFF0',
            'rgb' => '240,255,240'
        ],
        'Honeydew1' => [
            'hex' => 'F0FFF0',
            'rgb' => '240,255,240'
        ],
        'Honeydew2' => [
            'hex' => 'E0EEE0',
            'rgb' => '224,238,224'
        ],
        'Honeydew3' => [
            'hex' => 'C1CDC1',
            'rgb' => '193,205,193'
        ],
        'Honeydew4' => [
            'hex' => '838B83',
            'rgb' => '131,139,131'
        ],
        'HotPink' => [
            'hex' => 'FF69B4',
            'rgb' => '255,105,180'
        ],
        'HotPink1' => [
            'hex' => 'FF6EB4',
            'rgb' => '255,110,180'
        ],
        'HotPink2' => [
            'hex' => 'EE6AA7',
            'rgb' => '238,106,167'
        ],
        'HotPink3' => [
            'hex' => 'CD6090',
            'rgb' => '205,096,144'
        ],
        'HotPink4' => [
            'hex' => '8B3A62',
            'rgb' => '139,058,098'
        ],
        'IndianRed1' => [
            'hex' => 'FF6A6A',
            'rgb' => '255,106,106'
        ],
        'IndianRed2' => [
            'hex' => 'EE6363',
            'rgb' => '238,099,099'
        ],
        'IndianRed3' => [
            'hex' => 'CD5555',
            'rgb' => '205,085,085'
        ],
        'IndianRed4' => [
            'hex' => '8B3A3A',
            'rgb' => '139,058,058'
        ],
        'Ivory' => [
            'hex' => 'FFFFF0',
            'rgb' => '255,255,240'
        ],
        'Ivory1' => [
            'hex' => 'FFFFF0',
            'rgb' => '255,255,240'
        ],
        'Ivory2' => [
            'hex' => 'EEEEE0',
            'rgb' => '238,238,224'
        ],
        'Ivory3' => [
            'hex' => 'CDCDC1',
            'rgb' => '205,205,193'
        ],
        'Ivory4' => [
            'hex' => '8B8B83',
            'rgb' => '139,139,131'
        ],
        'Khaki' => [
            'hex' => 'F0E68C',
            'rgb' => '240,230,140'
        ],
        'Khaki1' => [
            'hex' => 'FFF68F',
            'rgb' => '255,246,143'
        ],
        'Khaki2' => [
            'hex' => 'EEE685',
            'rgb' => '238,230,133'
        ],
        'Khaki3' => [
            'hex' => 'CDC673',
            'rgb' => '205,198,115'
        ],
        'Khaki4' => [
            'hex' => '8B864E',
            'rgb' => '139,134,078'
        ],
        'Lavender' => [
            'hex' => 'E6E6FA',
            'rgb' => '230,230,250'
        ],
        'LavenderBlush' => [
            'hex' => 'FFF0F5',
            'rgb' => '255,240,245'
        ],
        'LavenderBlush1' => [
            'hex' => 'FFF0F5',
            'rgb' => '255,240,245'
        ],
        'LavenderBlush2' => [
            'hex' => 'EEE0E5',
            'rgb' => '238,224,229'
        ],
        'LavenderBlush3' => [
            'hex' => 'CDC1C5',
            'rgb' => '205,193,197'
        ],
        'LavenderBlush4' => [
            'hex' => '8B8386',
            'rgb' => '139,131,134'
        ],
        'LawnGreen' => [
            'hex' => '7CFC00',
            'rgb' => '124,252,000'
        ],
        'LemonChiffon' => [
            'hex' => 'FFFACD',
            'rgb' => '255,250,205'
        ],
        'LemonChiffon1' => [
            'hex' => 'FFFACD',
            'rgb' => '255,250,205'
        ],
        'LemonChiffon2' => [
            'hex' => 'EEE9BF',
            'rgb' => '238,233,191'
        ],
        'LemonChiffon3' => [
            'hex' => 'CDC9A5',
            'rgb' => '205,201,165'
        ],
        'LemonChiffon4' => [
            'hex' => '8B8970',
            'rgb' => '139,137,112'
        ],
        'LightBlue' => [
            'hex' => 'ADD8E6',
            'rgb' => '173,216,230'
        ],
        'LightBlue1' => [
            'hex' => 'BFEFFF',
            'rgb' => '191,239,255'
        ],
        'LightBlue2' => [
            'hex' => 'B2DFEE',
            'rgb' => '178,223,238'
        ],
        'LightBlue3' => [
            'hex' => '9AC0CD',
            'rgb' => '154,192,205'
        ],
        'LightBlue4' => [
            'hex' => '68838B',
            'rgb' => '104,131,139'
        ],
        'LightCoral' => [
            'hex' => 'F08080',
            'rgb' => '240,128,128'
        ],
        'LightCyan' => [
            'hex' => 'E0FFFF',
            'rgb' => '224,255,255'
        ],
        'LightCyan1' => [
            'hex' => 'E0FFFF',
            'rgb' => '224,255,255'
        ],
        'LightCyan2' => [
            'hex' => 'D1EEEE',
            'rgb' => '209,238,238'
        ],
        'LightCyan3' => [
            'hex' => 'B4CDCD',
            'rgb' => '180,205,205'
        ],
        'LightCyan4' => [
            'hex' => '7A8B8B',
            'rgb' => '122,139,139'
        ],
        'LightGoldenrod' => [
            'hex' => 'EEDD82',
            'rgb' => '238,221,130'
        ],
        'LightGoldenrod1' => [
            'hex' => 'FFEC8B',
            'rgb' => '255,236,139'
        ],
        'LightGoldenrod2' => [
            'hex' => 'EEDC82',
            'rgb' => '238,220,130'
        ],
        'LightGoldenrod3' => [
            'hex' => 'CDBE70',
            'rgb' => '205,190,112'
        ],
        'LightGoldenrod4' => [
            'hex' => '8B814C',
            'rgb' => '139,129,076'
        ],
        'LightGoldenrodYellow' => [
            'hex' => 'FAFAD2',
            'rgb' => '250,250,210'
        ],
        'LightGray' => [
            'hex' => 'D3D3D3',
            'rgb' => '211,211,211'
        ],
        'LightGreen' => [
            'hex' => '90EE90',
            'rgb' => '144,238,144'
        ],
        'LightPink' => [
            'hex' => 'FFB6C1',
            'rgb' => '255,182,193'
        ],
        'LightPink1' => [
            'hex' => 'FFAEB9',
            'rgb' => '255,174,185'
        ],
        'LightPink2' => [
            'hex' => 'EEA2AD',
            'rgb' => '238,162,173'
        ],
        'LightPink3' => [
            'hex' => 'CD8C95',
            'rgb' => '205,140,149'
        ],
        'LightPink4' => [
            'hex' => '8B5F65',
            'rgb' => '139,095,101'
        ],
        'LightSalmon' => [
            'hex' => 'FFA07A',
            'rgb' => '255,160,122'
        ],
        'LightSalmon1' => [
            'hex' => 'FFA07A',
            'rgb' => '255,160,122'
        ],
        'LightSalmon2' => [
            'hex' => 'EE9572',
            'rgb' => '238,149,114'
        ],
        'LightSalmon3' => [
            'hex' => 'CD8162',
            'rgb' => '205,129,098'
        ],
        'LightSalmon4' => [
            'hex' => '8B5742',
            'rgb' => '139,087,066'
        ],
        'LightSeaGreen' => [
            'hex' => '20B2AA',
            'rgb' => '032,178,170'
        ],
        'LightSkyBlue' => [
            'hex' => '87CEFA',
            'rgb' => '135,206,250'
        ],
        'LightSkyBlue1' => [
            'hex' => 'B0E2FF',
            'rgb' => '176,226,255'
        ],
        'LightSkyBlue2' => [
            'hex' => 'A4D3EE',
            'rgb' => '164,211,238'
        ],
        'LightSkyBlue3' => [
            'hex' => '8DB6CD',
            'rgb' => '141,182,205'
        ],
        'LightSkyBlue4' => [
            'hex' => '607B8B',
            'rgb' => '096,123,139'
        ],
        'LightSlateBlue' => [
            'hex' => '8470FF',
            'rgb' => '132,112,255'
        ],
        'LightSlateGray' => [
            'hex' => '778899',
            'rgb' => '119,136,153'
        ],
        'LightSteelBlue' => [
            'hex' => 'B0C4DE',
            'rgb' => '176,196,222'
        ],
        'LightSteelBlue1' => [
            'hex' => 'CAE1FF',
            'rgb' => '202,225,255'
        ],
        'LightSteelBlue2' => [
            'hex' => 'BCD2EE',
            'rgb' => '188,210,238'
        ],
        'LightSteelBlue3' => [
            'hex' => 'A2B5CD',
            'rgb' => '162,181,205'
        ],
        'LightSteelBlue4' => [
            'hex' => '6E7B8B',
            'rgb' => '110,123,139'
        ],
        'LightYellow' => [
            'hex' => 'FFFFE0',
            'rgb' => '255,255,224'
        ],
        'LightYellow1' => [
            'hex' => 'FFFFE0',
            'rgb' => '255,255,224'
        ],
        'LightYellow2' => [
            'hex' => 'EEEED1',
            'rgb' => '238,238,209'
        ],
        'LightYellow3' => [
            'hex' => 'CDCDB4',
            'rgb' => '205,205,180'
        ],
        'LightYellow4' => [
            'hex' => '8B8B7A',
            'rgb' => '139,139,122'
        ],
        'LimeGreen' => [
            'hex' => '32CD32',
            'rgb' => '050,205,050'
        ],
        'Linen' => [
            'hex' => 'FAF0E6',
            'rgb' => '250,240,230'
        ],
        'Magenta' => [
            'hex' => 'FF00FF',
            'rgb' => '255,000,255'
        ],
        'Magenta1' => [
            'hex' => 'FF00FF',
            'rgb' => '255,000,255'
        ],
        'Magenta2' => [
            'hex' => 'EE00EE',
            'rgb' => '238,000,238'
        ],
        'Magenta3' => [
            'hex' => 'CD00CD',
            'rgb' => '205,000,205'
        ],
        'Magenta4' => [
            'hex' => '8B008B',
            'rgb' => '139,000,139'
        ],
        'Maroon' => [
            'hex' => 'B03060',
            'rgb' => '176,048,096'
        ],
        'Maroon1' => [
            'hex' => 'FF34B3',
            'rgb' => '255,052,179'
        ],
        'Maroon2' => [
            'hex' => 'EE30A7',
            'rgb' => '238,048,167'
        ],
        'Maroon3' => [
            'hex' => 'CD2990',
            'rgb' => '205,041,144'
        ],
        'Maroon4' => [
            'hex' => '8B1C62',
            'rgb' => '139,028,098'
        ],
        'MediumAquamarine' => [
            'hex' => '66CDAA',
            'rgb' => '102,205,170'
        ],
        'MediumBlue' => [
            'hex' => '0000CD',
            'rgb' => '000,000,205'
        ],
        'MediumOrchid' => [
            'hex' => 'BA55D3',
            'rgb' => '186,085,211'
        ],
        'MediumOrchid1' => [
            'hex' => 'E066FF',
            'rgb' => '224,102,255'
        ],
        'MediumOrchid2' => [
            'hex' => 'D15FEE',
            'rgb' => '209,095,238'
        ],
        'MediumOrchid3' => [
            'hex' => 'B452CD',
            'rgb' => '180,082,205'
        ],
        'MediumOrchid4' => [
            'hex' => '7A378B',
            'rgb' => '122,055,139'
        ],
        'MediumPurple' => [
            'hex' => '9370DB',
            'rgb' => '147,112,219'
        ],
        'MediumPurple1' => [
            'hex' => 'AB82FF',
            'rgb' => '171,130,255'
        ],
        'MediumPurple2' => [
            'hex' => '9F79EE',
            'rgb' => '159,121,238'
        ],
        'MediumPurple3' => [
            'hex' => '8968CD',
            'rgb' => '137,104,205'
        ],
        'MediumPurple4' => [
            'hex' => '5D478B',
            'rgb' => '093,071,139'
        ],
        'MediumSeaGreen' => [
            'hex' => '3CB371',
            'rgb' => '060,179,113'
        ],
        'MediumSlateBlue' => [
            'hex' => '7B68EE',
            'rgb' => '123,104,238'
        ],
        'MediumSpringGreen' => [
            'hex' => '00FA9A',
            'rgb' => '000,250,154'
        ],
        'MediumTurquoise' => [
            'hex' => '48D1CC',
            'rgb' => '072,209,204'
        ],
        'MediumVioletRed' => [
            'hex' => 'C71585',
            'rgb' => '199,021,133'
        ],
        'MidnightBlue' => [
            'hex' => '191970',
            'rgb' => '025,025,112'
        ],
        'MintCream' => [
            'hex' => 'F5FFFA',
            'rgb' => '245,255,250'
        ],
        'MistyRose' => [
            'hex' => 'FFE4E1',
            'rgb' => '255,228,225'
        ],
        'MistyRose1' => [
            'hex' => 'FFE4E1',
            'rgb' => '255,228,225'
        ],
        'MistyRose2' => [
            'hex' => 'EED5D2',
            'rgb' => '238,213,210'
        ],
        'MistyRose3' => [
            'hex' => 'CDB7B5',
            'rgb' => '205,183,181'
        ],
        'MistyRose4' => [
            'hex' => '8B7D7B',
            'rgb' => '139,125,123'
        ],
        'Moccasin' => [
            'hex' => 'FFE4B5',
            'rgb' => '255,228,181'
        ],
        'NavajoWhite' => [
            'hex' => 'FFDEAD',
            'rgb' => '255,222,173'
        ],
        'NavajoWhite1' => [
            'hex' => 'FFDEAD',
            'rgb' => '255,222,173'
        ],
        'NavajoWhite2' => [
            'hex' => 'EECFA1',
            'rgb' => '238,207,161'
        ],
        'NavajoWhite3' => [
            'hex' => 'CDB38B',
            'rgb' => '205,179,139'
        ],
        'NavajoWhite4' => [
            'hex' => '8B795E',
            'rgb' => '139,121,094'
        ],
        'NavyBlue' => [
            'hex' => '000080',
            'rgb' => '000,000,128'
        ],
        'OldLace' => [
            'hex' => 'FDF5E6',
            'rgb' => '253,245,230'
        ],
        'OliveDrab' => [
            'hex' => '6B8E23',
            'rgb' => '107,142,035'
        ],
        'OliveDrab1' => [
            'hex' => 'C0FF3E',
            'rgb' => '192,255,062'
        ],
        'OliveDrab2' => [
            'hex' => 'B3EE3A',
            'rgb' => '179,238,058'
        ],
        'OliveDrab3' => [
            'hex' => '9ACD32',
            'rgb' => '154,205,050'
        ],
        'OliveDrab4' => [
            'hex' => '698B22',
            'rgb' => '105,139,034'
        ],
        'Orange' => [
            'hex' => 'FFA500',
            'rgb' => '255,165,000'
        ],
        'Orange1' => [
            'hex' => 'FFA500',
            'rgb' => '255,165,000'
        ],
        'Orange2' => [
            'hex' => 'EE9A00',
            'rgb' => '238,154,000'
        ],
        'Orange3' => [
            'hex' => 'CD8500',
            'rgb' => '205,133,000'
        ],
        'Orange4' => [
            'hex' => '8B5A00',
            'rgb' => '139,090,000'
        ],
        'OrangeRed' => [
            'hex' => 'FF4500',
            'rgb' => '255,069,000'
        ],
        'OrangeRed1' => [
            'hex' => 'FF4500',
            'rgb' => '255,069,000'
        ],
        'OrangeRed2' => [
            'hex' => 'EE4000',
            'rgb' => '238,064,000'
        ],
        'OrangeRed3' => [
            'hex' => 'CD3700',
            'rgb' => '205,055,000'
        ],
        'OrangeRed4' => [
            'hex' => '8B2500',
            'rgb' => '139,037,000'
        ],
        'Orchid' => [
            'hex' => 'DA70D6',
            'rgb' => '218,112,214'
        ],
        'Orchid1' => [
            'hex' => 'FF83FA',
            'rgb' => '255,131,250'
        ],
        'Orchid2' => [
            'hex' => 'EE7AE9',
            'rgb' => '238,122,233'
        ],
        'Orchid3' => [
            'hex' => 'CD69C9',
            'rgb' => '205,105,201'
        ],
        'Orchid4' => [
            'hex' => '8B4789',
            'rgb' => '139,071,137'
        ],
        'PaleGoldenrod' => [
            'hex' => 'EEE8AA',
            'rgb' => '238,232,170'
        ],
        'PaleGreen' => [
            'hex' => '98FB98',
            'rgb' => '152,251,152'
        ],
        'PaleGreen1' => [
            'hex' => '9AFF9A',
            'rgb' => '154,255,154'
        ],
        'PaleGreen2' => [
            'hex' => '90EE90',
            'rgb' => '144,238,144'
        ],
        'PaleGreen3' => [
            'hex' => '7CCD7C',
            'rgb' => '124,205,124'
        ],
        'PaleGreen4' => [
            'hex' => '548B54',
            'rgb' => '084,139,084'
        ],
        'PaleTurquoise' => [
            'hex' => 'AFEEEE',
            'rgb' => '175,238,238'
        ],
        'PaleTurquoise1' => [
            'hex' => 'BBFFFF',
            'rgb' => '187,255,255'
        ],
        'PaleTurquoise2' => [
            'hex' => 'AEEEEE',
            'rgb' => '174,238,238'
        ],
        'PaleTurquoise3' => [
            'hex' => '96CDCD',
            'rgb' => '150,205,205'
        ],
        'PaleTurquoise4' => [
            'hex' => '668B8B',
            'rgb' => '102,139,139'
        ],
        'PaleVioletRed' => [
            'hex' => 'DB7093',
            'rgb' => '219,112,147'
        ],
        'PaleVioletRed1' => [
            'hex' => 'FF82AB',
            'rgb' => '255,130,171'
        ],
        'PaleVioletRed2' => [
            'hex' => 'EE799F',
            'rgb' => '238,121,159'
        ],
        'PaleVioletRed3' => [
            'hex' => 'CD6889',
            'rgb' => '205,104,137'
        ],
        'PaleVioletRed4' => [
            'hex' => '8B475D',
            'rgb' => '139,071,093'
        ],
        'PapayaWhip' => [
            'hex' => 'FFEFD5',
            'rgb' => '255,239,213'
        ],
        'PeachPuff' => [
            'hex' => 'FFDAB9',
            'rgb' => '255,218,185'
        ],
        'PeachPuff1' => [
            'hex' => 'FFDAB9',
            'rgb' => '255,218,185'
        ],
        'PeachPuff2' => [
            'hex' => 'EECBAD',
            'rgb' => '238,203,173'
        ],
        'PeachPuff3' => [
            'hex' => 'CDAF95',
            'rgb' => '205,175,149'
        ],
        'PeachPuff4' => [
            'hex' => '8B7765',
            'rgb' => '139,119,101'
        ],
        'Peru' => [
            'hex' => 'CD853F',
            'rgb' => '205,133,063'
        ],
        'Pink' => [
            'hex' => 'FFC0CB',
            'rgb' => '255,192,203'
        ],
        'Pink1' => [
            'hex' => 'FFB5C5',
            'rgb' => '255,181,197'
        ],
        'Pink2' => [
            'hex' => 'EEA9B8',
            'rgb' => '238,169,184'
        ],
        'Pink3' => [
            'hex' => 'CD919E',
            'rgb' => '205,145,158'
        ],
        'Pink4' => [
            'hex' => '8B636C',
            'rgb' => '139,099,108'
        ],
        'Plum' => [
            'hex' => 'DDA0DD',
            'rgb' => '221,160,221'
        ],
        'Plum1' => [
            'hex' => 'FFBBFF',
            'rgb' => '255,187,255'
        ],
        'Plum2' => [
            'hex' => 'EEAEEE',
            'rgb' => '238,174,238'
        ],
        'Plum3' => [
            'hex' => 'CD96CD',
            'rgb' => '205,150,205'
        ],
        'Plum4' => [
            'hex' => '8B668B',
            'rgb' => '139,102,139'
        ],
        'PowderBlue' => [
            'hex' => 'B0E0E6',
            'rgb' => '176,224,230'
        ],
        'Purple' => [
            'hex' => 'A020F0',
            'rgb' => '160,032,240'
        ],
        'Purple1' => [
            'hex' => '9B30FF',
            'rgb' => '155,048,255'
        ],
        'Purple2' => [
            'hex' => '912CEE',
            'rgb' => '145,044,238'
        ],
        'Purple3' => [
            'hex' => '7D26CD',
            'rgb' => '125,038,205'
        ],
        'Purple4' => [
            'hex' => '551A8B',
            'rgb' => '085,026,139'
        ],
        'Red' => [
            'hex' => 'FF0000',
            'rgb' => '255,000,000'
        ],
        'Red1' => [
            'hex' => 'FF0000',
            'rgb' => '255,000,000'
        ],
        'Red2' => [
            'hex' => 'EE0000',
            'rgb' => '238,000,000'
        ],
        'Red3' => [
            'hex' => 'CD0000',
            'rgb' => '205,000,000'
        ],
        'Red4' => [
            'hex' => '8B0000',
            'rgb' => '139,000,000'
        ],
        'RosyBrown' => [
            'hex' => 'BC8F8F',
            'rgb' => '188,143,143'
        ],
        'RosyBrown1' => [
            'hex' => 'FFC1C1',
            'rgb' => '255,193,193'
        ],
        'RosyBrown2' => [
            'hex' => 'EEB4B4',
            'rgb' => '238,180,180'
        ],
        'RosyBrown3' => [
            'hex' => 'CD9B9B',
            'rgb' => '205,155,155'
        ],
        'RosyBrown4' => [
            'hex' => '8B6969',
            'rgb' => '139,105,105'
        ],
        'RoyalBlue' => [
            'hex' => '4169E1',
            'rgb' => '065,105,225'
        ],
        'RoyalBlue1' => [
            'hex' => '4876FF',
            'rgb' => '072,118,255'
        ],
        'RoyalBlue2' => [
            'hex' => '436EEE',
            'rgb' => '067,110,238'
        ],
        'RoyalBlue3' => [
            'hex' => '3A5FCD',
            'rgb' => '058,095,205'
        ],
        'RoyalBlue4' => [
            'hex' => '27408B',
            'rgb' => '039,064,139'
        ],
        'SaddleBrown' => [
            'hex' => '8B4513',
            'rgb' => '139,069,019'
        ],
        'Salmon' => [
            'hex' => 'FA8072',
            'rgb' => '250,128,114'
        ],
        'Salmon1' => [
            'hex' => 'FF8C69',
            'rgb' => '255,140,105'
        ],
        'Salmon2' => [
            'hex' => 'EE8262',
            'rgb' => '238,130,098'
        ],
        'Salmon3' => [
            'hex' => 'CD7054',
            'rgb' => '205,112,084'
        ],
        'Salmon4' => [
            'hex' => '8B4C39',
            'rgb' => '139,076,057'
        ],
        'SandyBrown' => [
            'hex' => 'F4A460',
            'rgb' => '244,164,096'
        ],
        'SeaGreen' => [
            'hex' => '2E8B57',
            'rgb' => '046,139,087'
        ],
        'SeaGreen1' => [
            'hex' => '54FF9F',
            'rgb' => '084,255,159'
        ],
        'SeaGreen2' => [
            'hex' => '4EEE94',
            'rgb' => '078,238,148'
        ],
        'SeaGreen3' => [
            'hex' => '43CD80',
            'rgb' => '067,205,128'
        ],
        'SeaGreen4' => [
            'hex' => '2E8B57',
            'rgb' => '046,139,087'
        ],
        'Seashell' => [
            'hex' => 'FFF5EE',
            'rgb' => '255,245,238'
        ],
        'Seashell1' => [
            'hex' => 'FFF5EE',
            'rgb' => '255,245,238'
        ],
        'Seashell2' => [
            'hex' => 'EEE5DE',
            'rgb' => '238,229,222'
        ],
        'Seashell3' => [
            'hex' => 'CDC5BF',
            'rgb' => '205,197,191'
        ],
        'Seashell4' => [
            'hex' => '8B8682',
            'rgb' => '139,134,130'
        ],
        'Sienna' => [
            'hex' => 'A0522D',
            'rgb' => '160,082,045'
        ],
        'Sienna1' => [
            'hex' => 'FF8247',
            'rgb' => '255,130,071'
        ],
        'Sienna2' => [
            'hex' => 'EE7942',
            'rgb' => '238,121,066'
        ],
        'Sienna3' => [
            'hex' => 'CD6839',
            'rgb' => '205,104,057'
        ],
        'Sienna4' => [
            'hex' => '8B4726',
            'rgb' => '139,071,038'
        ],
        'SkyBlue' => [
            'hex' => '87CEEB',
            'rgb' => '135,206,235'
        ],
        'SkyBlue1' => [
            'hex' => '87CEFF',
            'rgb' => '135,206,255'
        ],
        'SkyBlue2' => [
            'hex' => '7EC0EE',
            'rgb' => '126,192,238'
        ],
        'SkyBlue3' => [
            'hex' => '6CA6CD',
            'rgb' => '108,166,205'
        ],
        'SkyBlue4' => [
            'hex' => '4A708B',
            'rgb' => '074,112,139'
        ],
        'SlateBlue' => [
            'hex' => '6A5ACD',
            'rgb' => '106,090,205'
        ],
        'SlateBlue1' => [
            'hex' => '836FFF',
            'rgb' => '131,111,255'
        ],
        'SlateBlue2' => [
            'hex' => '7A67EE',
            'rgb' => '122,103,238'
        ],
        'SlateBlue3' => [
            'hex' => '6959CD',
            'rgb' => '105,089,205'
        ],
        'SlateBlue4' => [
            'hex' => '473C8B',
            'rgb' => '071,060,139'
        ],
        'SlateGray' => [
            'hex' => '708090',
            'rgb' => '112,128,144'
        ],
        'SlateGray1' => [
            'hex' => 'C6E2FF',
            'rgb' => '198,226,255'
        ],
        'SlateGray2' => [
            'hex' => 'B9D3EE',
            'rgb' => '185,211,238'
        ],
        'SlateGray3' => [
            'hex' => '9FB6CD',
            'rgb' => '159,182,205'
        ],
        'SlateGray4' => [
            'hex' => '6C7B8B',
            'rgb' => '108,123,139'
        ],
        'Snow' => [
            'hex' => 'FFFAFA',
            'rgb' => '255,250,250'
        ],
        'Snow1' => [
            'hex' => 'FFFAFA',
            'rgb' => '255,250,250'
        ],
        'Snow2' => [
            'hex' => 'EEE9E9',
            'rgb' => '238,233,233'
        ],
        'Snow3' => [
            'hex' => 'CDC9C9',
            'rgb' => '205,201,201'
        ],
        'Snow4' => [
            'hex' => '8B8989',
            'rgb' => '139,137,137'
        ],
        'SpringGreen' => [
            'hex' => '00FF7F',
            'rgb' => '000,255,127'
        ],
        'SpringGreen1' => [
            'hex' => '00FF7F',
            'rgb' => '000,255,127'
        ],
        'SpringGreen2' => [
            'hex' => '00EE76',
            'rgb' => '000,238,118'
        ],
        'SpringGreen3' => [
            'hex' => '00CD66',
            'rgb' => '000,205,102'
        ],
        'SpringGreen4' => [
            'hex' => '008B45',
            'rgb' => '000,139,069'
        ],
        'SteelBlue' => [
            'hex' => '4682B4',
            'rgb' => '070,130,180'
        ],
        'SteelBlue1' => [
            'hex' => '63B8FF',
            'rgb' => '099,184,255'
        ],
        'SteelBlue2' => [
            'hex' => '5CACEE',
            'rgb' => '092,172,238'
        ],
        'SteelBlue3' => [
            'hex' => '4F94CD',
            'rgb' => '079,148,205'
        ],
        'SteelBlue4' => [
            'hex' => '36648B',
            'rgb' => '054,100,139'
        ],
        'Tan' => [
            'hex' => 'D2B48C',
            'rgb' => '210,180,140'
        ],
        'Tan1' => [
            'hex' => 'FFA54F',
            'rgb' => '255,165,079'
        ],
        'Tan2' => [
            'hex' => 'EE9A49',
            'rgb' => '238,154,073'
        ],
        'Tan3' => [
            'hex' => 'CD853F',
            'rgb' => '205,133,063'
        ],
        'Tan4' => [
            'hex' => '8B5A2B',
            'rgb' => '139,090,043'
        ],
        'Thistle' => [
            'hex' => 'D8BFD8',
            'rgb' => '216,191,216'
        ],
        'Thistle1' => [
            'hex' => 'FFE1FF',
            'rgb' => '255,225,255'
        ],
        'Thistle2' => [
            'hex' => 'EED2EE',
            'rgb' => '238,210,238'
        ],
        'Thistle3' => [
            'hex' => 'CDB5CD',
            'rgb' => '205,181,205'
        ],
        'Thistle4' => [
            'hex' => '8B7B8B',
            'rgb' => '139,123,139'
        ],
        'Tomato' => [
            'hex' => 'FF6347',
            'rgb' => '255,099,071'
        ],
        'Tomato1' => [
            'hex' => 'FF6347',
            'rgb' => '255,099,071'
        ],
        'Tomato2' => [
            'hex' => 'EE5C42',
            'rgb' => '238,092,066'
        ],
        'Tomato3' => [
            'hex' => 'CD4F39',
            'rgb' => '205,079,057'
        ],
        'Tomato4' => [
            'hex' => '8B3626',
            'rgb' => '139,054,038'
        ],
        'Turquoise' => [
            'hex' => '40E0D0',
            'rgb' => '064,224,208'
        ],
        'Turquoise1' => [
            'hex' => '00F5FF',
            'rgb' => '000,245,255'
        ],
        'Turquoise2' => [
            'hex' => '00E5EE',
            'rgb' => '000,229,238'
        ],
        'Turquoise3' => [
            'hex' => '00C5CD',
            'rgb' => '000,197,205'
        ],
        'Turquoise4' => [
            'hex' => '00868B',
            'rgb' => '000,134,139'
        ],
        'Violet' => [
            'hex' => 'EE82EE',
            'rgb' => '238,130,238'
        ],
        'VioletRed' => [
            'hex' => 'D02090',
            'rgb' => '208,032,144'
        ],
        'VioletRed1' => [
            'hex' => 'FF3E96',
            'rgb' => '255,062,150'
        ],
        'VioletRed2' => [
            'hex' => 'EE3A8C',
            'rgb' => '238,058,140'
        ],
        'VioletRed3' => [
            'hex' => 'CD3278',
            'rgb' => '205,050,120'
        ],
        'VioletRed4' => [
            'hex' => '8B2252',
            'rgb' => '139,034,082'
        ],
        'Wheat' => [
            'hex' => 'F5DEB3',
            'rgb' => '245,222,179'
        ],
        'Wheat1' => [
            'hex' => 'FFE7BA',
            'rgb' => '255,231,186'
        ],
        'Wheat2' => [
            'hex' => 'EED8AE',
            'rgb' => '238,216,174'
        ],
        'Wheat3' => [
            'hex' => 'CDBA96',
            'rgb' => '205,186,150'
        ],
        'Wheat4' => [
            'hex' => '8B7E66',
            'rgb' => '139,126,102'
        ],
        'White' => [
            'hex' => 'FFFFFF',
            'rgb' => '255,255,255'
        ],
        'WhiteSmoke' => [
            'hex' => 'F5F5F5',
            'rgb' => '245,245,245'
        ],
        'Yellow1' => [
            'hex' => 'FFFF00',
            'rgb' => '255,255,000'
        ],
        'Yellow2' => [
            'hex' => 'EEEE00',
            'rgb' => '238,238,000'
        ],
        'Yellow3' => [
            'hex' => 'CDCD00',
            'rgb' => '205,205,000'
        ],
        'Yellow4' => [
            'hex' => '8B8B00',
            'rgb' => '139,139,000'
        ],
        'YellowGreen' => [
            'hex' => '9ACD32',
            'rgb' => '154,205,050'
        ]
    ];

    // Public Methods

    public function getHex($color)
    {
        return $this->colors[$color]['hex'] ?? null;
    }

    public function getRgb($color)
    {
        return $this->colors[$color]['rgb'] ?? null;
    }
}
