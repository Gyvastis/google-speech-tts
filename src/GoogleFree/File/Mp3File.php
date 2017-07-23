<?php

namespace GoogleFree\File;


class Mp3File extends File
{
    /**
     * @var string
     */
    protected $extension = 'mp3';

    /**
     * FileMp3 constructor.
     */
    public function __construct()
    {
        $this->setName(md5(uniqid(null, true)));
    }
}