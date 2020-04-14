<?php

namespace App\Models\Admin\Player;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class Gift
{
    private $giftState;
    private $errors = [];
    private $complete = 0;
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->charName = isset($_POST['CharName']) ? $this->data->purify(trim($_POST['CharName'])) : false;
        $this->itemId = isset($_POST['ItemID']) ? $this->data->purify(trim($_POST['ItemID'])) : false;
        $this->itemCount = isset($_POST['ItemCount']) ? $this->data->purify(trim($_POST['ItemCount'])) : false;
    }

    public function verifyChar()
    {
        $verify = DB::table(table('shCharData'))
            ->select('UserUID')
            ->where('CharName', $this->charName)
            ->limit(1)
            ->get();
        return $verify;
    }

    public function getUserUidByCharName()
    {
        $uid = DB::table(table('shCharData'))
            ->select('UserUID')
            ->where('CharName', $this->charName)
            ->limit(1)
            ->get();
        return $uid[0]->UserUID;
    }

    public function getMassUserUid()
    {
        $uid = DB::table(table('shUserData'))
            ->select('UserUID')
            ->get();
        return $uid;
    }

    public function getUserIdByUserUid()
    {
        $id = DB::table(table('shCharData'))
            ->select('UserID')
            ->where('UserUID', $this->getUserUidByCharName())
            ->limit(1)
            ->get();
        return $id[0]->UserID;
    }

    public function getMaxSlot()
    {
        $slot = DB::table(table('shUserBank'))
            ->select(DB::raw('MAX([Slot]) AS Slot'))
            ->where('UserUID', $this->getUserUidByCharName())
            ->limit(1)
            ->get();
        if ($slot[0]->Slot < 255) {
            $slot = $slot[0]->Slot + 1;
            return $slot;
        }
        return false;
    }

    public function getMassMaxSlot($userUid)
    {
        $slot = DB::table(table('shUserBank'))
            ->select(DB::raw('MAX([Slot]) AS Slot'))
            ->where('UserUID', $userUid)
            ->limit(1)
            ->get();
        if ($slot[0]->Slot < 255) {
            $slot = $slot[0]->Slot + 1;
            return $slot;
        }
        return false;
    }

    public function getItemNameFromId()
    {
        $id = DB::table(table('shItems'))
            ->select('ItemName')
            ->where('ItemID', $this->itemId)
            ->limit(1)
            ->get();
        return $id[0]->ItemName;
    }

    public function sendGift()
    {
        try {
            $gift = DB::table(table('shUserBank'))
              ->insert([
                  'UserUID' => $this->getUserUidByCharName(),
                  'Slot' => $this->getMaxSlot(),
                  'ItemID' => $this->itemId,
                  'ItemCount' => $this->itemCount,
                  'BuyDate' => \Carbon\Carbon::now(),
              ]);
              $this->giftState = true;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->giftState = false;
        }
    }

    public function sendMassGift()
    {
        try {
            foreach ($this->getMassUserUid() as $user) {
                $gift = DB::table(table('shUserBank'))
                    ->insert([
                        'UserUID' => $user->UserUID,
                        'Slot' => $this->getMassMaxSlot($user->UserUID),
                        'ItemID' => $this->itemId,
                        'ItemCount' => $this->itemCount,
                        'BuyDate' => \Carbon\Carbon::now(),
                    ]);
            }
            $this->giftState = true;
        } catch (\Illuminate\Database\QueryException $e) {
            $this->giftState = false;
        }
    }

    public function getGiftState()
    {
        return $this->giftState;
    }

    public function setError($error)
    {
        $this->errors[] .= $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function errorChecks()
    {
        //
    }

    public function getFormComplete()
    {
        return $this->complete;
    }

    public function setFormComplete()
    {
        $this->complete = 1;
    }
}
