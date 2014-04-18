@extends('layouts.admin')
@section('content')
   <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-compass text-contrast'></i> Locations <small>Edit</small></h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class=''><a href="#">Locations</a></li> 
                    <li class=''><a href="#">Charlotte</a></li>
                    <li class='active'><a href="#">Edit</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-6'>
                <div class='well'>
                  <form role="form" class='validate-form'  method='post' action='/admin/location-modify-action' name='location'>
                  	<input type="hidden" class="form-control" id="id" name='id'  value="{{$location->LocationID}}">
                    <div class='row'>
                      <div class="form-group col-lg-12">
                        <label for="description">Title</label>
                        <input type="text" class="form-control" id="title" name='title'  value="{{$location->LocationTitle}}" required="required" placeholder="I.E. Boston Massachusets">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-lg-12">
                        <label for="description">Description</label>
                        <textarea class="form-control" id='description' name='description' rows="3">
                        {{$location->LocationText}}
                        </textarea>
                      </div>
                    </div><!--/.row-->
                    <div class='row'> 
                      <div class="form-group col-lg-12">
                        <label for="description">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name='latitude' value='{{$location->LocationLatitude}}' required="required" placeholder="30.267153">
                      </div>
                    </div><!--/.row-->
                    <div class='row'> 
                      <div class="form-group col-lg-12">
                        <label for="description">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name='longitude' value='{{$location->LocationLongitude}}' required="required" placeholder="-97.7430608">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-lg-12">
                        <label for="description">Radius</label>
                        <p class='help-block'>Make sure this is in Kilometers!</p>
                        <input type="text" class="form-control" id="Radius" name='radius' value='{{$location->LocationRadius}}' required="required" placeholder="20 KM">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-lg-12">
                        <hr class='normal'>
                        <label for="exampleInputFile">Image</label>
                        <div class='row'>
                          <div class='col-lg-12'>
                            <img src="{{$location->LocationImage}}"></img>
                          </div><!-- col-lg-12-->
                        </div><!--/.row-->

                        <div class='row'>
                          <div class='col-lg-12'>
                            <p class="help-block shift-down">Upload an image to represent this location</p>
                          </div><!--/.col-lg-12-->
                        </div><!--/.row-->
                          
                          <div class='row'> 
                            <div class='col-lg-6'>
                              <a class='btn btn-default'><i class='icon-remove'> </i> Remove Existing Image</a>
                            </div><!--/col-lg-3-->
                          </div><!--/.row-->

                          <div class='row shift-down'>
                            <div class='col-lg-6'>
                              <input type="file" id="icon-upload" class='btn-primary' name='image' title='Upload a New Image'> 
                            </div> <!--/col-lg-3-->
                          </div><!--/.row-->
                        
                        <hr class='normal'>
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class='form-group col-sm-8'>
                        <label for="Status">Status</label>
                        <p class='help-block'>Do you want this to be visilbe in the system?</p>
                        <select class="form-control" id='status' name='status'>
                          <option value='1'
                          <?php if($location->LocationActive == 1){ $active = 'selected'; echo  $active;} ?>
                          >Yes, Active</option>
                          <option value='0'
                          <?php if($location->LocationActive == 0){ $inactive = 'selected'; echo  $inactive; }?>
                          >No, Inactive</option>
                        </select>
                        <hr class='normal'>
                      </div><!--/.form-group-->
                    </div><!--/.row-->
                    <div class='row'>
                      <div class='form-group col-lg-6'>
                        <label for="Status">Scan Mode</label>
                        <select class="form-control" id='scan-mode' name='scan-mode'>
                          <option value='1'
                          <?php if($location->LocationScan == 1){ $scan = 'selected'; echo  $scan; }?>
                          >Yes, Scan New</option>
                          <option value='0'
                          <?php if($location->LocationScan == 0){ $inscan = 'selected'; echo  $inscan; }?>
                          >No, Just Update</option>
                        </select>
                        <hr class='normal'>
                      </div><!--/.form-group-->
                    </div><!--/.row-->

                    <div class='row'>
                      <div class='col-lg-12'>
                        <button class="btn btn-lg btn-default" type='reset'><i class='icon-arrow-left'> </i> Go Back</button>
                        <button class="btn btn-lg btn-default" data-toggle='modal' href='/admin/location-delete/{{$location->LocationID}}'><i class='icon-trash'> </i> Delete</button>
                        <button type="submit" class="btn btn-lg btn-success"><i class='icon-save'> </i> Save Changes</button>
                      </div><!--/.col-lg-12-->
                    </div><!--/.row-->
                  </form>
                </div><!--/.well-->
            </div><!--/.col-mid-8-->
            <div class='col-md-6'>
              <div class='row'>
                <div class='col-lg-12'>
                  <div class='google-map-canvas'>
                    <div id='map_canvas'></div><!--/#map_canvas-->
                  </div><!--/.google-map-canvas-->
                </div><!--/.col-lg-12-->
              </div><!--/.row-->

            </div><!--/.col-md-6-->
          </div><!--/.row-->
        </div><!--/.col-xs-12-->
      </div><!--/#content-wrapper-->
    </div><!--/.container-->
@stop