<?php
namespace App\Repository;

use App\messages;

class MessagesRepository
{
    protected $oMassages;

    public function __construct(messages $oMassages)
    {
        $this->oMassages = $oMassages;
    }

    public function getAllMessage()
    {
        return $this->oMassages->all()->toarray();
    }

    public function addNewMassage($_iUserID, $_sTextInfo)
    {

        $this->oMassages->user_id     = $_iUserID;
        $this->oMassages->MessageInfo = $_sTextInfo;
        return $this->oMassages->save();
    }

    public function editTextData($_iTextID, $_sTextInfo)
    {
        $oTextInfo              = $this->oMassages->where('id', $_iTextID)->first();
        $oTextInfo->MessageInfo = $_sTextInfo;
        return $oTextInfo->save();
    }

    public function deleteMessage($_iTextID)
    {
        return $this->oMassages->where('id', $_iTextID)->delete();
    }

}
