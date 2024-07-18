<?php

namespace Lucasnribeiro\FormForge;

class FileCache
{
    private static $instance;
    private $cacheDir;

    private function __construct()
    {
        $this->cacheDir = __DIR__ . '/../cache/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function has($key)
    {
        $filename = $this->getFilename($key);
        return file_exists($filename) && filemtime($filename) > time() - 3600; // 1 hour expiration
    }

    public function get($key)
    {
        $filename = $this->getFilename($key);
        if ($this->has($key)) {
            return file_get_contents($filename);
        }
        return null;
    }

    public function set($key, $value)
    {
        $filename = $this->getFilename($key);
        file_put_contents($filename, $value);
    }

    public function clear()
    {
        array_map('unlink', glob($this->cacheDir . '*'));
    }

    private function getFilename($key)
    {
        return $this->cacheDir . md5($key) . '.cache';
    }
}
