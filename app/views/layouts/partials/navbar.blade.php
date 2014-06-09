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

					@if (Request::is('dashboard'))
						{{-- Show change location on dashboard for now ???--}}
						<div id='change-location'>
							<a class='btn btn-default' id='toggle-location'><i class='icon-compass'> </i> Change Location</a>
							<div class='collapse fade' id='location-filter'>
								<a class='btn' id='close-location'><i class="icon-remove"> </i></a>
								<form class="form" id='user-filter' role="form" method='post' action='/change/location'>
									<label class="sr-only" for="location">Location</label>
									<div class='input-group'>
									    <select class='form-control' name='current_location' id='select-location'>
								            <option value='' disabled selected style='display:none;'>
										        <?php if(Session::get('current_location')){
										              $location = Location::where('LocationID', '=', Session::get('current_location'))->first();
										              if(count($location) == 1){
										             	 echo $location->LocationTitle;
										              }else{
										             	 echo 'Location';
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
					                    <span class='input-group-btn'>
					                		<button type="submit" id='submit-location' class="btn btn-primary">Change</button>
										</span>
									</div><!--/.input-group-->
								</form>
							</div><!--/.collapse fade-->
						</div><!--/.change-location-->
					@endif


						<div id='logged-in'>
			                <div id='user-action'>
			                	@if (Auth::check())
								<span>Hi, </span>
								<a href="/user/{{Auth::user()->twitter_handle}}">{{ Auth::user()->name }}</a>
								<a href="/logout" class='btn shift-right' id='logout-btn'><i class='icon-off'> </i></a>

								@else
									<a href="/sign_in_with_twitter" class='btn btn-sm btn-primary'><i class='icon-twitter'> </i> Login</a>
								@endif
							</div><!--/#user-action-->
						</div><!--/#loggedin-->
					@endif
				</div><!--/.navbar-right-->
			</div><!--/.col-sm-12-->
		</div><!--/.row-->
	</div><!--/.container-->
</div><!--/.navbar-->