<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function generateSymbolHash()
    {
        $existingCodes = self::pluck('code')->toArray();

        return $this->generateRandomSymbol($existingCodes);
    }

    private function generateRandomSymbol($existingCodes)
    {
        $hashCode = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

        if (in_array($hashCode, $existingCodes)) {
            $this->generateRandomSymbol($existingCodes);
        }

        return $hashCode;
    }
}
