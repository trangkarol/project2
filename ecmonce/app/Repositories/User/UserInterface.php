<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function login($request);

    public function logout($request);

    public function changePassword($request);
}
