@extends('layouts.default')

@section('content')
	<p><label>Name: </label>{{ $user->name }}</p>
	<p><label>Twitter Handle: </label>{{ $user->twitter_handle }}</p>
	<p><label>Image: </label><img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="..."></p>
	<p><label>Category: </label>{{ $user->type->title }}</p>
	<p><label>Ranked: </label>#{{ $user->getRankInType() }}</p>
	<p><label>Score: </label>{{ round($user->klout_metric_score) }}</p>
	<p><label>Score Day: </label>{{ round($user->klout_metric_score_day) }}</p>
	<p><label>Score Week: </label>{{ round($user->klout_metric_score_week) }}</p>
	<p><label>Score Month: </label>{{ round($user->klout_metric_score_month) }}</p>
	<p><label>Updated: </label>{{ $user->klout_updated }}</p>
@stop