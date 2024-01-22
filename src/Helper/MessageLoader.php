<?php

namespace Doublespark\ContaoCustomLoginBundle\Helper;

use Contao\Config;
use Contao\Environment;

class MessageLoader {

    /**
     * The base URL e.g. https://www.doublespark.co.uk/lm/messages
     * @var string $endPointUrl
     */
    protected $endPointUrl;

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
    public function getMessages($theme='')
    {
        if(!Config::get('dsCustomLoginRemoteMessages'))
        {
            return [];
        }

        $domain = Environment::get('host');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endPointUrl.'?audience='.$theme.'&domain='.$domain);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if(!$output)
        {
            print curl_error($ch);
        }

        if($responseCode === 200)
        {
            return json_decode($output,true);
        }

        return [];
    }
}