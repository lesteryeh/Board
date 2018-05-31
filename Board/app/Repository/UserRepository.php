<?php
namespace App\Repository;

use App\User;


class UserRepository
{
    protected $oUser;

    function __construct(User $oUser)
    {
        $this->oUser = $oUser;
    }

    public function getAllUser()
    {
        return $this->oUser->select('id', 'name')->get()->toArray();

    }
}