<?php

/**
 * (c) Rob Masters <robmasters87@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RJM\Bundle\MaxmindBundle\Geolocation;

class CountryGeolocation extends BaseGeolocation
{
    /**
     * Get the relevant prefix for the web service
     *
     * @return string
     */
    protected function getServicePrefix()
    {
        return 'a';
    }
}