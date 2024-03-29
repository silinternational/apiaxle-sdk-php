<?php
namespace Apiaxle;

/**
 * @method array list(array $config = [])
 * @method array get(array $config = [])
 * @method array delete(array $config = [])
 * @method array create(array $config = [])
 * @method array update(array $config = [])
 * @method array listKeys(array $config = [])
 * @method array linkKey(array $config = [])
 * @method array unlinkKey(array $config = [])
 * @method array getStats(array $config = [])
 */
class Keyring extends BaseClient
{
    /**
     * @param array $config
     * @param GuzzleHttp\Handler\MockHandler $mock [default=null]
     */
    public function __construct(array $config = [], $mock = null)
    {
        // Apply some defaults.
        $config += [
            'description_path' => __DIR__ . '/descriptions/keyring.php',
        ];

        // Create the client.
        parent::__construct(
            $config,
            $mock
        );

    }
}