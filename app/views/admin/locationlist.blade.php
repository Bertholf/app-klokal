@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-compass text-contrast'></i> Locations</h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class='active'><a href="#">Locations</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-12'>
              <div class='box '>
                <div class='box-header'>
                  <div class='title'>
                   Current Locations
                  </div><!--/.title-->
                  <div class='actions'>
                    <a href='/admin/location-new' class='btn btn-primary btn-lrg'><i class='icon-plus-sign'> </i> Add a New Location</a>
                  </div>
                </div><!--/.box-header-->
                <div class='box-content box-no-padding'>
                  <table class="data-table admin table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Radius</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
						@foreach($locationlist as $location_key => $location_value)
                      <tr>
                        <td data-title='ID'>{{$location_value->LocationID}}</td>
                        <td data-title='Image'><img src="{{$location_value->LocationID}}"></img></td>
                        <td data-title='Title'>{{$location_value->LocationTitle}}</td>
                        <td data-title='Location'>Lat:{{$location_value->LocationLatitude}} , Lon:{{$location_value->LocationLongitude}}</td>
                        <td data-title='Radius'>{{$location_value->LocationRadius}}</td>
                        <td data-title='Status'>
                        @if($location_value->LocationActive == 1)
                        <span class='label label-success'>active</span>
                        @else
                        <span class='label label-default'>Inactive</span>
                        @endif
                        </td>
                        <td><a class='btn btn-default btn-sm' href='locations-edit.html'><i class='icon-cog'> </i> Edit</a>
                          <a class='btn btn-default btn-sm' data-toggle='modal' href="/admin/location-delete/{{$location_value->LocationID}}"><i class='icon-trash'> </i></a>
                        </td>
                      </tr>
						@endforeach
                    </tbody>

   
                  </table>
                </div><!--/.box-content-->
              </div><!--/.box-->
            </div><!--/.col-mid-8-->
          </div><!--/.row-->
		  <div class='media row'>
			  <div class='col-md-12'>
	              <ul style='padding-left: 0;'>
					<li class="list-group-item">
						<div class="media row">
							{{ $locationlist->links() }}
						</div><!--/.media-->
					</li><!--/.list-group-item-->
				  </ul>
			  </div>
          </div><!--/.media row-->
        </div><!--/.col-xs-12-->
      </div><!--/#content-wrapper-->
    </div><!--/.container-->
@stop