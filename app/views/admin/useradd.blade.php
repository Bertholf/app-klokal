@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-compass text-contrast'></i> Locations <small>Add New</small></h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class=''><a href="#">Locations</a></li>
                    <li class='active'><a href="#">Add New</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-6'>
                <div class='well'>
                  <form role="form" class='validate-form' method='post' action='/admin/users-new'>
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" required="required" placeholder="I.E. Boston Massachusets">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control" id='description' rows="3"></textarea>
                      </div>
                    </div><!--/.row-->
                    <div class='row'> 
                      <div class="form-group col-sm-12">
                        <label for="description">Latitude</label>
                        <input type="text" class="form-control" id="latitude" required="required" placeholder="30.267153">
                      </div>
                    </div><!--/.row-->
                    <div class='row'> 
                      <div class="form-group col-sm-12">
                        <label for="description">Longitude</label>
                        <input type="text" class="form-control" id="longitude" required="required" placeholder="-97.7430608">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="description">Radius</label>
                        <p class='help-block'>Make sure this is in Kilometers!</p>
                        <input type="text" class="form-control" id="Radius" required="required" placeholder="20 KM">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <hr class='normal'>
                        <label for="exampleInputFile">Image</label>
                        <p class="help-block">Upload an image to represent this location</p>
                        <input type="file" id="exampleInputFile" class='btn-primary' title='Upload an Image'>
                        
                        <hr class='normal'>
                      </div>
                    </div><!--/.row-->

                    <div class='row'>
                      <div class='form-group col-sm-8'>
                        <label for="Status">Status</label>
                        <p class='help-block'>Do you want this to be visilbe in the system?</p>
                        <select class="form-control" id='status'>
                          <option>Yes, Active</option>
                          <option>No, Inactive</option>
                        </select>
                        <hr class='normal'>
                      </div><!--/.form-group-->
                    </div><!--/.row-->


                    <div class='row'>
                      <div class='form-group col-sm-8'>
                        <label for="Status">Scan Mode</label>
                        <select class="form-control" id='scan-mode'>
                          <option>Yes, Scan New</option>
                          <option>No, Just Update</option>
                        </select>
                        <hr class='normal'>
                      </div><!--/.form-group-->
                    </div><!--/.row-->
                    <div class='row'>
                      <div class='col-lg-12'>
                        <button class="btn btn-lg btn-default"><i class='icon-arrow-left'> </i> Go Back</button>
                        <button type="submit" class="btn btn-lg btn-success"><i class='icon-magic'> </i> Create Location</button>
                      </div><!--/.col-lg-12-->
                    </div><!--/.row-->
                  </form>
                </div><!--/.well-->
            </div><!--/.col-mid-8-->
          </div><!--/.row-->
        </div><!--/.col-xs-12-->
      </div><!--/#content-wrapper-->
    </div><!--/.container-->
@stop