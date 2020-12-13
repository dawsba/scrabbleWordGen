<?php


namespace Src\Engine\Dictionary;


use Src\Boot;

/**
 * Class Dictionary
 * @package Src\Engine\Dictionary
 */
class Dictionary
{
    /**
     * @var array
     */
    private $words = array();

    /**
     * @var array
     */
    private $values = array();

    /**
     * @var string
     */
    private $pathToDict = '/filename.txt';

    /**
     * @var string
     */
    private $pathToValues = '/filename.txt';

    /**
     * Dictionary constructor.
     * @param Boot $boot
     */
    public function __construct(Boot $boot)
    {
        $this->setPathToDict($boot->getDictionaryFilePath());
        $this->setPathToValues($boot->getLetterValuesFilePath());
    }

    private function getDataFromFilesandSet($path, $method)
    {
        try {
            if (is_file($path) && method_exists($this, $method)) {
                call_user_func(array($this, $method), file($path, FILE_SKIP_EMPTY_LINES) ?: array());

                return true;
            }
        }
        catch (\Throwable $e) {

        }

        return false;
    }

    /**
     * @return bool
     */
    private function loadDictionary()
    {
        return $this->getDataFromFilesandSet($this->getPathToDict(), 'setWords');
    }

    /**
     * @return bool
     */
    private function loadLetterValues()
    {
        return $this->getDataFromFilesandSet($this->getPathToValues(), 'setValues');
    }

    /**
     * @return string
     */
    public function getPathToDict()
    {
        return $this->pathToDict;
    }

    /**
     * @param string $pathToDict
     * @return Dictionary
     */
    public function setPathToDict($pathToDict)
    {
        $this->pathToDict = $pathToDict;

        return $this;
    }

    /**
     * @return array
     */
    public function getWords()
    {
        if (empty($this->words)) {
            $this->loadDictionary();
        }

        return $this->words;
    }

    /**
     * @param string $word
     * @return bool
     */
    public function wordInWords($word)
    {
        $words = $this->getWords();

        return in_array($word, $words);
    }

    /**
     * @param array $words
     * @return Dictionary
     */
    public function setWords($words)
    {
        $this->words = $words;

        return $this;
    }

    /**
     * @return string
     */
    public function getPathToValues()
    {
        return $this->pathToValues;
    }

    /**
     * @param string $pathToValues
     */
    public function setPathToValues($pathToValues)
    {
        $this->pathToValues = $pathToValues;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        if (empty($this->values)) {
            $this->loadLetterValues();
        }
        
        return $this->values;
    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $letterAndScore = array();

        foreach ($values as $letter) {
            $score = explode(':', $letter);
            $letterAndScore[$score[0]] = (int) $score[1];
        }

        $this->values = $letterAndScore;
    }
}
