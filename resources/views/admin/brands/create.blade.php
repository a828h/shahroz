@extends('layouts.app')

@section('content')
<!--end::Portlet-->
<div class="card card-custom gutter-b">
    <div class="card-header">
        <h3 class="card-title">@lang('admin.brands.create')</h3>
    </div>
    <!--begin::Form-->
    {!! Form::open(['route' => 'admin.brands.store', 'method' => 'post', 'class' => 'form']) !!}
    @include('admin.brands._form')
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary mr-2">@lang('admin.global.save')</button>
                <button type="reset" class="btn btn-secondary">@lang('admin.global.cancel')</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!--end::Form-->
</div>
@endsection