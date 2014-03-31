@extends('layouts.default')


@section('content')
	<div class='col-sm-4'>
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
	</div><!--/.col-sm-4-->	
	
	<div class='col-sm-4'>
		<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">Tags List</h4>
						</li>
						@foreach ($tags_info as $tag)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object" src="{{ $tag->image }}" alt="...">
								</a>
								<div class="media-body" style="display: inline;">
									<p><b>{{ $tag->title }}</b></p>
									<iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name={{ $user->twitter_handle }}&dnt=false&show_count=false" style="width:300px; height:20px;"></iframe>
								</div><!--/.media-body-->
								<div class="media-body" style='float:right;'>
									<a class="pull-left" href="/tag/update/<?php echo $user->twitter_handle ; ?>/<?php echo $user->id;?>/<?php  echo $tag->id;?>" alt='+ 1'>
										<span class="glyphicon glyphicon-chevron-up" ></span>
									</a>
								</div>
							</div><!--/.media-->
						</li><!--/.list-group-item-->
						@endforeach
						<li class="list-group-item">
							<div class="media row">
								{{ $tags_info->links() }}
							</div><!--/.media-->
						</li><!--/.list-group-item-->
		</ul>
	</div><!--/.col-sm-4-->
	
	<div class='col-sm-4'>			
	{{ Form::open(array('method' => 'POST', 'url' => '/tag/add' ,'files'=> true)) }}
	<div class='col-sm-6'>
	    <input type="text" class="form-control" id="newTag" name ='tag' placeholder="Enter a New Tag"/>
	    <input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
	    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
	    <?php echo Form::file('tagImage'); ?>
	</div>
	  <input type="submit" class="btn btn-default" value='Add Tag'/>
	{{ Form::close() }}
	</div><!--/.col-sm-4-->	
@stop

