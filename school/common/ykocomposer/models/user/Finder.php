<?php
/**
 * @Copyright Copyright (c) 2016 @Finder.php By Kami
 * @License http://www.yuzhai.tv/
 */

namespace common\ykocomposer\models\user;

use dektrium\user\Finder as dektriumFinder;

class Finder extends dektriumFinder
{
    /**
     * Finds a user by the given Mobile.
     *
     * @param string $mobile Mobile to be used on search.
     *
     * @return models\User
     */
    public function findUserByPhone($mobile)
    {
        return $this->findUser(['phone' => $mobile])->one();
    }

}