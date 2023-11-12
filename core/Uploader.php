<?php
namespace kapcco\core;

class Uploader{
    private $filename;
    private $file_data;
    private $file_destination;
    private $new_file_name;

    public function __construct($key){
        $this->filename = basename($_FILES[$key]['name']);
        $this->file_data = $_FILES[$key]['tmp_name'];
    }
    public function save_in($folder){
        $this->file_destination = $folder;
    }

    private function generateUniqueFilename() {
        $originalExtension = pathinfo($this->filename, PATHINFO_EXTENSION);
        $uniqueFilename = uniqid() . '.' . $originalExtension;

        $this->new_file_name = $uniqueFilename;
        
        return $uniqueFilename;
    }


    public function save(){
        $uniqueFilename = $this->generateUniqueFilename();
        $name = $this->file_destination . $uniqueFilename;
        $success = move_uploaded_file($this->file_data, $name);

        return $success ? $uniqueFilename : false;
    }

    public function get_file_name(){
        return $this->new_file_name;
    }
}
?>