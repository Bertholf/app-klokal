@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-compass text-contrast'></i> Users</h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class='active'><a href="#">Users</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-12'>

              <div class='row user-utility'>

                <div class='col-sm-6'>
                  <div class='lead'>
                    <?php echo count($userlist)?> total users

                  </div>
                </div>
                
                <div class='col-sm-6'>
                  <form class="form-inline" id='user-filter' role="form">
                    <div class='col-sm-4' style='padding-right:0px !important; padding-left:0px !important;'>
                      <label class="sr-only" for="name">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name">
                    </div><!--/.col-sm-3-->
                    <div class='col-sm-3' style='padding-right:0px !important; padding-left:0px !important;'>
                      <label class="sr-only" for="location">Location</label>
                      <select class='form-control'>
                        <option value='' disabled selected style='display:none;'>Location</option>
                        <option value='0'>Charlotte</option>
                        <option value='1'>Hawaii</option>
                        <option value='2'>Tokyo</option>
                        <option value='3'>San Diego</option>
                      </select>
                    </div><!--/.col-sm-3-->
                    <div class='col-sm-3' style='padding-right:0px !important; padding-left:0px !important;'>
                     
                        <label class="sr-only" for="location">Type</label>
                        <select class='form-control'>
                          <option value='' disabled selected style='display:none;'>Type</option>
                          <option value='0'>Conversationalist</option>
                          <option value='1'>Fans</option>
                          <option value='2'>Brand</option>
                          <option value='3'>Politics & Government</option>
                        </select>
                    </div><!--/.col-sm-3-->
                    <div class='col-sm-2' style='padding-right:0px !important; padding-left:0px !important;'>
                      <button type="submit" class="btn btn-primary btn-block">Filter</button>
                    </div><!--/.col-sm-3-->

                  </form>
                </div><!--/.col-sm-6-->
              </div><!--/.row user-utility-->

              <div class='row user-sorting'>
                <div class='col-sm-3'>
                  <div class='input-group'>
                    <select class='form-control bulk-actions'>
                      <option value='' disabled selected style='display:none;'>Select Action</option>
                      <option value='0'>Change Location</option>
                      <option value='1'>Change Influencer Type</option>
                      <option value='2'>Rescan</option>
                      <option value='3'>Remove User</option>
                    </select>
                    <span class='input-group-btn'>
                      <button type='submit' class='btn btn-danger'>Do it</button>
                    </span>
                  </div><!--/.input-group-->
                </div><!--/.col-sm-3-->

                <div class='col-sm-6 col-sm-offset-3'>
                   <ul>
						<li class="list-group-item">
							<div class="media row">
								{{ $userlist->links() }}
							</div><!--/.media-->
						</li><!--/.list-group-item-->
					</ul>
                </div><!--/.col-sm-6-->
              </div><!--/.row user-sorting-->


              <div class='box'>
                <div class='box-content box-no-padding'>
                  <table class="data-table admin table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Twitter Handle</th>
                        <th>KloutScore</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Date Identified</th>
                        <th>Last Scanned</th>
                      </tr>
                    </thead>
                    <tbody>
						@foreach($userlist as $user_key=>$user_value)
                      <tr>
                        <td data-title='Select'><input type="checkbox" id="blahA" value="1"/></td></td>
                        <td data-title='ID'>{{$user_value->id}}</td>
                        <td data-title='Image'><img src="{{$user_value->image}}"></img></td>
                        <td data-title='Name'>{{$user_value->name}}</td>
                        <td data-title='Twitter Handle'><a href='http://twiter.com/{{$user_value->twitter_handle}}'>{{$user_value->twitter_handle}}</a></td>
                        <td data-title='KloutScore'>{{$user_value->klout_metric_score}}</td>
                        
                        <td data-title='Location'>{{$user_value->location}}</td>
                        <td data-title='Type'>Conversationalist</td>
                        <td data-title='Date Identified'>5 Years Ago</td>
                        <td data-title='Last Scanned'>6 Months Ago</td>
                      </tr>
         				@endforeach
                    </tbody>

   
                  </table>
                </div><!--/.box-content-->
              </div><!--/.box-->
            </div><!--/.col-mid-8-->
          </div><!--/.row-->

        </div><!--/.col-xs-12-->
      </div><!--/#content-wrapper-->
    </div><!--/.container-->
   @stop