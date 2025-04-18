<?php

namespace App\Services;

use App\Models\User;
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

    public static function getUser()
    {
        $id = self::decryptId(session('user.id'));
        // Podemos pesquisar por apenas o campo chave.
        // User::find($id);
        return User::where('id', $id)->first();
    }

    public static function getValueFormater($numberFormat)
    {
        $value = str_replace('.', '', $numberFormat);
        return str_replace(',', '.', $value);
    }
}
