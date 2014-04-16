@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-list-ul text-contrast'></i> Categories</h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="#">Admin</a></li>
                    <li class='active'><a href="#">Categories</a></li>
                  </ul>
                </div><!--/.pull-right-->
              </div><!--/.page-header-->

            </div><!--/.col-sm-12-->
          </div><!--/.row-->

          

          <div class='row'>
            <div class='col-md-12'>
              <div class='box'>
                <div class='box-header'>
                  <div class='title'>
                   Current Categories
                  </div><!--/.title-->
                  <div class='actions'>
                    <a href='categories-new.html' class='btn btn-primary btn-lrg'><i class='icon-plus-sign'> </i> Add a New Category</a>
                  </div>
                </div><!--/.box-header-->
                <div class='box-content box-no-padding'>
                  <table class="data-table admin table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Icon</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($categorieslist as $categories_key => $categories_value)
                      <tr>
                        <td data-title='ID'>{{$categories_value->id}}</td>
                        <td data-title='Title'>{{$categories_value->title}}</td>
                        <td data-title='Icon'><img src="{{$categories_value->image}}"></img></td>
                        <td data-title='Description'>{{$categories_value->text}}</td>
                        <td data-title='Status'>
	                        @if($categories_value->active == 1)
	                        <span class='label label-success'>active</span>
	                        @else
	                        <span class='label label-default'>Inactive</span>
	                        @endif
                        </td>
                        <td><a class='btn btn-default btn-sm' href='categories-edit.html'><i class='icon-cog'> </i> Edit</a>
                          <a class='btn btn-default btn-sm' data-toggle='modal' href='#confirmDelete'><i class='icon-trash'> </i></a>
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
							{{ $categorieslist->links() }}
						</div><!--/.media-->
					</li><!--/.list-group-item-->
				  </ul>
			  </div>
          </div><!--/.media row-->
        </div><!--/.col-xs-12-->
      </div><!--/#content-wrapper-->
    </div><!--/.container-->
  @stop