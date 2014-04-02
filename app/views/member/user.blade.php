@extends('layouts.default')


@section('content')
	<div class='col-sm-4'>
		<p><label>Name: </label>{{ $user->name }}</p>
		<p><label>Twitter Handle: </label>{{ $user->twitter_handle }}</p>
		<p><label>Image: </label><img height=48 width=48 class="media-object" src="{{ $user->image }}" alt="..."></p>
		<p><label>Category: </label>{{ $user->type->title }}</p>
		<p><label>Ranked: </label>#{{ $user->getRankInType() }}</p>
		<p><label>Score: </label>{{ round($user->klout_metric_score) }}</p>
		<p><label>Score Day: </label>{{ round($user->klout_metric_score_day) }}</p>
		<p><label>Score Week: </label>{{ round($user->klout_metric_score_week) }}</p>
		<p><label>Score Month: </label>{{ round($user->klout_metric_score_month) }}</p>
		<p><label>Updated: </label>{{ $user->klout_updated }}</p>
	</div><!--/.col-sm-4-->	
	
	@if($tags_info)
	<div class='col-sm-4'>
		<ul class="list-group klout-list">
						<li class="list-group-item main">
							<h4 class="list-group-item-heading">Tags List</h4>
						</li>
						@foreach ($tags_info as $tag)
						<li class="list-group-item">
							<div class="media">
								<a class="pull-left" href="#">
									<img height=48 width=48 class="media-object" src="{{ $tag->image }}" alt="...">
								</a>
								<div class="media-body" style="display: inline;">
									<p><b>{{ $tag->title }}</b></p>
										<?php 
										$percent = 0;
										$count = 0;
										if (!empty($tags_count_array)){
										foreach ($tags_count_array as $count_key => $count_value){
											if($tags_count_total == 0){
												$percent = 0;?>
										<div><?php echo $count_value;?></div>
											<?php }else{
												if($count_key == $tag->id && $count_value != 0){
													$count = $count_value;
												  $percent = round((floatval($count_value / $tags_count_total))*100, 2);?>
										<div><?php echo $count_value;?></div>
												<?php }else{
												  $percent = 0;
												}
											}
										?>
										 
										<?php 
										$count = 0;
										}
										}else{?>
										<div><?php echo $count_value;?></div>	
										<?php }?>
								</div><!--/.media-body-->
								<div class="media-body" style='float:right;'>
									<a class="pull-left" href="/tag/update/<?php echo $user->twitter_handle ; ?>/<?php echo $user->id;?>/<?php  echo $tag->id;?>" alt='+ 1'>
										<span class="glyphicon glyphicon-chevron-up" ></span>
									</a>
								</div>
							</div><!--/.media-->
						</li><!--/.list-group-item-->
						@endforeach
						<li class="list-group-item">
							<div class="media row">
								{{ $tags_info->links() }}
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

