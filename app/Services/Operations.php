<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class Operations
{
    public static function decryptId($value)
    {
        // check if $value id encrypted
        try {
            $id = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return null;
        }

        return $id;
    }

    public static function encryptId($value)
    {

        try {
            $id = Crypt::encrypt($value);
        } catch (DecryptException $e) {
            return null;
        }

        return $id;
    }
}
