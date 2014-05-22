@extends('layouts.default')

@section('content')

<div id="top-user-container">
	<div class='container top-users'>
		<div class='lead'>
			<h2>
				{{-- TODO: Move to Controller --}}
				<?php if(Session::get('current_location')){
		              $location = Location::where('LocationID', '=', Session::get('current_location'))->first();
		              if(count($location) == 1){
		             	 echo $location->LocationTitle;
		              }else{
		             	 echo 'Location';
		              }
		              }else{
		             	 echo "Location";
					  }
			   ?> Top 10 Klout Scores</h2>
		</div><!--/.lead-->

		<ul class='users list-inline'>
		<?php $c = 1; ?>
		@foreach ($users as $user)
			@include('layouts.partials.kloutbox')
			<?php $c++; ?>
		@endforeach
		</ul>
	</div><!--/.container-->
	<div class='container top-users'>
		<div class='lead'>
			<a href='/lists/influencers'><h4 class='text-center'>See All</h4></a>
		</div><!--/.lead-->
	</div><!--/.top-users-->
</div><!-- /.carousel -->

<div class="container">

	<div class='well'>
		<div class='row'>
			<div class='col-sm-6'>
				<div class='lead'>
					<h2><a href='/lists'>{{$currentlocation}}  Popular Lists</a> <small style='margin-left:20px;'>Updated daily.</small></h2>
				</div><!--/.lead-->
			</div><!--/.col-sm-8-->
			<div class='col-sm-6'>

				<a href='#!' data-toggle='modal' data-target='#create-list-modal' class='btn btn-lg btn-primary pull-right' style='margin-top:13px;'>
					<i class='icon-pencil'> </i> Create your own list
				</a>
			</div><!--/.col-sm-6-->


		</div><!--/.row-->
	</div><!--/.well-->

	<div class='row top-lists'>
		<div class='col-xs-12'>
			<ul id='home-popular-lists'>
			@foreach ($lists as $list)
				<li>
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
							$topusers = $list->users()->orderBy('klout_metric_score', 'desc')
									->where('location_id', '=', $current_location)
									->take(3)->get();
							$c = 1;
						?>
						@foreach ($topusers as $user)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object img-circle" src="{{ $user->image }}" alt="...">
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
							<a class='btn btn-xlg btn-block'
							href="
							<?php
							if(intval($list->user_id)>0)
							{
								$user = User::where('id', '=', $list->user_id)->first();
								///user/{user.twitter_handle}/{list.slug}
								echo url("user/{$user->twitter_handle}/{$list->slug}");
							}else{
								echo url("lists/{$list->slug}");
							}
							?>
								"
							>
								<i class='icon-zoom-in'> </i> View All {{ $list->title }}
							</a>
						</li><!--/.list-group-item-->
					</ul>
				</li>
			@endforeach
			</ul>
		</div><!--/.col-xs-12-->
	</div><!--/.top-lists-->
	<div class='row'>
		<div class='col-md-12'>
			<div class='page-header'>
				<h2>This Week's Movers and Shakers <small style='margin-left:20px;'>Who's Klout changed?</small></h2>
			</div><!--/.page-header-->

			<div class='row'>
				<div class='col-md-6'>
					<div class='lead'>
						Moved Up
					</div><!--/.lead-->
					@foreach($users_week_gain as $uw_gain)
					<ul class="list-group stats-list">
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="/user/{{$uw_gain->twitter_handle}}">
									<img class="media-object img-circle" src="{{$uw_gain->image}}" alt="...">
								</a>
								<div class="media-body">
									<h3 class="media-heading">
										<span class='user-name'>
											<a class="pull-left" href="/user/{{$uw_gain->twitter_handle}}">
												{{$uw_gain->name}}
											</a>
										</span>
										<span class='stat text-success'>+{{round($uw_gain->klout_metric_score_week, 2)}}</span>
									</h3>

								</div><!--/.media-body-->
							</div><!--/.media-->
						</li><!--/.list-group-item-->
					</ul>
					@endforeach

				</div><!--/.col-md-6-->

				<div class='col-md-6'>
					<div class='lead'>
						Moved Down
					</div><!--/.lead-->
					@foreach($users_week_loss as $uw_loss)
					<ul class="list-group stats-list">
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="/user/{{$uw_loss->twitter_handle}}"">
									<img class="media-object img-circle" src="{{$uw_loss->image}}" alt="...">
								</a>
								<div class="media-body">
									<h3 class="media-heading">
										<span class='user-name'>
											<a class="pull-left" href="/user/{{$uw_loss->twitter_handle}}">
												{{$uw_loss->name}}
											</a>
										</span>
										<span class='stat text-success'>{{round($uw_loss->klout_metric_score_week, 2)}}</span>
									</h3>

								</div><!--/.media-body-->
							</div><!--/.media-->
						</li><!--/.list-group-item-->
					</ul>
					@endforeach
				</div><!--/.col-md-6-->
			</div><!--/.row-->

		</div><!--/.col-md-12-->

	</div><!--/.row-->
</div><!-- /.container -->


<!-- Modal -->
<div class="modal fade" id="create-list-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        	<h4 class="modal-title" id="myModalLabel">Create a List</h4>
	      	</div>
	      	<div class="modal-body">

	      	{{ Form::open(array('method' => 'POST', 'url' => '/lists/addList' ,'files' => true , 'id' => 'add_list_form' ,'class' => 'form','role' => 'form')) }}
				<div class='form-group'>
					<input type='text' name='title' class="form-control" placeholder='Enter a List Title'>
	      		</div><!--/.form-group-->
	      	</div><!--/.modal-body-->
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button type="submit" value='Go' class="btn btn-primary">Create List</button>
	      	</div><!--/.modal-footer-->
	      	{{ Form::close() }}
	    </div>
	</div>
</div>

@stop