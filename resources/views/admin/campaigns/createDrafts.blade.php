@extends('layouts.app')

@section('content')
<div class="card card-custom gutter-b">
    <div class="card-header">
        <h3 class="card-title">@lang('admin.campaigns.upload')</h3>
    </div>
    <!--begin::Form-->
    {!! Form::open(['route' => 'admin.drafts.store', 'method' => 'post', 'class' => 'form', 'enctype'=>"multipart/form-data"]) !!}
    @include('admin.campaigns._formDrafts')
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
