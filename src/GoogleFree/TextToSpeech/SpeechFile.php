<?php

namespace GoogleFree\TextToSpeech;


use GoogleFree\File\Mp3File;

class SpeechFile extends Mp3File
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $languageTag = 'en-US';

    /**
     * SpeechMp3File constructor.
     * @param string $text
     * @param string $languageTag
     */
    public function __construct($text, $languageTag)
    {
        parent::__construct();

        $this->text = $text;
        $this->languageTag = $languageTag;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getLanguageTag()
    {
        return $this->languageTag;
    }

}