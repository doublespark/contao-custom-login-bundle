<?php

namespace Doublespark\ContaoCustomLoginBundle\Hooks;

use Contao\Config;
use Contao\Template;
use Doublespark\ContaoCustomLoginBundle\Helper\MessageLoader;
use Doublespark\ContaoCustomLoginBundle\Helper\TemplateLoader;
use GuzzleHttp\Client;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class TemplateHooks
 *
 * @package Doublespark\ContaoCustomLoginBundle\Hooks
 */
class TemplateHooks
{
    /**
     * @param Template $template
     */
    public function onParseTemplate($template)
    {
        if($template->getName() === 'be_login')
        {
            // Load the correct theme
            $theme = Config::get('dsCustomLoginTheme');

            // See if we should use the default template
            if(is_null($theme) || $theme === 'default')
            {
                // Use default template
                return;
            }

            // Template loader
            $templateLoader = new TemplateLoader('be_login-49');

            $version = '';
            $build   = '';

            if(defined('VERSION'))
            {
                $version = VERSION;
                $build   = BUILD;

                // Map versions to specific templates
                $templateLoader->addTemplate('4.4','*', 'be_login-44');
            }

            $arrThemes = [
                'ds' => 'ds-theme.css',
                'tf' => 'tf-theme.css'
            ];

            if(isset($arrThemes[$theme]))
            {
                $template->loginTheme = '/bundles/doublesparkcontaocustomlogin/css/'.$arrThemes[$theme];
            }

            $client        = new Client();
            $messageLoader = new MessageLoader($client);
            $messageLoader->setEndPointUrl(Config::get('dsCustomLoginEndpointUrl'));
            $arrMessages = $messageLoader->getMessages($theme);

            $arrStandardMessages = [];
            $arrStickyMessages   = [];

            if(isset($arrMessages['messages']) AND is_array($arrMessages['messages']))
            {
                foreach($arrMessages['messages'] as $message)
                {
                    if($message['sticky'])
                    {
                        $arrStickyMessages[]  = $message;
                    }
                    else
                    {
                        $arrStandardMessages[] = $message;
                    }
                }
            }

            $template->arrMessages       = $arrStandardMessages;
            $template->arrStickyMessages = $arrStickyMessages;

            if(isset($arrMessages['popup']) AND is_array($arrMessages['popup']))
            {
                $template->popupUrl   = $arrMessages['popup']['img'];
                $template->popupLink  = $arrMessages['popup']['link'];
                $template->popupWidth = $arrMessages['popup']['width'];
            }

            // Override template name with our custom template
            $template->setName($templateLoader->getTemplate($version,$build));
        }
    }
}