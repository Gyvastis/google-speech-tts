<?php

namespace GoogleFree\TextToSpeech;


use GuzzleHttp\ClientInterface;

class Client
{
    /**
     * @var string
     */
    private $googleTranslateUrl = 'http://translate.google.com/';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $audioOutputDir = './audio/';

    /**
     * @var string
     */
    private $languageTag = 'en-US';

    /**
     * Client constructor.
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return string
     */
    public function getGoogleTranslateUrl()
    {
        return $this->googleTranslateUrl;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getAudioOutputDir()
    {
        return $this->audioOutputDir;
    }

    /**
     * @param string $audioOutputDir
     */
    public function setAudioOutputDir($audioOutputDir)
    {
        $this->audioOutputDir = $audioOutputDir;
    }

    /**
     * @return string
     */
    public function getLanguageTag()
    {
        return $this->languageTag;
    }

    /**
     * @param string $languageTag
     */
    public function setLanguageTag($languageTag)
    {
        $this->languageTag = $languageTag;
    }

    /**
     * @param SpeechMp3File $speechFile
     * @return bool
     */
    public function downloadAudio($speechFile)
    {
        $speechFile->setPath($this->getAudioOutputDir());

        $response = $this->getHttpClient()->request('GET', $this->getGoogleTtsUrl(), [
            'query' => $this->getQueryParams($speechFile->getText()),
            'headers' => $this->getHttpClientHeaders(),
            'save_to' => $speechFile->getFullPath()
        ]);

        return $response->getStatusCode() == 200;
    }

    /**
     * @return string
     */
    private function getGoogleTtsUrl()
    {
        return $this->getGoogleTranslateUrl() . 'translate_tts';
    }

    /**
     * @param string $text
     * @return array
     */
    private function getQueryParams($text)
    {
        return [
            'ie' => 'UTF-8',
            'q' => $text,
            'client' => 'tw-ob',
            'tl' => $this->getLanguageTag()
        ];
    }

    /**
     * @return array
     */
    private function getHttpClientHeaders() {
        return [
            'Referer' => $this->getGoogleTranslateUrl(),
            'User-Agent'=> 'stagefright/1.2 (Linux;Android 5.0)',
            'Content-type' => 'audio/mpeg'
        ];
    }
}