@extends('layouts.default')

@section('content')

		<div class="container">
			<div class='row top-lists'>

				<div class='col-sm-6'>
					<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">Tags List</h4>
						</li>
						@foreach ($tags as $tag)
						<li class="list-group-item">
							<div class="media row">
								<div class='col-sm-2'>
									<a class="pull-left" href="#">
										<img height=48 width=48 class="media-object" src="{{ $tag->image }}" alt="...">
									</a>
								</div>
								<div class='col-sm-4'>
									<p><b>{{ $tag->title }}</b></p>
									<p>{{ $tag->count }}</p>
								</div>
								<div class='col-sm-2'>
									<a class="pull-left" href="<?php echo url("user/{$tag->topUser->twitter_handle}"); ?>">
										<img height=48 width=48 class="media-object" src="{{ $tag->topUser->image }}" alt="...">
									</a>
								</div>
								<div class='col-sm-4'>
									<div><a href="<?php echo url("user/{$tag->topUser->twitter_handle}"); ?>"><span class='user-name'>{{ $tag->topUser->name }}</span></a></div>
									<div>{{ $tag->topUser->userTags()->where('tag_id', '=', $tag->id)->count() }}</div>
								</div>
							</div><!--/.media-->
						</li><!--/.list-group-item-->
						@endforeach
						
						<li class="list-group-item">
							<div class="media row">
								{{ $tags->links() }}
							</div><!--/.media-->
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-3-->

		</div><!-- /.container -->

@stop
