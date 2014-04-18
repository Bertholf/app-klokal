
	<div class="navbar navbar-default">
		<div class="container">
			<div class='row'>
				<div class='col-sm-12'>
					<div class="navbar-header">
						<a class="navbar-brand" href="/"><img src='/images/logo.png'></a>
					</div><!--/.navbar-header-->

					@if (Request::is('/'))
					{{-- We only need to show powered by in header on index view --}}

						<div class="navbar-collapse collapse">
							<div class='navbar-right sponsor'>
								<img src='/images/Klout.png'>
							</div><!--/.navbar-right-->
						</div><!--/.nav-collapse -->

					@else

					{{-- Show login items on interior views --}}
					@if (Auth::check())
					<div class='navbar-right'>
						<div id='logged-in'>
			                <div id='user-action'>
								<span>Hi, </span>
								<a href="/user/{{Auth::user()->twitter_handle}}">{{ Auth::user()->name }}</a>
								<a href="/logout"><i class='icon-off'> </i></a>

								@else
									<a href="/sign_in_with_twitter">Login</a>
								@endif
							</div><!--/#user-action-->
						</div><!--/#loggedin-->
					</div><!--/.navbar-right-->


					@endif
				</div><!--/.col-sm-12-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.navbar-->