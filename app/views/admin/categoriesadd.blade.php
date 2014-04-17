@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-list-ul text-contrast'></i> Categories <small>Add New</small></h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class=''><a href="#">Categories</a></li>
                    <li class='active'><a href="#">Add New</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-6'>
                <div class='well'>
                  <form role="form" class='validate-form' name='location' method='post' action='/admin/categories-add'>
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name='title' placeholder="Ex: Actors" required="required">
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea class="form-control" id='description' name='description' rows="3" placeholder='Ex: Movie Stars from popular Blockbuster Films. '></textarea>
                      </div>
                    </div><!--/.row-->

                    <div class='row'>
                      <div class="form-group col-sm-12">
                        <hr class='normal'>
                        <label for="exampleInputFile">Image</label>
                        <p class="help-block">Upload an Image to represent this Category</p>
                        <input type="file" id="category-image" name='category-image' class='btn-primary' title='Upload an Image'>
                        
                        <hr class='normal'>
                      </div>
                    </div><!--/.row-->
                    <div class='row'>
                      <div class='form-group col-sm-12'>
                        <label for="Status">Status</label>
                        <p class='help-block'>Do you want this category to be visible in the application?</p>
                        <select class="form-control" id='scan-mode' name='scan-mode'>
                          <option>Yes, Active</option>
                          <option>No, Inactive</option>
                        </select>
                        <hr class='normal'>
                      </div><!--/.form-group-->
                    </div><!--/.row-->
                    <div class='row'>
                      <div class='col-lg-12'>
                        <button class="btn btn-lg btn-default" type='reset'><i class='icon-arrow-left'> </i> Go Back</button>
                        <button type="submit" class="btn btn-lg btn-success"><i class='icon-magic'> </i> Create Category</button>
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