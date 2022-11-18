<?php

namespace Doublespark\ContaoCustomLoginBundle\Helper;

class TemplateLoader {

    /**
     * The default template
     * @var string
     */
    protected $defaultTemplate = '';

    /**
     * Template map
     * ['version' => ['*' => 'templateName', 'build' => 'templateName']
     * @var array
     */
    protected $arrTemplateMap = [];

    /**
     * TemplateLoader constructor.
     *
     * @param string $defaultTemplate
     */
    public function __construct($defaultTemplate)
    {
        $this->setDefaultTemplate($defaultTemplate);
    }

    /**
     * @param string $templateName
     */
    public function setDefaultTemplate($templateName)
    {
        $this->defaultTemplate = $templateName;
    }

    /**
     * Add a template to the configuration
     * @param string|array $version
     * @param string $build
     * @param string $templateName
     */
    public function addTemplate($version,$build,$templateName)
    {
        if(is_array($version))
        {
            foreach($version as $v)
            {
                $this->arrTemplateMap[$v][$build] = $templateName;
            }
        }
        else
        {
            $this->arrTemplateMap[$version][$build] = $templateName;
        }
    }

    /**
     * @param $version
     * @param $build
     * @return string
     */
    public function getTemplate($version, $build)
    {
        if(isset($this->arrTemplateMap[$version]))
        {
            if(isset($this->arrTemplateMap[$version][$build]))
            {
                return $this->arrTemplateMap[$version][$build];
            }
            else {
                return $this->arrTemplateMap[$version]['*'];
            }
        }
        else
        {
            return $this->defaultTemplate;
        }
    }

}