@extends('layouts.default')

@section('content')
	<div class='col-sm-4'>
		<div class='row'>
			<p><label>Name: </label>{{ $user->name }}</p>
			<p><label>Twitter Handle: </label>{{ $user->twitter_handle }}</p>
			<p><label>Image: </label><img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="..."></p>
	
			<p><label>Ranked: </label>#{{ $user->getRankInType() }}</p>
			<p><label>Score: </label>{{ round($user->klout_metric_score) }}</p>
			<p><label>Score Day: </label>{{ round($user->klout_metric_score_day) }}</p>
			<p><label>Score Week: </label>{{ round($user->klout_metric_score_week) }}</p>
			<p><label>Score Month: </label>{{ round($user->klout_metric_score_month) }}</p>
			<p><label>Updated: </label>{{ $user->klout_updated }}</p>
		</div>
		<div class='row'>
			<div class='col-sm-6'>
				<ul class="list-group klout-list">
					<li class="list-group-item main">
							<h5 class="list-group-item-heading"> List created</h5>
					</li>
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
			</div>
			<div class='col-sm-6'>
				<ul class="list-group klout-list">
					<li class="list-group-item main">
							<h5 class="list-group-item-heading"> List apart of</h5>
					</li>
					@foreach($listedby as $listedby_value)
						@foreach($listedby_value as $item)
					<li class="list-group-item">
						<div class="media">
							<a class="pull-left" href="
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
			</div>
		</div>
	</div><!--/.col-sm-4-->	
	@if($tags_info)
	<div class='col-sm-4'>
		<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">Tags List</h4>
						</li>
						@foreach ($tags_info as $tag_key => $tag_value)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object" src="{{ $tag_value->image }}" alt="...">
								</a>
								<div class="media-body" style="display: inline;">
									<p><b>{{ $tag_value->title }}</b></p>
										
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
		{{ Form::open(array('method' => 'GET', 'url' => '/tag/update/{twitter_handle}/{user_id}/{tag_id}' ,'files' => true , 'id' => 'update_tag')) }}
	<div class='col-sm-6'>
		<div id="tag_list">
			<input class="typeahead form-control" autocomplete="off" id='tag_selected' type="text" placeholder="Select a Tag" value='' name="tags">
		</div>
	    <input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
	    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
	</div>
	  <input type="submit" class="btn btn-default" id="select_tag" value='Assign'/>
		{{ Form::close() }}
	<br/>
	<div class='col-sm-6'>
	<h4 class="list-group-item-heading">
		<a id='show_add_list_a' href="javascript:;">
			<p>Add a New Tag</p>
		</a>
	</h4>
	</div>
	<br/>
	<br/>
	<div id='add_new_tag_div' style='visibility:hidden;'>
		{{ Form::open(array('method' => 'POST', 'url' => '/tag/add' ,'files' => true ,'id' => 'add_new_tag_form')) }}
		    <input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
		    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
			<div class='col-sm-6'>
		    <input type="text" class="form-control" id="newTag" name ='tag' placeholder="Enter a New Tag"/>
		    </div>
		  	<input type="submit" class="btn btn-default" value='Add a New Tag'/>
		{{ Form::close() }}
	</div>	
	</div><!--/.col-sm-4-->	
	@endif
@stop

