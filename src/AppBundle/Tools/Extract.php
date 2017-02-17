<?php

/**
 * This file is part of 1001 Pharmacies solid-stupid
 *
 * (c) 1001pharmacies <https://github.com/1001pharmacies/solid-stupid>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Tools;

/**
 * Extract
 *
 * @author Gilles <gilles@1001pharmacies.com>
 */
class Extract
{
    const PREFIX = '@';

    private static $instance = null;

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new Extract();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    public function extract($text)
    {
        if (preg_match_all('!@(.+)(?:\s|$)!U', $text, $matches)) {
            $usernames = $matches[1];
        } else {
            $usernames = [];
        }

        return $usernames;
    }
}
