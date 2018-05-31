<?php

namespace App\Http\Controllers;

use App;
// use App\Repository\MessagesRepository;
// use App\Repository\UserRepository;
use App\Service\BoardService;
use Auth;
use Illuminate\Http\Request;

class RefactoringController extends Controller
{

    protected $oBoardService;

    public function __construct(BoardService $oBoardService)
    {
        $this->oBoardService = $oBoardService;
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $test      = $this->oBoardService->getMessage();
        $aUserData = $this->oBoardService->getMessageUser();

        $test      = $this->arrayidx($test, 'id');
        $aUserData = $this->arrayidx($aUserData, 'id');



        return view('refactory', array('info' => $test, 'UserData' => $aUserData));
    }

    //添加留言
    public function addpost(Request $_aRequest)
    {
        $aUserData = $this->oBoardService->getMessageUser();
        $aUserData = $this->arrayidx($aUserData, 'id');

        $_aRequest    = $_aRequest->toArray();
        $aUserinfo    = Auth::User()->toArray();
        $iWriteUserID = $aUserinfo['id'];
        $sMessage     = $_aRequest['Textinfo'];

        $bResult = $this->oBoardService->addMessage($iWriteUserID, $sMessage);

        $aMessageInfo = $this->oBoardService->getMessage();
        $aMessageInfo = $this->arrayidx($aMessageInfo, 'id');

        return view('refactory', array('info' => $aMessageInfo, 'UserData' => $aUserData));
    }

    //修改留言
    public function edit(Request $_aRequest)
    {
        $aUserData = $this->oBoardService->getMessageUser();
        $aUserData = $this->arrayidx($aUserData, 'id');
        $_aRequest = $_aRequest->toArray();

        $iWriteUserID = $_aRequest['editUserID'];
        $iWriteTextID = $_aRequest['edittextID'];
        $sMessage     = $_aRequest['editTextinfo'];

        $bResult = $this->oBoardService->editMessage($iWriteTextID, $sMessage);

        $aMessageInfo = $this->oBoardService->getMessage();
        $aMessageInfo = $this->arrayidx($aMessageInfo, 'id');

        return view('refactory', array('info' => $aMessageInfo, 'UserData' => $aUserData));
    }

    //刪除留言
    public function del(Request $_aRequest)
    {
        $_aRequest  = $_aRequest->toArray();
        $iDelTextID = $_aRequest['DeleteTextID'];

        // DELETE
        $bRequest = $this->oBoardService->deleteMessage($iDelTextID);

        $aArray = array(
            'msg'     => 'test',
            'request' => $bRequest,
        );

        return json_encode($aArray);
    }

    private function arrayidx($_aArray, $_sFeield)
    {
        $aNewArray = array();

        foreach ($_aArray as $key => $value) {
            $iID             = $value[$_sFeield];
            $aNewArray[$iID] = $value;
        }
        return $aNewArray;
    }

    //
}
