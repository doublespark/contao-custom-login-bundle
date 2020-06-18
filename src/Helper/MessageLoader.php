<?php

namespace Doublespark\ContaoCustomLoginBundle\Helper;

use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\Environment;
use Contao\System;
use GuzzleHttp\Client;
use Psr\Log\LogLevel;

class MessageLoader {

    /**
     * @var Client $client
     */
    protected $client;

    /**
     * The base URL e.g. https://www.doublespark.co.uk/lm/messages
     * @var string $endPointUrl
     */
    protected $endPointUrl;

    /**
     * MessageLoader constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $endPointUrl
     */
    public function setEndPointUrl($endPointUrl)
    {
        $this->endPointUrl = $endPointUrl;
    }

    /**
     * @param $theme
     * @return array
     */
    public function getMessages($theme=null)
    {
        try {

            $domain = Environment::get('host');

            $response = $this->client->get($this->endPointUrl.'?audience='.$theme.'&domain='.$domain);

            if($response->getStatusCode() === 200)
            {
                return json_decode($response->getBody()->getContents(),true);
            }

        } catch(\Exception $e) {

            $logger = System::getContainer()->get('monolog.logger.contao');
            $logger->log(LogLevel::ERROR, 'Error fetching login messages: '.$e->getMessage(), array('contao' => new ContaoContext('Doublespark\ContaoCustomLoginBundle\Helper\MessageLoader::getMessages()', 'ERROR')));

        }

        return [];
    }
}