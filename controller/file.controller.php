<?php

namespace App\Controller;

class File extends Controller
{
    public function index($request, $response, $args)
    {
        $x = 0;
    }

    public function upload($request, $response, $args)
    {
        $files = $request->getUploadedFiles();
        if (empty($files['file'])) {
            throw new Exception('Expected a file');
        }
        $file = $files['file'];
        if ($file->getError() === UPLOAD_ERR_OK) {

            $uploadFileName = $file->getClientFilename();
            $filename = $this->generateFileName($uploadFileName);
            $file->moveTo("/path/to/$uploadFileName");
        } else {
            $this->container->{'App\Controller\Home'}->index($request, $response, $args);
        }
    }

    private function generateFileName($old_filename)
    {
        $fileinfo = pathinfo($old_filename);
        $file_name = md5($old_filename . md5(date()));
        return "{$file_name}.{$fileinfo['extension']}";
    }
    private function getRootPath() {
        $root = $this->container->get('dir');
        /*TODO*/
    }
    private function validateFile($file) {
        //
    }
}