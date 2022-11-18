<?php

namespace Doublespark\ContaoCustomLoginBundle\Hooks;

use Contao\Config;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\Template;
use Doublespark\ContaoCustomLoginBundle\Helper\MessageLoader;
use Doublespark\ContaoCustomLoginBundle\Helper\TemplateLoader;

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
    public function onParseTemplate(Template $template): void
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
            $templateLoader = new TemplateLoader('be_login-50');

            $version = '';
            $build   = '';

            $version = ContaoCoreBundle::getVersion();
            $arrVersion = explode('.', $version);

            if(is_array($arrVersion))
            {
                $version = sprintf('%d.%d',$arrVersion[0],$arrVersion[1]);
                $build   = $arrVersion[2];

                // Map versions to specific templates
                $templateLoader->addTemplate('5.0','*', 'be_login-50');
            }

            $arrThemes = [
                'ds' => 'ds-theme.css',
                'tf' => 'tf-theme.css'
            ];

            if(isset($arrThemes[$theme]))
            {
                $template->loginTheme = '/bundles/doublesparkcontaocustomlogin/css/'.$arrThemes[$theme];
            }

            $messageLoader = new MessageLoader();
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