<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $fillable = ['name','path','thumbnail_path'];

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public function baseDir()
    {
        return 'images/photos';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir().'/'.$name;
        $this->thumbnail_path = $this->baseDir().'/tn-'.$name;
    }
    
    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path,
        ]);

        Parent::delete();
    }
}
