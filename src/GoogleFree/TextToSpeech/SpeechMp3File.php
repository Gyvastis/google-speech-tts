<?php

namespace GoogleFree\TextToSpeech;


use GoogleFree\File\Mp3File;

class SpeechMp3File extends Mp3File
{
    /**
     * @var string
     */
    protected $text;

    /**
     * SpeechMp3File constructor.
     * @param string $text
     */
    public function __construct($text)
    {
        parent::__construct();

        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}