<?php
namespace Bookdown\Bookdown\Config;

use Bookdown\Bookdown\Exception;

class RootConfig extends Config
{
    protected $target;
    protected $conversionBuilder;
    protected $renderingBuilder;
    protected $templates = array();
    protected $templateName;

    protected function init()
    {
        parent::init();
        $this->initTarget();
        $this->initTemplates();
        $this->initTemplateName();
        $this->initConversionBuilder();
        $this->initRenderingBuilder();
    }

    protected function initTarget()
    {
        $target = isset($this->json->target)
            ? $this->json->target
            : '_site';

        $target = rtrim($this->fixPath($target), DIRECTORY_SEPARATOR);
        $this->target = $target . DIRECTORY_SEPARATOR;
    }

    protected function initTemplates()
    {
        $this->templates = isset($this->json->templates)
            ? (array) $this->json->templates
            : array();
    }

    protected function initTemplateName()
    {
        $this->templateName = isset($this->json->templateName)
            ? $this->json->templateName
            : null;
    }

    protected function initConversionBuilder()
    {
        $this->conversionBuilder = isset($this->json->conversionBuilder)
            ? $this->json->conversionBuilder
            : 'Bookdown\Bookdown\Process\ConversionProcessBuilder';
    }

    protected function initRenderingBuilder()
    {
        $this->renderingBuilder = isset($this->json->renderingBuilder)
            ? $this->json->renderingBuilder
            : 'Bookdown\Bookdown\Process\RenderingProcessBuilder';
    }

    public function getConversionBuilder()
    {
        return $this->conversionBuilder;
    }

    public function getRenderingBuilder()
    {
        return $this->renderingBuilder;
    }

    public function getTarget()
    {
        return $this->target;
    }

    public function getTemplates()
    {
        return $this->templates;
    }

    public function getTemplateName()
    {
        return $this->templateName;
    }

    public function get($key, $alt = null)
    {
        if (isset($this->json->$key)) {
            return $this->json->$key;
        }
        return $alt;
    }
}
