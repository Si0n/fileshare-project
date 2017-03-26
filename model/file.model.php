<?php
namespace App\Model;
use App\Local\File as LocalFile;
Class File extends Model {
    private $allowed = ['user_id', 'filename', 'original', 'path', 'date_upload', 'date_modified', 'status', 'password'];
    private $properties = [];
    private $prepared = [];
    public function saveFile(LocalFile $file) {
        foreach ($file->getProperties($this->allowed) as $column => $value) {
            $this->properties[$column] = $value;
        }
        return $this;
    }
    public function insert() {
        $sql = "INSERT INTO file SET ";
        foreach ($this->properties as $key => $value) {
            $this->prepared[] = "`{$key}` = :{$key}";
        }
        $sql .= implode(", ", $this->prepared);
        $stmt = $this->db->prepare($sql);
        foreach ($this->properties as $key => &$value) {
            $stmt->bindParam(":{$key}", $value);
        }
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function update() {

    }

    public function delete() {

    }


}