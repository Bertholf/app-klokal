<li>
	<div class='box'>
		<div class='user-heading'>
			<div class='user-image'>
				<img height=60 width=60 class="img-responsive img-circle" src="{{ $user->image }}" alt="{{ $user->name }}">
			</div><!--/.user-image-->
			<div class='rank'>#{{ $c }}</div><!--/.rank-->
			<div class="score">{{ round($user->klout_metric_score) }}</div><!--/.score-->
		</div><!--/.user-heading-->
		<div class='box-info'>
			<h4 id='username'><a href="<?php echo url("user/{$user->twitter_handle}"); ?>">{{ $user->name }}</a></h4>
			{{-- TODO: Change to Javascript Method to allow for styling of attributes--}}
			<iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name={{ $user->twitter_handle }}&dnt=false&show_count=false" style="width:100%; height:20px;"></iframe>
		</div><!--/.box-info-->
	</div><!--/.box-->
</li>