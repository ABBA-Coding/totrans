<?php

namespace Modules\Filemanager\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Modules\Filemanager\Helpers\FileManagerHelper;

class Files extends Model
{
    protected $fillable = ['id','name','src','file','ext','size','domain','slug','path','folder','folder_id','type','created_at','updated_at', 'uid'];

    protected $appends = [
        'thumbnails'
    ];

    public function getIsImage()
    {
        return FileManagerHelper::getImagesExt();
    }

    /**
     * @return string
     */
    public function getDist()
    {
        return $this->path .'/'. $this->file;
    }

    public function getSrc()
    {
        return $this->domain .'/'. $this->src;
    }

    public function getName()
    {
        return explode('.', $this->name)[0];
    }

    /**
     * @return mixed
     */
    public function getThumbnailsAttribute()
    {
        $thumbsImages = FileManagerHelper::getThumbsImage();
        foreach ($thumbsImages as &$thumbsImage) {
            $slug = $thumbsImage['slug'];
            $newFileDist = Config::get('env.STATIC_URL').'/'.$this->folder.$this->slug . "_".$slug . "." . $this->ext;
            $thumbsImage['src'] = $newFileDist;
            $thumbsImage['file'] = $this->slug . "_".$slug . "." . $this->ext;
        }
        return $thumbsImages;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            for (;;) {
                $uid = Str::random(12);
                if (!Files::where('uid', $uid)->exists()) {
                    $model->uid = $uid;
                    break;
                }
            }
        });

        static::updating(function ($model) {
            if (!empty($model->uid)) {
                for (;;) {
                    $uid = Str::random(12);
                    if (!Files::where('uid', $uid)->exists()) {
                        $model->uid = $uid;
                        break;
                    }
                }
            }
        });

        static::deleting(function ($model) {
            /**
             * Remove Folder
             */

            @unlink(base_path('static/'.$model->src));
            foreach ($model->thumbnails as $thumbnail) {
                @unlink(base_path('static/'.$model->folder.'/'.$thumbnail['file']));
            }
        });
    }
}
