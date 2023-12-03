<?php
/**
 * @var \App\Models\Question[] $models
 */
?>
@extends('layouts.myapp')

@section('page_title', 'Questions')

@section('content')
<div class="container">
  <div class="row ">
    @foreach($models as $question)
    <div class="card m-4" style="width: 18rem;">
      @if ($question->image)
      <img alt="image" class="card-img-top"
        src="{{\Illuminate\Support\Facades\Storage::disk('images')->url($question->image->filename)}}">
      @endif
      <div class="card-body">
        <h5 class="card-title">{{$t->translate($question->title, app()->getLocale())}}</h5>
        <p class="card-text">{{$t->translate($question->description, app()->getLocale())}}</p>
        <p class="card-text">{{$question->start_at->format('d.m.Y H:i')}}</p>
        <p class="card-text">{{$question->end_at->format('d.m.Y H:i')}}</p>
        <p class="card-text">{{$t->translate($question->active ? 'Active': 'Not active', app()->getLocale())}}</p>
        @auth
        @if($question->active)
        @if(!$votes->where('user_id', auth()->user()->id)->where('question_id', $question->id)->isNotEmpty())
        <a href="{{ route('vote.index', ['question' => $question->id]) }}" class="btn btn-primary">{{__('site.action.vote')}}</a>
        @endif
        @endif

        @endauth
        <a href="{{ route('vote.res', ['questionId' => $question->id]) }}" class="btn btn-primary">{{__('site.action.result')}}</a>
      </div>
    </div>
   
    
    @endforeach
  </div>
</div>
@endsection


@push('scripts')

@endpush

@push('styles')

@endpush