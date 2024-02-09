<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.11.2019
 * Time: 13:33
 */

namespace Modules\Filemanager\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Modules\Filemanager\Entities\Files;
use Modules\Filemanager\Helpers\FileManagerHelper;


class FileService
{
    public function uploadFiles(array $files, $folder_id = null, $type = 1)
    {
        $folder = $this->generateFolderPath();

        foreach ($files as $file) {
            $file_hash = Str::random(32);
            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($extension, ["pdf", "doc", "docx", "xls", "xlsx", "jpg", "jpeg", "png", "svg", "mp4", "webp"])) {
                throw new \Exception('Файл должен быть файлом типа: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, svg, mp4, webp');
            }

            $data = [
                'name' => $file->getClientOriginalName(),
                'slug' => $file_hash,
                'ext' => $extension,
                'src' => $folder['folder_path'].$file_hash.'.'.$extension,
                'file' => $file_hash.'.'.$extension,
                'folder' => $folder['folder_path'],
                'folder_id' => $folder_id,
                'domain' => Config::get('env.STATIC_URL'),
                'path' => $folder['base_path'],
                'size' => $file->getSize(),
                'type' => $type
            ];
            $file->storeAs($data['folder'], $data['slug'].'.'.$data['ext'], 'static');

            $model = new Files();
            $model = $model->create($data);
            $this->createThumbnails($model);
        }
    }

    public function generateFolderPath()
    {
        $created_at = time();

        $y = date("Y", $created_at);
        $m = date("m", $created_at);
        $d = date("d", $created_at);
        $h = date("H", $created_at);
        $i = date("i", $created_at);

        $folders = [
            $y,
            $m,
            $d,
            $h,
            $i
        ];

        $basePath = base_path('static');
        $folderPath = '';
        foreach ($folders as $folder) {
            $basePath .= '/' . $folder;
            $folderPath .= $folder . '/';
            if (!is_dir($basePath)) {
                mkdir($basePath, 0777);
                chmod($basePath, 0777);
            }
        }

        if (!is_writable($basePath)) {
            throw new \DomainException("Path is not writeable");
        }

        return ['folder_path'=>$folderPath,'base_path'=>$basePath];
    }

    public function createThumbnails($file)
    {
        if (!$file->getIsImage()) {
            return null;
        }
        $thumbsImages = FileManagerHelper::getThumbsImage();
        $origin = $file->getDist();
        try {
            foreach ($thumbsImages as $thumbsImage) {
                $width = $thumbsImage['w'];
                $qualty = $thumbsImage['q'];
                $slug = $thumbsImage['slug'];
                $newFileDist = $file->path .'/'. $file->slug . "_" . $slug . "." . $file->ext;
                if (!in_array($file->ext, ["jpg", "jpeg", "png"])) {
                    copy($origin, $newFileDist);
                } else {
                    $img = Image::make($origin);
                    $height = $width / ($img->getWidth() / $img->getHeight());
                    $img->resize($width,$height)->save($newFileDist, $qualty);
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return true;
    }
}
