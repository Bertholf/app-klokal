@extends('layouts.default')

@section('content')
<div class='container'>
	<div class='row'>
		<div class='col-xs-12' id='content-wrapper'>
			<div class='row'>
				<div class="col-sm-4 col-md-4">
					<div class='well'>
						<div class='user-details clearfix'>
							<div class="user-image">
								<img src='{{ $user->image }}' alt='{{ $user->name }}' class='img-responsive img-circle'>
							</div><!--/.user-image-->
							<div class="user-info-block">
				                <div class="user-heading">
				                    <h3>{{ $user->name }}</h3>
				                    <span class="help-block">@ {{ $user->twitter_handle }}</span>
				                </div><!--/.user-heading-->
				                <div class="user-body">
		                            <p><label>Ranked: </label>#{{ $user->getRankInType() }}</p>
									<p><label>Score: </label>{{ round($user->klout_metric_score) }}</p>
									<p><label>Score Day: </label>{{ round($user->klout_metric_score_day) }}</p>
									<p><label>Score Week: </label>{{ round($user->klout_metric_score_week) }}</p>
									<p><label>Score Month: </label>{{ round($user->klout_metric_score_month) }}</p>
									<p><label>Updated: </label>{{ $user->klout_updated }}</p>
				                </div><!--/user-body-->
				            </div><!--/.user-info-block-->
				        </div><!--/.user-details-->
				    </div><!--/.well-->

		        </div><!--/.col-md-4-->
				@if($tags_info)
				<div class='col-sm-4'>
					<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">Tags List</h4>
						</li>
						@foreach ($tags_info as $tag_key => $tag_value)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="/tag/{{$tag_value->slug}}">
									<img height=48 width=48 class="media-object" src="{{ $tag_value->image }}" alt="...">
								</a>
								<div class="media-body">
									<p>
										<b>
											<a class="pull-left" href="/tag/{{$tag_value->slug}}">
												{{ $tag_value->title }}
											</a>
										</b>
									</p>

								</div><!--/.media-body-->
								<div class="media-body" style="display: inline;">
									@foreach ($tags_actor_id[$tag_key] as $id)
										@if($id != 0)
										<?php
											$actor = User::where('id' ,'=', $id)->first();
											if($actor){
												$image = $actor->image;
												$twitter_handle = $actor->twitter_handle;
											}else{
												$image = '';
												$twitter_handle = '';
											}
										?>
									<a class="pull-left" href="/user/<?php echo $twitter_handle;?>">
										<img height=48 width=48 class="media-object" src="
										<?php
											echo $image;
										?>
										" alt="...">
									</a>
										@endif
									@endforeach
								</div><!--/.media-body-->
								<div class="media-body" style='float:right;'>
									<a class="pull-left" href="/tag/update/<?php echo $user->twitter_handle ; ?>/<?php echo $user->id;?>/<?php  echo $tag_value->id;?>" alt='+ 1'>
										<span class="glyphicon glyphicon-chevron-up" ></span>
									</a>
								</div>
							</div><!--/.media-->
						</li><!--/.list-group-item-->
						@endforeach
						<li class="list-group-item">
							<div class="media row">

							</div><!--/.media-->
						</li><!--/.list-group-item-->
					</ul>
				</div><!--/.col-sm-4-->
				@endif
				@if(Session::get('id') !== NULL)
				<div class='col-sm-4'>
					<div class='row'>
						<div class='col-xs-12'>
							<h4>Assign an Existing Tag</h4>
							{{ Form::open(array('method' => 'GET', 'url' => '/tag/update/{twitter_handle}/{user_id}/{tag_id}' ,'files' => true , 'id' => 'update_tag')) }}
								<div class='input-group' id='tag_list'>
									<input class="typeahead form-control" autocomplete="off" id='tag_selected' type="text" placeholder="Select a Tag" value='' name="tags">
									<div class='input-group-btn'>
									  	<input type="submit" class="btn btn-default" id="select_tag" value='Assign'/>
									</div><!--/.input-group-btn-->
								</div><!--/.input-group-->
								  	<input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
								    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
							{{ Form::close() }}
						</div><!--/.col-xs-12-->
					</div><!--/.row-->
					<div class='row'>
						<div class='col-xs-12'>
							<h4>Add a New Tag</h4>
							<div id='add_new_tag_div'>
								{{ Form::open(array('method' => 'POST', 'url' => '/tag/add' ,'files' => true ,'id' => 'add_new_tag_form')) }}
								    <input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
								    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
									<div class='input-group'>
										    <input type="text" class="form-control" id="newTag" name ='tag' placeholder="Enter a New Tag"/>
									    <div class='input-group-btn'>
										  	<input type="submit" class="btn btn-default" value='Add a New Tag'/>
										</div><!--/.input-group-btn-->
									</div><!--/.input-group-->
								{{ Form::close() }}
							</div><!--/#add_new_tag_div-->
						</div><!--/.col-sm-12-->
					</div><!--/.row-->
				</div><!--/.col-sm-4-->
				@endif
			</div><!--/.row-->
			<div class='row'>
				<div class='col-sm-6'>
					<ul class="list-group klout-list">
						<li class="list-group-item main"><h5 class="list-group-item-heading"> List created</h5></li>
						@foreach($list_actor as $list)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="
								<?php
								if(intval($list->user_id)>0)
								{
									$luser = User::where('id', '=', $list->user_id)->first();
									///user/{user.twitter_handle}/{list.slug}
									echo url("user/{$luser->twitter_handle}/{$list->slug}");
								}else{
									echo url("lists/{$list->slug}");
								}
								?>
								">
									<img height=48 width=48 class="media-object" src="{{ $list->image }}" alt="...">
								</a>
								<div class="media-body" style="display: inline;">
									<a class="pull-left" style='color: #000000;
	   							text-decoration: none;' href="
								<?php
								if(intval($list->user_id)>0)
								{
									$luser = User::where('id', '=', $list->user_id)->first();
									///user/{user.twitter_handle}/{list.slug}
									echo url("user/{$luser->twitter_handle}/{$list->slug}");
								}else{
									echo url("lists/{$list->slug}");
								}
								?>
								">
									<p><b>{{ $list->title }}</b></p>
								</a>
								</div><!--/.media-body-->
							</div>
						</li>
						@endforeach
					</ul>
				</div><!--/.col-sm-6-->
				<div class='col-sm-6'>
					<ul class="list-group klout-list">
						<li class="list-group-item main"><h5 class="list-group-item-heading"> List apart of</h5></li>
						@foreach($listedby as $listedby_value)
							@foreach($listedby_value as $item)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="
								<?php
								if(intval($item->actor_id)>0)
								{
									$liuser = User::where('id', '=', $item->actor_id)->first();
									echo url("user/{$liuser->twitter_handle}/{$item->slug}");
								}else{
									echo url("lists/{$item->slug}");
								}
								?>
								">
								<img height=48 width=48 class="media-object" src="{{ $item->image }}" alt="...">
								</a>
								<div class="media-body">
								<a class="pull-left" style='color: #000000;
	   							text-decoration: none;' href="
								<?php
								if(intval($item->actor_id)>0)
								{
									$liuser = User::where('id', '=', $item->actor_id)->first();
									///user/{user.twitter_handle}/{list.slug}
									echo url("user/{$liuser->twitter_handle}/{$item->slug}");
								}else{
									echo url("lists/{$item->slug}");
								}
								?>
								">
								<p><b>{{ $item->title }}</b></p>
								</a>
								</div><!--/.media-body-->
								<h3 class="media-heading">#{{ $item->rank }}</h3>
							</div>
						</li>
							@endforeach
						@endforeach
					</ul>
				</div><!--/.col-sm-6-->
			</div><!--/.row-->
		</div><!--/.#content-wrapper-->
	</div><!--/.row-->
</div><!--/.container-->
@stop

