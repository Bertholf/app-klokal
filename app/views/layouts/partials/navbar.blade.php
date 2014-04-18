
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
						<form class="form-inline" id='user-filter' role="form" method='post' action='/change/location'>
						<div class='col-sm-4' style='padding-right:0px !important; padding-left:0px !important; width: 160px;'>
		                      <label class="sr-only" for="location">Location</label>
		                      <select class='form-control' name='current_location'>
		                        <option value='' disabled selected style='display:none;'>
		                        <?php if(Session::get('current_location')){
		                        	$location = Location::where('LocationID', '=', Session::get('current_location'))->first();
		                        	if(count($location) == 1){
		                        	 	echo $location->LocationTitle;
		                        	}else{
		                        		echo 'Location2';
		                        	}
		                        	}else{
		                        		echo "Location";
									}
		                       ?>
		                        </option>
		                         @foreach($location_list as $location_key => $location_value)
		                        <option value="{{$location_value->LocationID}}">{{$location_value->LocationTitle}}</option>
		                    	 @endforeach
		                      </select>
		               </div><!--/.col-sm-3-->
		               <div class='col-sm-1' style='padding-right:0px !important; padding-left:0px !important;'>
		                      <button type="submit" class="btn btn-primary btn-block">Change</button>
		               </div><!--/.col-sm-3-->
		               </form>
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