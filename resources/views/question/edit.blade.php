<?php
/**
 * @var $model \App\Models\Question
 */

?>
@extends('layouts.myapp')

@section('page_title', __('site.action.edit_entity', ['entity' => __('site.question.single')]))

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{__('site.action.edit_entity', ['entity' => __('site.question.single')])}}</h1>
            <div class="col-md-12">
                <form method="post" enctype="multipart/form-data" action="{{route('questions.update', [$model])}}">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">{{__('site.question.field.title')}}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$model->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{__('site.question.field.description')}}</label>
                        <textarea class="form-control" id="description"
                                  name="description">{{$model->description}}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="start_at" class="form-label">{{__('site.question.field.start_at')}}</label>
                                <input type="datetime-local" class="form-control" id="start_at" name="start_at"
                                       value="{{$model->start_at}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="end_at" class="form-label">{{__('site.question.field.end_at')}}</label>
                                <input type="datetime-local" class="form-control" id="end_at" name="end_at"
                                       value="{{$model->end_at}}">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{$model->user_id}}">
                        <div class="mb-3">
                        <input class="form-check-input" type="checkbox" {{ $model->active == '1' ? 'checked' : null }} id="active" name="active" value="1">
                            <label class="form-check-label" for="active">
                            {{__('site.question.field.active')}}
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{__('site.question.field.image')}}</label>
                            <input type="file" class="form-control" accept=".jpg,.png,.jpeg" id="image" name="image">
                        </div>
                    </div>
                    <a href="{{route('options.index', [$model])}}" class="btn btn-primary">{{__('site.action.editOptions')}}</a>
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
