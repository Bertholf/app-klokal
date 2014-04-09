@extends('layouts.default')

@section('content')

<div id="top-user-container">

			<div class='container top-users'>
				<ul class='users list-inline'>
				@foreach ($users as $user)
					<li>
						<div class='box'>
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="...">
								</a>
							<div class="media-body">
								<h4><a href="<?php echo url("user/{$user->twitter_handle}"); ?>">{{ $user->name }}</a></h4>
								<div class="score">
									{{ round($user->klout_metric_score) }}
									<span class="callout"></span>
								</div><!--/.score-->
								<iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name={{ $user->twitter_handle }}&dnt=false&show_count=false" style="width:300px; height:20px;"></iframe>
							</div><!--/.media-body-->
						</div><!--/.media-->
						</div><!--/.box-->
					</li>
				@endforeach
				</ul>
			</div><!--/.container-->
			<div class='col-sm-11'>
			 <ul>
				<li class="list-group-item">
					<div class="media row">
						{{ $users->links() }}
					</div><!--/.media-->
				</li><!--/.list-group-item-->
			</ul>
			</div>
		</div><!-- /.carousel -->
@stop