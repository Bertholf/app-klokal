
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

								@if (Request::is('dashboard'))
									{{-- Show change location on dashboard for now ???--}}

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
							               <span class="input-group-btn">
							                     <button type="submit" class="btn btn-primary">Change</button>
							               </span><!--/.input-btn-->
							            </div><!--/.input-group-->
									</form>
								@endif

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