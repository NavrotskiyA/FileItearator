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

    /**
     *  Получение ключей массива и первой строки со значеними
     */
    protected function init()
    {
        $this->file = fopen($this->path, 'r');
//        $this->keys = fgetcsv($this->file);
        $this->fileArray[$this->index] = $this->getString()->current();
    }
    protected function getString()
    {
//        while($string = fgetcsv($this->file)){
//            yield array_combine($this->keys, $string);
//        }
        while($string = fgets($this->file)){
            yield $string;
        }
    }
    public function current()
    {
        return $this->fileArray[$this->index];
    }

    public function next()
    {
        $this->index++;
        $this->fileArray[$this->index] = $this->getString()->current();
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return isset($this->fileArray[$this->index]);
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