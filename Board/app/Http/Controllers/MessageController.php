<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(App\messages $odb, App\User $oUser)
    {
        $test      = $odb->all()->toarray();
        $aUserData = $oUser->getAllUser();
        // $aUserData = $oUser->getAllUser()->->toArray();

        // echo "<pre>";
        $test = $this->arrayidx($test, 'id');
        $aUserData = $this->arrayidx($aUserData, 'id');


        return view('demo', array('info' => $test, 'UserData' => $aUserData));
    }

    public function add()
    {
        echo 123;
        exit();
        return view('add');
    }
    //添加留言
    public function addpost(App\messages $odb, App\User $oUser, Request $_aRequest)
    {
        $aUserData    = $oUser->getAllUser();
        $aUserData    = $this->arrayidx($aUserData, 'id');
        $_aRequest = $_aRequest->toArray();

        $iWriteUserID = $_aRequest['UserID'];
        $sMessage = $_aRequest['Textinfo'];

        $odb->user_id = $iWriteUserID;
        $odb->MessageInfo = $sMessage;
        $odb->save();

        $aMessageInfo = $odb->all();
        $aMessageInfo = $this->arrayidx($aMessageInfo, 'id');

        return view('demo', array('info' => $aMessageInfo, 'UserData' => $aUserData));
    }

    //修改留言
    public function edit(App\messages $odb, App\User $oUser, Request $_aRequest)
    {
        $aUserData    = $oUser->getAllUser();
        $aUserData    = $this->arrayidx($aUserData, 'id');
        $_aRequest = $_aRequest->toArray();

        $iWriteUserID = $_aRequest['editUserID'];
        $iWriteTextID = $_aRequest['edittextID'];
        $sMessage = $_aRequest['editTextinfo'];


        $oTextInfo = $odb->where('id',$iWriteTextID)->first();

        // where('active', 1)->first();
        // $odb->user_id = $iWriteUserID;
        $oTextInfo->MessageInfo = $sMessage;
        $oTextInfo->save();

        $aMessageInfo = $odb->all();
        $aMessageInfo = $this->arrayidx($aMessageInfo, 'id');

        return view('demo', array('info' => $aMessageInfo, 'UserData' => $aUserData));
    }

    //刪除留言
    public function del(Request $_aRequest, App\messages $odb)
    {
        $_aRequest = $_aRequest->toArray();
        $iDelTextID = $_aRequest['DeleteTextID'];

        // DELETE
        $bRequest =  $odb->where('id',$iDelTextID)->delete();

        $aArray = array(
            'msg' => 'test',
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
