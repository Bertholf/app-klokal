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
							<a class="pull-left" href="/lists/{<?php echo $list->slug;?>}">
								<img height=48 width=48 class="media-object" src="{{ $list->image }}" alt="...">
							</a>
							<div class="media-body" style="display: inline;">
										<p><b>{{ $list->title }}</b></p>
							</div><!--/.media-body-->
							<div class="media-body" style="display: inline;">
										<p><b>{{ $list->text }}</b></p>
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
					<li class="list-group-item">
					{{ Form::open(array('method' => 'POST', 'url' => '/lists/addListForUser' , 'id' => 'add_list_form')) }}
						<div class='col-sm-8'>
							<div id="add_list_to_user">
								<input class="typeahead form-control" autocomplete="off" id='list_selected_title' type="text" placeholder="Select a List" value='' name="list_title">
								<input id='list_selected_id' type="hidden" value="" name="list_id">
								<input id='user_id' type="hidden" value="{{ $user->id }}" name="user_id">
								<input id='user_listedby' type="hidden" value="{{Session::get('id')}}" name="user_listedby">
								<input id="twitterHandle" type="hidden" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
							</div>
						</div>
						  <input type="submit" class="btn btn-default" id="select_tag" value='Asign'/>
					{{ Form::close() }}
					</li>
					@foreach($listedby as $item)
					<li class="list-group-item">
						<div class="media">
							<a class="pull-left" href="/lists/{<?php echo $item->slug;?>}">
								<img height=48 width=48 class="media-object" src="{{ $item->image }}" alt="...">
							</a>
							<div class="media-body" style="display: inline;">
										<p><b>{{ $item->title }}</b></p>
							</div><!--/.media-body-->
							<div class="media-body" style="display: inline;">
										<p><b>{{ $item->text }}</b></p>
							</div><!--/.media-body-->
						</div>
					</li>
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
											$user = User::where('id' ,'=', $id)->first();
// 											dd($user->image);
											if($user){
												$image = $user->image;
												$twitter_handle = $user->twitter_handle;
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
	
	<div class='col-sm-4'>	
		{{ Form::open(array('method' => 'GET', 'url' => '/tag/update/{twitter_handle}/{user_id}/{tag_id}' ,'files' => true , 'id' => 'update_tag')) }}
	<div class='col-sm-6'>
		<div id="tag_list">
			<input class="typeahead form-control" autocomplete="off" id='tag_selected' type="text" placeholder="Select a Tag" value='' name="tags">
		</div>
	    <input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
	    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
	</div>
	  <input type="submit" class="btn btn-default" id="select_tag" value='Asign'/>
		{{ Form::close() }}
	<br/>
	<br/>
	<br/>
			
	{{ Form::open(array('method' => 'POST', 'url' => '/tag/add' ,'files' => true)) }}
	<div class='col-sm-6'>
	    <input type="text" class="form-control" id="newTag" name ='tag' placeholder="Enter a New Tag"/>
	    <input type="hidden" class="form-control" id="userId" name ='userId' value="{{ $user->id }}"/>
	    <input type="hidden" class="form-control" id="twitterHandle" name ='twitterHandle' value="{{ $user->twitter_handle }}"/>
	    <br>
	    <input type="text" class="form-control" id="newImage" name ='newImage' placeholder="Enter a image url"/>
	    <?php 
// 	    echo Form::file('tagImage'); 
	    ?>
	</div>
	  <input type="submit" class="btn btn-default" value='Add a New Tag'/>
	{{ Form::close() }}


	</div><!--/.col-sm-4-->	
@stop

