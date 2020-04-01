<?php

namespace Classes\Shaiya;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class SExtended
{
    private $version = '2.0';

    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->noticeChar = isset($_POST['noticeChar']) ? $this->data->purify(trim($_POST['noticeChar'])) : false;
        $this->notice = isset($_POST['notice']) ? $this->data->purify(trim($_POST['notice'])) : false;
    }

    public function status()
    {
        //
    }

    public function sendCommand($cmd): void
    {
        $query = ("
                    DECLARE @msgg varchar(MAX) = N'/' + '".$cmd."'
                    DECLARE	@return_value int

                    EXEC	@return_value = [PS_ChatLog].[dbo].[Command]
                    @serviceName = N'ps_game',
                    @cmmd = @msgg
        ");
        $stmt = DB::statement($query);
        var_dump($stmt);
    }

    public function getChar($char)
    {
        if (is_numeric($char)) {
            $query = DB::table(table('shCharData'))
                ->select('CharName')
                ->where('CharID', $char)
                ->limit(1)
                ->get();
            return $query;
        }
        $query = DB::table(table('shCharData'))
            ->select('CharID')
            ->where('CharName', $char)
            ->limit(1)
            ->get();
        return $query;
    }

    public function getUser($user)
    {
        if (is_numeric($user)) {
            $query = DB::table(table('shUserData'))
                ->select('UserID')
                ->where('UserUID', $user)
                ->limit(1)
                ->get();
            return $query[0]->UserID;
        }
        $query = DB::table(table('shUserData'))
            ->select('UserUID')
            ->where('UserID', $user)
            ->limit(1)
            ->get();
        return $query[0]->UserUID;
    }

    public function sendPlayerNotice($char, $message)
    {
        if (count($this->getChar($char)) > 0) {
            if (is_numeric($char)) {
                $char = $this->getChar($char)[0]->CharName;
            } else {
                $char = $this->getChar($char)[0]->CharID;
            }
            $command = 'ntplayer '.$char.' '.$message.'';
            $this->sendCommand($command);
            return true;
        }
        return false;
    }

    public function sendNotice($message): void
    {
        $command = 'nt '.$message.'';
        $this->sendCommand($command);
    }
}
