{{ Form::label('sub_category_id', trans('product.lbl-subcatelory'), ['class' => 'col-md-12 control-label']) }}
<div class="col-md-12">
    {{ Form::select('sub_category_id', isset($subCategory) ? $subCategory : config('setting.defaul_select'), isset($sub_id) ? $sub_id : old('subCategory'), ['class' => 'form-control', 'id' => 'subCategory']) }}
</div>
