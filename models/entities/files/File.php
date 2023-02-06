<?php

namespace models\entities\files;

class File {
    private int $fileId;
    private string $fileName;
    private bool $isUser;

    /**
     * @return int
     */
    public function getFileId(): int
    {
        return $this->fileId;
    }

    /**
     * @param int $fileId
     */
    public function setFileId(int $fileId): void
    {
        $this->fileId = $fileId;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->isUser;
    }

    /**
     * @param bool $isUser
     */
    public function setIsUser(bool $isUser): void
    {
        $this->isUser = $isUser;
    }


}