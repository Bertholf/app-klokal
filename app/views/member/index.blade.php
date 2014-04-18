@extends('layouts.default')

@section('content')

		<!-- Carousel
		================================================== -->
		<div id="top-user-container">

			<div class='container top-users'>

			<div class='lead'>
				<h2>Hawaii's Top 10 Klout Scores</h2>
			</div><!--/.lead-->

				<ul class='users list-inline'>
				<?php $c = 1; ?>
				@foreach ($users as $user)
					<li>
						<div class='box'>
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="...">
								</a>
							<div class="media-body">
								<h3 class="media-heading">#{{ $c }}</h3>
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
					<?php $c++; ?>
				@endforeach
				</ul>
			</div><!--/.container-->
			<div class='container top-users'>
				<div class='lead'>
					<a href='/lists/influencers'>
						<h4 style='text-align: center;'>See All</h4>
					</a>
			</div><!--/.lead-->
			</div>
		</div><!-- /.carousel -->

		<!-- Wrap the rest of the page in another container to center all the content. -->

		<div class="container">

			<div class='well'> 
				<div class='row'>
					<div class='col-sm-6'>
						<div class='lead'>
						<h2>
						<a href='/lists'>
							Hawaii's Popular Lists 
						</a>
						<small style='margin-left:20px;'>Updated daily.</small>
						</h2>
						</div>
					</div><!--/.col-sm-4-->
					<div class='col-sm-6'>

					{{ Form::open(array('method' => 'POST', 'url' => '/lists/addList' ,'files' => true , 'id' => 'add_list_form' ,'class' => 'form','role' => 'form')) }}
						<div class="input-group input-group-sm merged pull-right ">
							<input type='text' name='title' class="form-control show_add_list" placeholder='Enter a List Title' style = 'margin-bottom: 27px; margin-left: 60px; visibility:hidden;' />
							<span class="input-group-btn show_add_list" style='padding-left: 50px; visibility:hidden;'>
								<input type ='submit' class="btn btn-default" value="Go"/>
							</span>
						<a id='show_add_content' class='btn btn-lg btn-primary pull-right' style='margin-top:13px;'>
							<i class='icon-pencil'> </i> 
							<span class='icon-pencil-text'>
								Create your own list
							</span>
						</a>
						</div>
					{{ Form::close() }}

					</div><!--/.col-sm-6-->
				</div><!--/.row-->
			</div><!--/.well-->
					
			<div class='row top-lists'>

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
							<a class='btn btn-xlg btn-block' 
							href="
							<?php 
// 							if(intval($list->user_id)>0)
// 							{
// 								$user = User::where('id', '=', $list->user_id)->first();
// 								///user/{user.twitter_handle}/{list.slug}
// 								echo url("user/{$user->twitter_handle}/{$list->slug}");
// 							}else{
// 								echo url("lists/{$list->slug}");
// 							} 
							?>
								"
							>
								<i class='icon-zoom-in'> </i> View All {{ $list->title }}
							</a>
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-3-->

			@endforeach

			<div class='row'>
				<div class='col-md-8'>
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
											<img class="media-object" src="{{$uw_gain->image}}" alt="...">
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
											<img class="media-object" src="{{$uw_loss->image}}" alt="...">
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

				</div><!--/.col-md-8-->

				<div class='col-md-4'>
					<div class='page-header'>
						<h2>Widget</h2>
					</div><!--/.page-header-->
				</div><!--/.col-md-4-->
			</div><!--/.row-->

		</div><!-- /.container -->

@stop