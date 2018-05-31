<?php
namespace App\Service;

use App\Repository\MessagesRepository;
use App\Repository\UserRepository;

class BoardService
{
    protected $oUserRepository;
    protected $oMessagesRepository;

    public function __construct(UserRepository $oUserRepository, MessagesRepository $oMessagesRepository)
    {
        $this->oUserRepository     = $oUserRepository;
        $this->oMessagesRepository = $oMessagesRepository;
    }

    public function getMessageUser()
    {
        $aUserData = $this->oUserRepository->getAllUser();

        return $aUserData;
    }
    public function getMessage()
    {
        $aMassage = $this->oMessagesRepository->getAllMessage();

        return $aMassage;
    }

    public function addMessage($_iWriteUserID, $_sMessage)
    {
        return $this->oMessagesRepository->addNewMassage($_iWriteUserID, $_sMessage);
    }

    public function editMessage($_iTextID, $_sMessage)
    {

        return $this->oMessagesRepository->editTextData($_iTextID, $_sMessage);
    }

    public function deleteMessage($_iTextID)
    {

        return  $this->oMessagesRepository->deleteMessage($_iTextID);
    }

}
