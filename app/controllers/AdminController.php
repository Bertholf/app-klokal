<?php
use Illuminate\Support\Facades\Redirect;

class AdminController extends BaseController {
//------------------------------user start--------------------------------	
	public function userAdd()
	{
		return View::make('admin.useradd');
	}
	
	public function userDelete()
	{
	
	}
	
	public function userModify()
	{
	
	}
	
	public function userList()
	{
		$userlist = User::orderBy('id','desc')
						->paginate();
		return View::make('admin.userlist',array('userlist' => $userlist));
	}
	
	public function userSearch()
	{

	}
//------------------------------user end--------------------------------
//------------------------------location start--------------------------------
	public function locationAdd()
	{
		return View::make('admin.locationadd');
	}
	
	public function locationDelete()
	{
	
	}
	
	public function locationModify()
	{
	
	}
	
	public function locationList()
	{
		$locationlist = location::orderBy('LocationID','asc')
		->paginate(5);
		return View::make('admin.locationlist',array('locationlist' => $locationlist));
	}	
	public function locationSearch()
	{
	
	}
//------------------------------location end--------------------------------
//------------------------------List start--------------------------------
	public function  CategoriesList()
	{
		$categorieslist = Lists::orderBy('id','asc')
						->paginate(5);
		return View::make('admin.categorieslist',array('categorieslist' => $categorieslist));
	}
//------------------------------List end--------------------------------
	//------------------------------Tag start--------------------------------
	public function  TagList()
	{
		$taglist = Tag::orderBy('id','desc')
		->paginate(10);
		return View::make('admin.taglist',array('taglist' => $taglist));
	}
	//------------------------------Tag end--------------------------------
}