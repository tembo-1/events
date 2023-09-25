<?php

namespace App\Services\Site;

use App\Models\User;

class UserService
{
    public function info(int $id)
    {
        $user = User::find($id);

        $text = "Name and surname of the user: <br> $user->name $user->surname <br> Date of registration: <br> $user->registration_date \n
                <br> Date of birth <br> $user->birth_date";

        return $text;
    }
}
