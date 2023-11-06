<?php
namespace kapcco\core;

class Uploader{
    private $filename;
    private $file_data;
    private $file_destination;

    public function __construct($key){
        $this->filename = basename($_FILES[$key]['name']);
        $this->file_data = $_FILES[$key]['tmp_name'];
    }

    public function save_in($folder){
        $this->file_destination = $folder;
    }

    public function save(){
        $name = $this->file_destination . $this->filename;
        $success = move_uploaded_file($this->file_data, $name);

        return $success;
    }

    public function get_file_name(){
        return $this->filename;
    }
}
?>