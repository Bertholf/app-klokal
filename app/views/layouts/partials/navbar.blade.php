
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
						<div style="text-align: right">
							<span>Hi, </span>
							<a href="/user/{{Auth::user()->twitter_handle}}">{{ Auth::user()->name }}</a>
							<span> | </span>
							<a href="/logout">Logout</a>
						</div>
						@else
						<div style="text-align: right">
							<a href="/sign_in_with_twitter">Login</a>
						</div>
						@endif

					@endif
				</div><!--/.col-sm-12-->
			</div><!--/.row-->
		</div><!--/.container-->
	</div><!--/.navbar-->