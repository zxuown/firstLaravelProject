<?php
/**
 * @var \App\Models\Question $question
 * @var Option[] $options
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.options.plural'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{__('site.options.plural')}}</h1>
                <a href="{{route('options.create',[$question])}}" class="btn btn-primary">{{__('site.action.create')}}</a>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{__('site.options.field.id')}}</th>
                        <th>{{__('site.options.field.image')}}</th>
                        <th>{{__('site.options.field.title')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($models as $options)
                        <tr>
                            <td>{{$options->id}}</td>
                            <td>
                                @if ($options->image)
                                    <img alt="image" style="width: 100px" class="img-thumbnail" src="{{\Illuminate\Support\Facades\Storage::disk('images')->url($options->image->filename)}}">
                                @endif
                                </td>
                            <td>{{$options->title}}</td>
                            <td>
                                <a href="{{route('options.edit', [$options])}}" class="btn btn-primary">{{__('site.action.edit')}}</a>
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
