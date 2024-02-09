@if(isset($calculatorData['point_a_country_id']))
    <input type="hidden" name="point_a_country_id" value="{{ $calculatorData['point_a_country_id'] }}">
@endif
@if(isset($calculatorData['point_b_country_id']))
    <input type="hidden" name="point_b_country_id" value="{{ $calculatorData['point_b_country_id'] }}">
@endif
@if(isset($calculatorData['point_a_id']))
    <input type="hidden" name="point_a_id" value="{{ $calculatorData['point_a_id'] }}">
@endif
@if(isset($calculatorData['point_b_id']))
    <input type="hidden" name="point_b_id" value="{{ $calculatorData['point_b_id'] }}">
@endif
@if(isset($calculatorData['activity_id']))
    <input type="hidden" name="activity_id" value="{{ $calculatorData['activity_id'] }}">
@endif
@if(isset($calculatorData['delivery_type']))
    <input type="hidden" name="delivery_type" value="{{ $calculatorData['delivery_type'] }}">
@endif
@if(isset($calculatorData['weight']))
    <input type="hidden" name="weight" value="{{ $calculatorData['weight'] }}">
@endif
@if(isset($calculatorData['volume']))
    <input type="hidden" name="volume" value="{{ $calculatorData['volume'] }}">
@endif
@if(isset($calculatorData['additional_id']))
    <input type="hidden" name="additional_id" value="{{ $calculatorData['additional_id'] }}">
@endif
