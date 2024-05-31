<?php

class FileManager
{
    /**  @var string|bool $currentDir */
    private string|bool $rootDir;

    /**  @var string $currentDir */
    private string $currentDir;

    /**  @var string|bool $fullPath */
    private string|bool $fullPath;

    /**  @var string $allowedFilesToShow */
    private string $allowedFilesToShow = '/\.(jpe?g|png|gif)$/i';

    /**
     * Constructor method for creating an instance of the class.
     *
     * @param string $rootDir
     * @param string $currentDir
     *
     * @throws Exception
     */
    public function __construct(string $rootDir, string $currentDir)
    {
        $this->rootDir = realpath($rootDir);
        $this->currentDir = $currentDir;
        $this->fullPath = realpath($this->rootDir . DIRECTORY_SEPARATOR . $currentDir);

        if (!str_starts_with($this->fullPath, $this->rootDir)) {
            throw new Exception('Access denied.');
        }
    }

    /**
     * Get the items in the current directory.
     *
     * This method scans the current directory and returns the items found,
     * excluding the parent directory ('.') and the root directory ('..').
     *
     * @return array
     */
    public function getItems(): array
    {
        $items = scandir($this->fullPath);
        $result = [];

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $itemPath = $this->fullPath . DIRECTORY_SEPARATOR . $item;
            $relativePath = $this->currentDir ? $this->currentDir . DIRECTORY_SEPARATOR . $item : $item;

            if (is_dir($itemPath)) {
                $result[] = [
                    'type' => 'dir',
                    'name' => $item,
                    'path' => $relativePath
                ];
            } elseif (preg_match($this->allowedFilesToShow, $item)) {
                $result[] = [
                    'type' => 'file',
                    'name' => $item
                ];
            }
        }

        return $result;
    }

    /**
     * Get the current directory.
     *
     * @return string
     */
    public function getCurrentDir(): string
    {
        return $this->checkTopDir() ? 'Main' : $this->currentDir;
    }

    /**
     * Check if the current directory is the top directory.
     *
     * @return bool
     */
    public function checkTopDir(): bool
    {
        return $this->currentDir === '.' || empty($this->currentDir);
    }

    /**
     * Returns the parent directory of the current directory.
     *
     * @return string
     */
    public function getParentDir(): string
    {
        return $this->currentDir ? dirname($this->currentDir) : '';
    }
}