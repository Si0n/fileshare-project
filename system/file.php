<?php

namespace App\Local;

final class File
{
    const FILE_STATUS_UPLOADED = 0;
    const FILE_STATUS_APPROVED = 1;
    const FILE_STATUS_DISABLED = 2;

    private $file_id;
    private $path;
    private $original;
    private $filename;
    private $user_id;
    private $description;
    private $date_modified;
    private $date_upload;
    private $status;
    private $password;
    private $original_password;

    /*setters*/
    public function setFileId(int $file_id)
    {
        $this->file_id = $file_id;
    }

    public function setLocalPath(string $path)
    {
        $this->path = $path;
        return $this;
    }

    public function setOriginalName(string $original)
    {
        $this->original = $original;
        $this->filename = $this->generateFileName();
        return $this;
    }

    public function setOwner(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setDateModified(Date $date_modified)
    {
        $this->date_modified = $date_modified;
    }

    public function setDateUpload(Date $date_modified)
    {
        $this->date_upload = $date_modified;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setOriginalPassword(string $original_password)
    {
        $this->original_password = $original_password;
    }

    /*getters*/
    public function getProperties($properties)
    {
        foreach ($properties as $property) {
            if (property_exists($this, $property) && !is_null($this->{$property})) {
                yield $property => $this->{$property};
            }
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getOriginal()
    {
        return $this->original;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getOwner()
    {
        return $this->user_id;
    }

    public function getDateUpload()
    {
        return $this->date_upload;
    }

    public function getDateModified()
    {
        return $this->date_modified;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFileId()
    {
        return $this->file_id;
    }

    /*utils*/
    private function generateFileName()
    {
        $file_info = pathinfo($this->original);
        $file_name = md5($this->original . md5(date('Y-m-d H:i:s')));
        return "{$file_name}.{$file_info['extension']}";
    }

}