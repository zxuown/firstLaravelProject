<?php
/**
 * @var \App\Models\Question[] $models
 */
?>
@extends('layouts.myapp')

@section('page_title', __('site.vote.plural'))

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Results</h1>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{__('site.vote.field.id')}}</th>
                        <th>{{__('site.vote.field.user_id')}}</th>
                        <th>{{__('site.vote.field.question_id')}}</th>
                        <th>{{__('site.vote.field.option_id')}}</th>
                        <th>{{__('site.vote.field.vote_at')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model as $vote)
                        <tr>
                            <td>{{$vote->id}}</td>
                            <td>{{$vote->user_id}}</td>
                            <td>{{$vote->question_id}}</td>
                            <td>{{$vote->option_id}}</td>
                            <td>{{$vote->vote_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @foreach($options as $option)
                    <div class="mb-3">
                        <p>{{ $option->title }}</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $option->vote_percentage }}%"
                                 aria-valuenow="{{ $option->vote_percentage }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $option->vote_percentage }}%
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- <a href="{{ route('vote.index', ['question' => $question->id]) }}"  class="btn btn-primary">Question</a> -->
            </div>
        </div>
    </div>
@endsection


@push('scripts')

@endpush

@push('styles')

@endpush
