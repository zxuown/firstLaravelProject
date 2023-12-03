<?php
/**
 * @var $model \App\Models\Question
 */

?>
@extends('layouts.myapp')

@section('page_title', __('site.action.create_entity', ['entity' => __('site.option.single')]))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data" action="{{route('options.store')}}">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{__('site.options.field.title')}}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$model->title}}">
                    </div>
                   <div class="mb-3">
                        <label for="image" class="form-label">{{__('site.options.field.image')}}</label>
                        <input type="file" class="form-control" accept=".jpg,.png,.jpeg" id="image" name="image">
                    </div>
                    <input type="hidden" name="question_id" value="{{$model->question_id}}">

                    <button class="btn btn-primary">{{__('site.action.save')}}</button>
                </form>

            </div>
        </div>
    </div>
@endsection


@push('scripts')

@endpush

@push('styles')

@endpush
