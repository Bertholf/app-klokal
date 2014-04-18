@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-compass text-contrast'></i> Tag <small>Edit</small></h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class=''><a href="#">Tags</a></li>
                    <li class='active'><a href="#">Edit</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-6'>
                <div class='well'>
                  <form role="form" class='validate-form' method='post' action='/admin/tag-modify-action'>
                  	<input type="hidden" class="form-control" id="id" name='id'  value="{{$tag->id}}">
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name='title' value="{{$tag->title}}" required="required" placeholder="I.E. Boston Massachusets">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control" id='description' name='description' rows="3">
                        {{$tag->text}}
                        </textarea>
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-lg-12">
                        <hr class='normal'>
                        <label for="exampleInputFile">Image</label>
                        <div class='row'>
                          <div class='col-lg-12'>
                            <img src="{{$tag->image}}"></img>
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
                              <input type="file" id="icon-upload" class='btn-primary' name='image' value="{{$tag->image}}" title='Upload a New Image'> 
                            </div> <!--/col-lg-3-->
                          </div><!--/.row-->
                        
                        <hr class='normal'>
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                    <div class='row'>
                      <div class='form-group col-sm-8'>
                        <label for="Status">Status</label>
                        <p class='help-block'>Do you want this to be visilbe in the system?</p>
                        <select class="form-control" id='status' name='status'>
                          <option value='1'
                          <?php if($tag->active == 1){ $active = 'selected'; echo  $active;} ?>
                          >Yes, Active</option>
                          <option value='0'
                          <?php if($tag->active == 0){ $inactive = 'selected'; echo  $inactive; }?>
                          >No, Inactive</option>
                        </select>
                        <hr class='normal'>
                      </div><!--/.form-group-->
                    </div><!--/.row-->
                    </div><!--/.row-->
                    <div class='row'>
                      <div class='col-lg-12'>
                        <button class="btn btn-lg btn-default"><i class='icon-arrow-left'> </i> Go Back</button>
                        <button class="btn btn-lg btn-default" data-toggle='modal' href="/admin/tag-delete/{{$tag->id}}"><i class='icon-trash'> </i> Delete</button>
                        <button type="submit" class="btn btn-lg btn-success"><i class='icon-save'> </i> Save Changes</button>
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