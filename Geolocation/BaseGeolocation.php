<?php

/**
 * (c) Rob Masters <robmasters87@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RJM\Bundle\MaxmindBundle\Geolocation;

use Symfony\Component\HttpFoundation\Request;

abstract class BaseGeolocation
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $serviceUrl;

    /**
     * @var string
     */
    protected $licenceKey;

    /**
     * @param Request $request
     * @param string $serviceUrl
     * @param string $licenceKey
     */
    function __construct(Request $request, $serviceUrl, $licenceKey)
    {
        $this->request = $request;
        $this->serviceUrl = rtrim($serviceUrl, '/');
        $this->licenceKey = $licenceKey;
    }

    /**
     * Get the relevant prefix for the web service
     *
     * @return string
     */
    abstract protected function getServicePrefix();

    /**
     * @return string
     * @throws \RuntimeException
     */
    public function execute()
    {
        if (!function_exists('curl_init')) {
            throw new \RuntimeException("Maxmind Geolocation classes require curl to be installed");
        }

        // Call the web service using the configured URL.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->buildServiceUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($ch);
    }

    /**
     * Get the IP address of the current user
     *
     * @return string
     */
    protected function getIp()
    {
        return $this->request->getClientIp();
    }

    /**
     * @return string
     */
    private function buildServiceUrl()
    {
        return sprintf('%s/%s?l=%s&i=%s',
            $this->serviceUrl,
            $this->getServicePrefix(),
            $this->licenceKey,
            $this->getIp()
        );
    }
}