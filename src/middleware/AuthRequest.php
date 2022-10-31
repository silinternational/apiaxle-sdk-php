<?php

namespace Apiaxle\middleware;

use CalcApiSig\HmacSigner;
use Psr\Http\Message\RequestInterface;

class AuthRequest
{

    const DEFAULTSKEY = 'defaults';
    const AUTHKEY = 'auth';

    private static function countAtLeast(array $input, $minimum){
        if (! is_array($input)) {
            return false;
        }
        return count($input) >= $minimum;
    }

    private static function getAuthKeySecret(array $options) {
        // If there is a specific auth entry, use it
        if (isset( $options[self::AUTHKEY])) {
            $auth = $options[self::AUTHKEY];
            if (! self::countAtLeast($auth, 1)) {
                throw new \Exception('Middleware client options have an invalid \'auth\' array.', 1666607090);
            }

        // If there is no specific auth entry, use the default
        } else {
            if (!isset($options[self::DEFAULTSKEY][self::AUTHKEY]) ||
                ! self::countAtLeast($options[self::DEFAULTSKEY][self::AUTHKEY], 1)) {
                throw new \Exception('Middleware client options have an invalid \'defaults=>auth\' array.', 1666607095);
            }

            $auth = $options[self::DEFAULTSKEY][self::AUTHKEY];
        }

        $key = $auth[0];
        $secret = isset($auth[1]) ? $auth[1] : null;
        return [$key, $secret];
    }

    public static function addAuthParams(RequestInterface $request, array $options)
    {
        list($key, $secret) = self::getAuthKeySecret($options);

        /*
         * Make sure key/secret do not stay in auth headers
         */
        $request = $request->withoutHeader('Authorization');
        $uri = $request->getUri();

        // Remove previous query string
        $uri = $uri->withQuery("");

        /*
         * Add request params for key and secret if needed
         */
        $params = "api_key=$key";

        /*
         * Calculate signature if secret is present
         */
        if ($secret !== null) {
            $signature = HmacSigner::CalcApiSig($key, $secret);
            $params .= "&api_sig=$signature";
        }

        $uri = $uri->withQuery($params);
        return $request->withUri($uri);
    }
}