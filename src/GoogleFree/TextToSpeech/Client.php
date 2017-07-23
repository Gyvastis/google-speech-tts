<?php

namespace GoogleFree\TextToSpeech;


use GuzzleHttp\ClientInterface;

class Client
{
    /**
     * @var string
     */
    private $googleTtsUrl = 'http://translate.google.com/translate_tts';

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $audioOutputDir = './audio';

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
    public function getGoogleTtsUrl()
    {
        return $this->googleTtsUrl;
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
     * @param string $text
     * @return bool
     */
    public function downloadAudio($text)
    {
        $response = $this->getHttpClient()->request('GET', $this->getGoogleTtsUrl(), [
            'query' => $this->getQueryParams($text),
            'headers' => $this->getHttpClientHeaders(),
            'save_to' => $this->getAudioOutputDir()
        ]);

        return $response->getStatusCode() == 200;
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
            'Referer' => 'http://translate.google.com/',
            'User-Agent'=> 'stagefright/1.2 (Linux;Android 5.0)',
            'Content-type' => 'audio/mpeg'
        ];
    }
}