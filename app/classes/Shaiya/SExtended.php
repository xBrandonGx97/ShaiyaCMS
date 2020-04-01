<?php

namespace Classes\Shaiya;

use Illuminate\Database\Capsule\Manager as DB;

class SExtended
{
    private $version = '2.0';

    public function __construct()
    {
        //
    }

    public function status()
    {
        //
    }

    public function commandSend($cmd): void
    {
        $query = ("
                    DECLARE @msgg varchar(MAX) = N'/' + '".$cmd."'
                    DECLARE	@return_value int

                    EXEC	@return_value = [PS_ChatLog].[dbo].[Command]
                    @serviceName = N'ps_game',
                    @cmmd = @msgg
        ");
        $stmt = DB::statement($query);
    }

    public function getChar($char): string
    {
        if (is_numeric($char)) {
            $query = DB::table(table('shCharData'))
                ->select('CharName')
                ->where('CharID', $char)
                ->limit(1)
                ->get();
            return $query[0]->CharName;
        }
        $query = DB::table(table('shCharData'))
            ->select('CharID')
            ->where('CharName', $char)
            ->limit(1)
            ->get();
        return $query[0]->CharID;
    }

    public function getUser($user): string
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

    public function playerSend($char, $message): void
    {
        $char = $this->getChar($char);
        $command = 'ntplayer '.$char.' '.$message.'';
		$this->commandSend($command);
    }

    public function noticeSend($message): void
    {
        $command = 'nt '.$message.'';
		$this->commandSend($command);
    }
}
