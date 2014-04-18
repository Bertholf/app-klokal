@extends('layouts.default')

@section('content')
		@foreach ($lists as $list)
				<div class='col-sm-3'>
					<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">{{ $list->title }}</h4>
							<p class="list-group-item-text">{{ $list->text }}</p>
						</li>
						
						<?php 
						if (Session::get('current_location')){
							$current_location = Session::get('current_location');
						}else{
							$current_location = 1;
						}
							$c = 1; 
							$users = $list->users()->orderBy('klout_metric_score', 'desc')
									->where('location_id', '=', $current_location)
									->take(3)->get();
						?>
						@foreach ($users as $user)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="...">
								</a>
								<div class="media-body">
									<h3 class="media-heading">
										<div class="score">{{ round($user->klout_metric_score) }}</div><!--/.score-->
										<a href="<?php echo url("user/{$user->twitter_handle}"); ?>"><span class='user-name'>{{ $user->name }}</span></a>
									</h3> 
									<div class='rank'>#{{ $c }}</div><!--/.div-->
									<iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name={{ $user->twitter_handle }}&dnt=false&show_count=false" style="width:300px; height:20px;"></iframe>
								</div><!--/.media-body-->
							</div><!--/.media-->
						</li><!--/.list-group-item-->
						<?php $c++; ?>
						@endforeach
						
						<li class="list-group-item last">
							<a class='btn btn-xlg btn-block' href="<?php echo url("lists/{$list->slug}"); ?>"><i class='icon-zoom-in'> </i> View All {{ $list->title }}</a>
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-3-->
			@endforeach
			<div class='col-sm-11'>
			 <ul>
				<li class="list-group-item">
					<div class="media row">
						{{ $lists->links() }}
					</div><!--/.media-->
				</li><!--/.list-group-item-->
			</ul>
			</div>

@stop