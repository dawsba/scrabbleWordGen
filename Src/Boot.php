<?php

namespace Src;

/**
 * Class Boot
 * @package Src
 */
class Boot
{
    /**
     * @var string
     */
    private $locale = 'en-gb';

    /**
     * @var string
     */
    private $root = __DIR__;

    /**
     * @var string
     */
    private $dictionaryPath = 'Engine/Dictionary';

    /**
     * @var string
     */
    private $dictionaryFileName = 'dictionary.txt';

    /**
     * @var string 
     */
    private $letterValuesFileName = 'letterValues.txt';

    /**
     * Boot constructor.
     * @param null|string $locale
     */
    public function __construct($locale = null)
    {
        if (null !== $locale) $this->setLocale($locale);
        $this->autoloader();
    }

    private function autoloader()
    {
        spl_autoload_register(function ($class_name) {
            include $class_name . '.php';
        });
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return string
     */
    public function getDictionaryFilePath()
    {
        return $this->getFilePathWithName($this->getDictionaryFileName());
    }

    /**
     * @return string
     */
    public function getLetterValuesFilePath()
    {
        return $this->getFilePathWithName($this->getLetterValuesFileName());
    }

    /**
     * @param $name
     * @return string
     */
    private function getFilePathWithName($name)
    {
        return sprintf(
            "%s/%s/%s",
            implode('/', array($this->getRoot(), $this->dictionaryPath)),
            $this->getLocale(),
            $name
        );
    }

    /**
     * @param string $dictionaryPath
     */
    public function setDictionaryPath($dictionaryPath)
    {
        $this->dictionaryPath = $dictionaryPath;
    }
    
    

    /**
     * @return string
     */
    public function getDictionaryFileName()
    {
        return $this->dictionaryFileName;
    }

    /**
     * @param string $dictionaryFileName
     */
    public function setDictionaryFileName($dictionaryFileName)
    {
        $this->dictionaryFileName = $dictionaryFileName;
    }

    /**
     * @return string
     */
    public function getLetterValuesFileName()
    {
        return $this->letterValuesFileName;
    }

    /**
     * @param string $letterValuesFileName
     */
    public function setLetterValuesFileName($letterValuesFileName)
    {
        $this->letterValuesFileName = $letterValuesFileName;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}
