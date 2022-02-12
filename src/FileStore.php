<?php

namespace src;

class FileStore implements \Iterator
{
    protected $file;
    protected $keys;
    protected $path;
    protected $index = 0;
    protected $fileArray = [];

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    protected function init()
    {
        $this->file = fopen($this->path, 'r');
        $this->fileArray[$this->index] = $this->getString();
    }
    protected function getString()
    {
        return fgets($this->file);
    }
    public function current()
    {
        return $this->fileArray[$this->index];
    }

    public function next()
    {
        $this->index++;
        $this->fileArray[$this->index] = $this->getString();
    }

    public function key()
    {
        return $this->index;
    }

    public function valid(): bool
    {
        if($this->fileArray[$this->index] == ''){
            return false;
        }
        return true;
    }

    public function rewind()
    {
        if (isset($this->file)){
            fclose($this->file);
        }
        $this->init();
        $this->index = 0;
    }
}