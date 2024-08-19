<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    const DELIVERY_TYPE_AUTO = 1;
    const DELIVERY_TYPE_AIR = 2;
    const DELIVERY_TYPE_TRAIN = 3;
    const DELIVERY_TYPE_MARINE = 4;
    const DELIVERY_TYPE_ALL = 5;

    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_REJECTED = 3;

    use ModelHelperTrait;

    protected $table = 'applications';

    protected $fillable = ['user_id', 'application_number', 'price', 'point_a_id', 'point_b_id', 'delivery_type', 'type', 'weight', 'volume', 'mileage', 'seats_number', 'order_date', 'arrival_date', 'additional_id', 'batch_id', 'status', 'created_at', 'updated_at', 'bitrix_id'];

    protected $with = ['batch', 'pointA', 'pointB', 'user'];

    public static function rules()
    {
        return [
            'batch_id' => 'integer|nullable',
            'user_id' => 'integer|nullable',
            'application_number' => 'integer|nullable',
            'point_a_id' => 'integer|required',
            'point_b_id' => 'integer|required',
            'delivery_type' => 'integer|nullable',
            'type' => 'integer|nullable',
            'weight' => 'nullable',
            'price' => 'string|nullable',
            'volume' => 'nullable',
            'mileage' => 'nullable',
            'seats_number' => 'nullable',
            'order_date' => 'nullable',
            'arrival_date' => 'integer|nullable',
            'additional_id' => 'integer|nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',
        ];
    }

    public function pointA(): BelongsTo
    {
        return $this->belongsTo(City::class, 'point_a_id');
    }

    public function pointB(): BelongsTo
    {
        return $this->belongsTo(City::class, 'point_b_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id')->withDefault();
    }

    public function setOrderDateAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['order_date'] = Carbon::createFromFormat('d.m.Y', $value)->unix();
        } else {
            $this->attributes['order_date'] = null;
        }
    }

    public function getOrderDateAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::createFromTimestamp($this->attributes['order_date'])->format('d.m.Y');
        }
        return null;
    }

    public function getApplicationNumberAttribute()
    {
        return $this->attributes['id'];
    }

    //    public function setStatusAttribute($value)
    //    {
    //        $this->attributes['status'] = (int)$value;
    //        if (in_array($value, [self::STATUS_COMPLETED, self::STATUS_REJECTED])) {
    //            if(empty($this->attributes['arrival_date'])) {
    //                $this->attributes['arrival_date'] = Carbon::now()->unix();
    //            }
    //        }
    //    }

    public static function getDeliveryTypeLabel($delivery_type): string
    {
        switch ($delivery_type) {
            case self::DELIVERY_TYPE_AUTO:
                return 'Авто';
            case self::DELIVERY_TYPE_AIR:
                return 'Авиа';
            case self::DELIVERY_TYPE_TRAIN:
                return 'Железнодорожная';
            case self::DELIVERY_TYPE_MARINE:
                return 'Морская';
            case self::DELIVERY_TYPE_ALL:
                return 'Все';
            default:
                return '-';
        }
    }

    public static function getDeliveryType($delivery_label): string
    {
        switch ($delivery_label) {
            case 'Авто':
                return self::DELIVERY_TYPE_AUTO;
            case 'Авиа':
                return self::DELIVERY_TYPE_AIR;
            case 'Железнодорожная':
                return self::DELIVERY_TYPE_TRAIN;
            case 'Морская':
                return self::DELIVERY_TYPE_MARINE;
            case 'Все':
                return self::DELIVERY_TYPE_ALL;
            default:
                throw new \DomainException('Invalid delivery type');
        }
    }
}
