<?php

namespace App\Services;


use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserManager
{
    /**
     * findOrCreateUserOnOrder -
     * it will find existng user by email or phone filled in the order form.
     * If user is not found it will create new user account and dossier
     *
     * @param  string $clientEmail
     * @param  mixed $deliveryPhone
     * @param  string $deliveryFirstName
     * @param  string $deliveryLastName
     * @return App\Models\User
     */
    public static function findOrCreateUserOnOrder($clientEmail, $deliveryPhone, $deliveryFirstName, $deliveryLastName)
    {
        $user = null;
        //search for email in `users` table
        $user = User::where('email', $clientEmail)->first();

        if(empty($user)) {
            return self::createNewUser($clientEmail, $deliveryFirstName, $deliveryLastName, $deliveryPhone); //returns the newly created user
        }else{
            return $user;
        }
    }

    public static function createNewUser($userEmail, $userFirstName, $userLastName, $userDeliveryPhone)
    {
        DB::beginTransaction();

        // create a new user
        $newUserAccount = new User();
        $newUserAccount->name = $userFirstName;
        $newUserAccount->lastname = $userLastName;
        $newUserAccount->email = $userEmail;
        $newUserAccount->phone_number = $userDeliveryPhone;
        $newUserAccount->password = \Hash::make(\Str::random(16));
        $newUserAccount->save();

        DB::commit();

        return $newUserAccount;
    }

    public static function createNewUserDossier($userEmail)
    {
        $newUserDossier = new Dossier();
        $newUserDossier->email = $userEmail;
        $newUserDossier->save();

        return $newUserDossier;
    }
}
