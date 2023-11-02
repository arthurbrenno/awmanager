<?php

namespace App\Core\Models\Database\Dao;
use Framework\Http\Constants\StatusCodes;
use Framework\Http\Response;
use Illuminate\Database\Capsule\Manager as Capsule;
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();
class AvatarDAO
{
    public static function getUserAvatarUrl($userId)
    {
        $avatar = Capsule::table('avatars')
            ->where('user_id', $userId)->get()->first();

        return $avatar->url;
    }


    public static function changeAvatar(): Response
    {
        if (!isset($_SESSION['id'])) {
            return new Response(null, StatusCodes::OK);
        }

        $userId = $_SESSION['id'];
        $avatarNumber = $_POST['avatarNumber'];
        $newUrl = "https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/" . $avatarNumber . ".webp";

        Capsule::table('avatars')
            ->where('user_id', $userId)
            ->update(['url' => $newUrl]);

        return new Response(null, StatusCodes::OK);
    }

}