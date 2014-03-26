@extends('layouts.default')

@section('content')

		<div class="container">
			<div class='row top-lists'>

				<div class='col-sm-3'>
					<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">{{ $type->title }}</h4>
							<p class="list-group-item-text">{{ $type->text }}</p>
						</li>
						
						<?php $c = 1; ?>
						@foreach ($type->users()->orderBy('klout_metric_score', 'desc')->take(50)->get() as $user)
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
							<a class='btn btn-xlg btn-block'><i class='icon-zoom-in'> </i> View All {{ $type->title }}</a>
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-3-->

		</div><!-- /.container -->

@stop