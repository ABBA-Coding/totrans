<?php

namespace App\Models;

use App\Services\BitrixService;
use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use ModelHelperTrait;

    const TYPE_FEEDBACK = 1;
    const TYPE_PAYMENT = 2;

    const TRANSPORT_VOLUME = 110;
    const TRANSPORT_WEIGHT = 25000;

    protected $table = 'feedback';

    protected $fillable = ['name', 'phone', 'email', 'message', 'type', 'status', 'created_at', 'updated_at',
        'point_a_id', 'point_b_id', 'delivery_type', 'weight', 'volume', 'mileage', 'seats_number', 'order_date',
        'activity_id', 'additional_id'];

    public static function rules()
    {
        return [
            'name' => 'string|required',
            'phone' => 'string|required',
            'message' => 'string|required',
            'type' => 'integer|nullable',
            'status' => 'integer|nullable',
            'created_at' => 'date|nullable',
            'updated_at' => 'date|nullable',

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

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function additional(): BelongsTo
    {
        return $this->belongsTo(AdditionalFunction::class, 'additional_id');
    }

    public static function calculatePrice($feedback)
    {
        $city = City::findOrFail($feedback->point_a_id);
        $transport_price = $city->transport_price ?? 0;

        $priceByVolume = ($transport_price / self::TRANSPORT_VOLUME) * $feedback->volume;
        $priceByWeight = ($transport_price / self::TRANSPORT_WEIGHT) * $feedback->weight;

        return $priceByVolume > $priceByWeight ? $priceByVolume : $priceByWeight;
    }

    // attributes
    public function getStatusUIAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<span class="btn-status btn-status-success">новый заявка</span>';
            case 1:
                return '<span class="btn-status btn-status-warning">прочитано</span>';
            default:
                return '';
        }
    }
}
