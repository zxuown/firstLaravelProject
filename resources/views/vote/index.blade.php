<?php
/**
 * @var \App\Models\Question $question
 * @var Option[] $options
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.vote.plural'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{__('site.vote.plural')}}</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__('site.vote.field.id')}}</th>
                        <th>{{__('site.vote.field.choose')}}</th>
                        <th>{{__('site.vote.field.image')}}</th>
                        <th>{{__('site.vote.field.title')}}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($models as $options)
                    <tr>
                        <td>{{$options->id}}</td>
                        <td>
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Vote for {{$options->title}}
                                </label>
                            </div> -->
                            <form method="POST"
                                action="{{ route('vote.store', ['question' => $question->id, 'options' => $options->id]) }}">
                                @csrf
                                <button type="submit">{{__('site.action.vote')}}</button>
                            </form>
                        </td>
                        <td>
                            @if ($options->image)
                            <img alt="image" style="width: 300px" class="img-thumbnail"
                                src="{{\Illuminate\Support\Facades\Storage::disk('images')->url($options->image->filename)}}">
                            @endif
                        </td>
                        <td>{{$t->translate($options->title, app()->getLocale())}}</td>
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