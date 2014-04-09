@extends('layouts.default')

@section('content')

		<div class="container">
			<div class='row top-lists'>

				<div class='col-sm-6'>
					<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">{{ $tag->title}}</h4>
						</li>
						@foreach ($users as $user)
						<li class="list-group-item">
							<div class="media row">
								<div class='col-sm-2'>
									<a class="pull-left" href="/user/{{ $user->twitter_handle }}">
										<img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="...">
									</a>
								</div>
								<div class='col-sm-4'>
									<p><b>
										<a href="/user/{{ $user->twitter_handle}}">
											{{ $user->name }}
										</a>
									</b></p>
									<p>{{ $user->ranking }}</p>
								</div>
								<div class='col-sm-2'>
									<p><b>Score:{{ round($user->klout_metric_score,2)}}</b></p>
								</div>
								<div class='col-sm-4'>

								</div>
							</div><!--/.media-->
						</li><!--/.list-group-item-->
						@endforeach
						
						<li class="list-group-item">
							<div class="media row">
							{{ $users->links() }}
							</div><!--/.media-->
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-3-->

		</div><!-- /.container -->

@stop
