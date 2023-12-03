<?php
/**
 * @var \App\Models\Question[] $models
 * @var \App\Services\TranslatorService $t
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.question.plural'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('site.question.plural')}}</h1>
                <a href="{{route('questions.create')}}" class="btn btn-primary">{{__('site.action.create')}}</a>
                <table class="table table-hover">
                    <thead>
                    <tr>
                    <th>{{__('site.question.field.id')}}</th>
                        <th>{{__('site.question.field.image')}}</th>
                        <th>{{__('site.question.field.title')}}</th>
                        <th>{{__('site.question.field.start_at')}}</th>
                        <th>{{__('site.question.field.end_at')}}</th>
                        <th>{{__('site.question.field.active')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($models as $question)
                        <tr>
                            <td>{{$question->id}}</td>
                            <td>
                                @if ($question->image)
                                    <img alt="image" style="width: 100px" class="img-thumbnail" src="{{\Illuminate\Support\Facades\Storage::disk('images')->url($question->image->filename)}}">
                                @endif
                                </td>
                            <td>{{$t->translate($question->title, app()->getLocale())}}</td>
                            <td>{{$question->start_at->format('d.m.Y H:i')}}</td>
                            <td>{{$question->end_at->format('d.m.Y H:i')}}</td>
                            <td>{{$question->active ? __('site.question.field.active'):  __('site.question.field.not_active')}}</td>
                            <td>
                                <a href="{{route('questions.edit', [$question])}}" class="btn btn-primary">{{__('site.action.edit')}}</a>
                                <a href="#" class="btn btn-primary">{{__('site.action.delete')}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </table>
        </div>
@endsection


@push('scripts')

@endpush

@push('styles')

@endpush
