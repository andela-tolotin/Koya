<?php

namespace Koya\Libraries;

use Cloudinary as CloudUpload;
use Cloudinary\Uploader as Uploader;

class Cloudinary
{
    public function __construct()
    {
        CloudUpload::config([
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ]);

        $this->image_options = [
            'crop'    => 'fill',
            'gravity' => 'face',
        ];
    }

    public function upload($file)
    {
        return Uploader::upload($file);
    }

    public function setCloudinaryID($cloudinary_id)
    {
        $this->cloudinary_id = $cloudinary_id;

        return $this;
    }

    public function getFullImage()
    {
        try {
            return $this->getImage($this->cloudinary_id);
        } catch (\Exception $x) {
            return;
        }
    }

    public function cropImage($width, $height)
    {
        $data = [
            'width'   => $width,
            'height'  => $height,
            'crop'    => 'fill',
            'gravity' => 'face',
        ];

        $this->image_options = array_merge($this->image_options, $data);

        return $this;
    }

    public function roundEdge($radius = 'max')
    {
        $data = [
            'radius' => $radius,
        ];

        $this->image_options = array_merge($this->image_options, $data);

        return $this;
    }

    public function reduceOpacity($opacity = 100)
    {
        $data = [
            'opacity'   => $opacity,
        ];

        $this->image_options = array_merge($this->image_options, $data);

        return $this;
    }

    public function makeThumb()
    {
        $data = [
            'crop' => 'thumb',
        ];
        $this->image_options = array_merge($this->image_options, $data);

        return $this;
    }

    public function getImageOptions()
    {
        return $this->image_options;
    }

    public function getImage()
    {
        try {
            return cl_image_tag($this->cloudinary_id, $this->image_options);
        } catch (\Exception $ex) {
            return;
        }
    }
}
