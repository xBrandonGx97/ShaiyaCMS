<?php

namespace App\Models\Admin\Misc;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class ManageGuilds
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->guildName = isset($_POST['Guild']) ? $this->data->purify(trim($_POST['Guild'])) : false;
    }

    public function getGuildData()
    {
        $guild = DB::table(table('shGuilds') . ' as g')
            ->select()
            ->join(table('shGuildDetails') . ' as  gd', 'g.GuildID', '=', 'gd.GuildID')
            ->where('g.Del', 0)
            ->orderBy('g.GuildID')
            ->get();
        return $guild;
    }

    public function getGuildCharsByGuild($id)
    {
        $chars = DB::table(table('shGuildChars') . ' as gc')
            ->select()
            ->join(table('shCharData') . ' as  c', 'gc.CharID', '=', 'c.CharID')
            ->where('gc.GuildID', $id)
            ->where('gc.Del', 0)
            ->where('gc.GuildLevel', '!=', 0)
            ->orderBy('gc.GuildLevel', 'ASC')
            ->get();
        return $chars;
    }

    public function updateGuild()
    {
        try {
            $this->updateGuildById();
            $this->updateOldMasterGuildLevel();
            $this->updateNewMasterGuildLevel();
            $this->updateGuildMaster();
            //$this->updateGuildCharsById();
            $this->updateGuildDetailsById();
            return 'Guild: <b>'.$this->getGuildName().'</b> updated successfully.';
        } catch (\Illuminate\Database\QueryException $e) {
            return 'Could not update guild. Please try again.';
        }
    }

    public function updateGuildById()
    {
        $update = DB::table(table('shGuilds'))
            ->where('GuildID', $this->getGuildId())
            ->update(
                [
                    'GuildName' => $this->getGuildName()
                ]
            );
    }

    public function updateGuildMaster()
    {
        if ($this->checkGuildMaster() !== $this->getGuildMaster()) {
            $update = DB::table(table('shGuilds'))
                ->where('GuildID', $this->getGuildId())
                ->update(
                    [
                        'MasterName' => $this->getGuildMasterCharName(),
                        'MasterCharID' => $this->getGuildMasterCharId(),
                        'MasterUserID' => $this->getGuildMasterUserId()
                    ]
                );
        }
    }

    public function updateOldMasterGuildLevel()
    {
        if ($this->checkGuildMaster() !== $this->getGuildMaster()) {
            $update = DB::table(table('shGuildChars'))
                ->where('GuildLevel', 1)
                ->where('GuildID', $this->getGuildId())
                ->update(
                    [
                        'GuildLevel' => 8
                    ]
                );
        }
    }

    public function updateNewMasterGuildLevel()
    {
        if ($this->checkGuildMaster() !== $this->getGuildMaster()) {
            $update = DB::table(table('shGuildChars'))
                ->where('CharID', $this->getGuildMasterCharId())
                ->where('GuildID', $this->getGuildId())
                ->update(
                    [
                        'GuildLevel' => 1
                    ]
                );
        }
    }

    public function updateGuildCharsById()
    {
        //
    }

    public function updateGuildDetailsById()
    {
        $update = DB::table(table('shGuildDetails'))
            ->where('GuildID', $this->getGuildId())
            ->update(
                [
                    'UseHouse' => $this->getGuildHouse(),
                    'BuyHouse' => $this->getGuildHouse(),
                    'Etin' => $this->getGuildEtin(),
                    'Remark' => $this->getGuildRemark()
                ]
            );
    }

    public function getGuildId()
    {
        return isset($_POST['submit']) ? $this->data->purify(trim($_POST['submit'])) : false;
    }

    public function getGuildName()
    {
        return isset($_POST['guildName']) ? $this->data->purify(trim($_POST['guildName'])) : false;
    }

    public function getGuildMaster()
    {
        return isset($_POST['guildMaster']) ? $this->data->purify(trim($_POST['guildMaster'])) : false;
    }

    public function explodeGuildMaster()
    {
        return explode(',', $this->getGuildMaster());
    }

    public function getGuildMasterUserId()
    {
        return $this->explodeGuildMaster()[0];
    }

    public function getGuildMasterCharId()
    {
        return $this->explodeGuildMaster()[1];
    }

    public function getGuildMasterCharName()
    {
        return $this->explodeGuildMaster()[2];
    }

    public function getGuildHouse()
    {
        return isset($_POST['guildHouse']) ? $this->data->purify(trim($_POST['guildHouse'])) : false;
    }

    public function getGuildEtin()
    {
        return isset($_POST['guildEtin']) ? $this->data->purify(trim($_POST['guildEtin'])) : false;
    }

    public function getGuildRemark()
    {
        return isset($_POST['remark']) ? $this->data->purify(trim($_POST['remark'])) : false;
    }

    public function checkGuildMaster()
    {
        $guild = DB::table(table('shGuilds'))
            ->select('MasterName')
            ->where('GuildID', $this->getGuildId())
            ->limit(1)
            ->get();
        return $guild[0]->MasterName;
    }
}
