<?php

namespace App\Traits;
use DOMDocument;
use Image;
use File;

trait SummernoteTrait
{
    public function handleUploadedBody($body, $cropSizes)
    {
        $folderPath = public_path() . $this->folderPath();
        $imagePath = $this->folderPath();

        if (!File::exists($folderPath))
        {
            File::makeDirectory($folderPath, 0755, true, true);
        }

        if(!empty($body)){
            $dom = new DomDocument();
            $dom->loadHTML(mb_convert_encoding($body, 'HTML-ENTITIES', 'UTF-8'));
            $images = $dom->getElementsByTagName('img');
            foreach($images as $img){
                $src = $img->getAttribute('src');

                if(preg_match('/data:image/', $src)){

                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];

                    if($mimetype != 'svg+xml') {
                        $unique = uniqid();

                        if (!is_null($cropSizes)) {
                            $cropImage = Image::make($src);
                            if ($cropSizes[0] == null || $cropSizes[1] == null) {
                                $cropImage->resize($cropSizes[0],$cropSizes[1],function ($constraint){
                                    $constraint->aspectRatio();
                                });
                            } else {
                                $cropImage->fit($cropSizes[0], $cropSizes[1]);
                            }
                            $cropImage->save($folderPath . '/' . $unique . '.' . $mimetype);
                        }

                        $new_src = $imagePath . '/' . $unique . '.' . $mimetype;
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $new_src);
                        $img->setAttribute('data-name', $new_src);
                    } else {
                        $img->removeAttribute('src');
                        $img->setAttribute('alt', 'image format svg');
                    }
                }
            }
            $ready_body = $dom->saveHTML($dom->documentElement);
            return $ready_body;
        }
    }
}