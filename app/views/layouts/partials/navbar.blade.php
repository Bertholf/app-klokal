
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
							<form class="form" id='user-filter' role="form" method='post' action='/change/location'>

			                    <label class="sr-only" for="location">Location</label>
			                    <div class='input-group'>
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
					               <span class="input-group-btn">
					                     <button type="submit" class="btn btn-primary">Change</button>
					               </span><!--/.input-btn-->
					            </div><!--/.input-group-->
			                </form>
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