<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer
{

    protected $flyer;

    protected $file;

    public function __construct(Flyer $flyer, UploadedFile $file,Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    public function save()
    {
        // Attach the photo to the flyer
        $photo = $this->flyer->addPhoto($this->makePhoto());

        // move the photo to the images folder
        $this->file->move($photo->baseDir(),$photo->name);

        // generate a thunmbnail
        $this->thumbnail->make($photo->path,$photo->thumbnail_path);
    }

    protected function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    protected function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }
}