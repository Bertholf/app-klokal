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
						
						<?php $c = $users->getFrom(); ?>
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
							{{ $users->links() }}
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-3-->
				@if(Session::get('id') !== NULL && Session::get('id') == $type->user_id)
				<div class='col-sm-3'>
				{{ Form::open(array('method' => 'POST', 'url' => '/lists/addListForUser' , 'id' => 'add_list_form')) }}
						<div class='col-sm-8'>
							<div id="select_list_to_user">
								<input class="typeahead form-control" autocomplete="off" id='user_name' type="text" placeholder="Select a User" value='' name="user_name">
								<input id='user_id' type="hidden" value='' name="user_id">
								<input id='list_selected_id' type="hidden" value="{{ $type->id }}" name="list_id">
								<input id='user_listedby' type="hidden" value="{{Session::get('id')}}" name="user_listedby">
							</div>
						</div>
						  <input type="submit" class="btn btn-default" id="select_list" value='Assign' disabled='disabled' />
				{{ Form::close() }}
				</div>
				@endif

		</div><!-- /.container -->

@stop