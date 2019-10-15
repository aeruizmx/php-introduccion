<?php
namespace App\Traits;

trait HasDefaultImage{
    public function getImage($altImage){
        if(!$this->file){
            return "https://ui-avatars.com/api/?name=$altImage+Doe&size=255";
        }
        return $this->file;
    }
}