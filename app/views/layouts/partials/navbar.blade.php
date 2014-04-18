
	<div class="navbar navbar-default">
		<div class="container">
			<div class='row'>
				<div class='col-sm-12'>
					<div class="navbar-header">
						<a class="navbar-brand" href="/"><img src='/images/logo.png'></a>
					</div><!--/.navbar-header-->

					<div class='navbar-right'>
						@if (Request::is('/'))
						{{-- We only need to show powered by in header on index view --}}
							<img src='/images/Klout.png' class='img-responsive hidden-xs' id='sponsor-logo'>
						@else

						{{-- Show login items on interior views --}}
						@if (Auth::check())
							<div id='logged-in'>
				                <div id='user-action'>
									<span>Hi, </span>
									<a href="/user/{{Auth::user()->twitter_handle}}">{{ Auth::user()->name }}</a>
									<a href="/logout" class='btn shift-right' id='logout-btn'><i class='icon-off'> </i></a>

									@else
										<a href="/sign_in_with_twitter">Login</a>
									@endif
								</div><!--/#user-action-->
							</div><!--/#loggedin-->
						@endif
					</div><!--/.navbar-right-->
				</div><!--/.col-sm-12-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.navbar-->