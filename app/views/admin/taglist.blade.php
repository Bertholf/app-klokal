@extends('layouts.admin')
@section('content')
    <div class='container'>
      <div id='content-wrapper' class='row'>
        <div class='col-xs-12'>
          <div class='row'>
            <div class='col-sm-12'>
              <div class='page-header'>
                <div class='pull-left'>
                 <h1><i class='icon-tags text-contrast'> </i> Topics</h1>
                </div><!--/.pull-left-->
                <div class='pull-right'>
                  <ul class="breadcrumb">
                    <li class=''><a href="dashboard.html">Admin</a></li>
                    <li class='active'><a href="#">Topics</a></li>
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
                   Current Topics
                  </div><!--/.title-->
                  <div class='actions'>
                    <a href='#newTopic' data-toggle='modal' class='btn btn-primary btn-lrg'><i class='icon-plus-sign'> </i> Add a New Topic</a>
                  </div>
                </div><!--/.box-header-->
                <div class='box-content box-no-padding'>
                  <table class="data-table admin table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($taglist as $tag_key => $tag_value)
                      <tr>
                        <td data-title='ID'>{{$tag_value->id}}</td>
                        <td data-title='Title'>{{$tag_value->title}}</td>
                        <td data-title='Description'>{{$tag_value->text}}</td>
                        
                        <td data-title='Image'>{{$tag_value->image}}</td>
                        <td data-title='Status'>
                       	 	@if($tag_value->active == 1)
	                        <span class='label label-success'>active</span>
	                        @else
	                        <span class='label label-default'>Inactive</span>
	                        @endif
                        </td>
                        <td data-title='Update'>{{$tag_value->date_updated}}</td>
                        <td><a class='btn btn-default btn-sm' data-toggle='modal' href='#editTopic'><i class='icon-cog'> </i> Edit</a>
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
							{{ $taglist->links() }}
						</div><!--/.media-->
					</li><!--/.list-group-item-->
				  </ul>
			  </div>
          </div><!--/.media row-->
        </div><!--/.col-xs-12-->
      </div><!--/#content-wrapper-->
    </div><!--/.container-->
@stop