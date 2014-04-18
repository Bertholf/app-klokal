@extends('layouts.default')

@section('content')

		<!-- Carousel
		================================================== -->
		<div id="myCarousel" class="carousel slide">
			<!-- Indicators -->

			<div class="carousel-inner">
				<div class="item active">
					<img src="/images/top-influencers.png" class='img-responsive' alt="Klokal Hawaii">
					<div class="container">
						<div class="carousel-caption">
							<h1>You are just one click away from seeing Hawaii's top influencers!</h1>

							<p><a class="btn btn-lg btn-success" href="/sign_in_with_twitter"><i class='icon-twitter'> </i> Sign in with Twitter</a></p>
						</div> <!--carousel-caption -->
					</div><!--/.container-->
				</div> <!--/.item-active-->
			</div><!--carousel-inner-->

		</div><!-- /.carousel -->



		<!-- Marketing messaging and featurettes
		================================================== -->
		<!-- Wrap the rest of the page in another container to center all the content. -->

		<div class="container marketing">

			<!-- START THE FEATURETTES -->

			<div class="row featurette">
				<div class="col-md-7">
					<h2 class="featurette-heading">Social Marketers: <span class="text-muted">Want in-depth data on Hawaii's top social users?</span></h2>
					<p class="lead">See exactly who can spread the word about your product or services.</p>
					<p><a class="btn btn-lg btn-success" href="/sign_in_with_twitter"><i class='icon-twitter'> </i> Sign in with Twitter</a></p>
				</div>
				<div class="col-md-4 col-md-offset-1 sponsors">

					<p class='text-center text-muted'>
						Sponsored by:
					</p>

					<div class='row'>
						<p><img class="featurette-image img-responsive" src="/images/surrounds-me.png" alt="SurroundsMe">
						</p>
					</div><!--/.row-->
					<div class='row'>
						<p><img class="featurette-image img-responsive" src="/images/saas-venture-group.png" alt="SaaS Ventures">
						</p>
					</div><!--/.row-->
				</div>
			</div>

		</div><!-- /.container -->

@stop