<?php

namespace App\Controller;
use App\Local\File as LocalFile;
use App\Local\Dir as Dir;
use App\Model\File as FileModel;
use App\Security\Password as Password;

class File extends Controller
{
    public function index($request, $response, $args)
    {
        $x = 0;
    }

    private function file(LocalFile $file) {

    }


    public function files(array $request, array $args) {

    }

    public function upload($request)
    {
        $response = [];

        $files = $request->getUploadedFiles();
        if (empty($files)) {
            throw new Exception('Expected a file');
        }
        foreach ($files as $file) {
            $local_file = $this->uploadFile($file);
            $model = new FileModel($this->container->db);
            $file_id = $model->saveFile($local_file)->insert();
            $local_file->setFileId($file_id);
            $response[$file->getClientFilename()] = $local_file;
        }
        return $response;
    }

    private function uploadFile($file): LocalFile
    {
        if ($file->getError() === UPLOAD_ERR_OK) {
            $local_file = new LocalFile();
            $dir = (new Dir($this->container->get('dir')))->makeDirs();
            $local_file->setOriginalName($file->getClientFilename());
            $local_file->setLocalPath($dir->getPath());
            $local_file->setStatus(LocalFile::FILE_STATUS_UPLOADED);
            $dir->makeDirs();
            $file->moveTo($dir->getFullPath($local_file));

            /*security*/
            $password = Password::generatePassword(6);
            $encrypted = Password::encryptPassword($password);
            $local_file->setOriginalPassword($password);
            $local_file->setPassword($encrypted);
            return $local_file;
        } else {
            Throw new Exception("Error while uploading File: {$file->getClientFilename()}, Error: {$file->getError()}");
        }

    }








    private function validateFile($file)
    {
        //
    }
}