<?php
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Redirect;

class AdminController extends BaseController {
//------------------------------user start--------------------------------	
	public function userAddview()
	{
		return View::make('admin.useradd');
	}
	
	public function userAdd()
	{
		if(Input::has('name')){
				$user = new User();
				$user->name = Input::get('name');
				$user->twitter_id = Input::get('twitter_id');
				$user->twitter_handle = Input::get('twitter_handle');
				$user->text = Input::get('text');
				$user->location = Input::get('location');
				$user->location_id = 1;		//@todo
				$user->type_id = 1;		//@todo
				if(Input::has('image')){
					$user->image = Input::get('image');
				}else{
					$user->image = '';
				}
				$user->url = Input::get('url');				
				$user->save();
		}
		return Redirect::to('/admin/users-list');
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
	public function locationAddView()
	{
		return View::make('admin.locationadd');
	}
	public function locationAdd()
	{
		if(Input::has('title')){
			$location = new Location();
			$location->LocationTitle = Input::get('title');
			
			if(Input::has('description')){
				$location->LocationText = Input::get('description');
			}else{
				$location->LocationText = '';
			}
			
			$location->LocationLatitude = Input::get('latitude');
			$location->LocationLongitude = Input::get('longitude');
			$location->LocationRadius = Input::get('radius');
			
			if(Input::has('image')){
				$location->LocationImage = Input::get('image');
			}else{
				$location->LocationImage = '';
			}
			
			$location->LocationActive = Input::get('status');
			$location->LocationScan = Input::get('scan-mode');
			$location->save();
			$location_id = $location->id;
		}
		return Redirect::to('/admin/location-list');
	}
	
	public function locationDelete($id)
	{
		$location = Location::where('LocationID', '=', $id)->delete();
		return Redirect::to('/admin/location-list');
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
	public function CategoriesAddView()
	{
		return View::make('admin.categoriesadd');
	}
	public function CategoriesAdd()
	{
		if(Input::has('title')){
			$Lists = new Lists();
			
			$list_title = Input::get('title');
			$list_slug = str_replace(' ', '-',  strtolower(trim($list_title)));
			if(strpos($list_slug, '&')){
				$list_slug = preg_replace("/&/", "-and-", $list_slug);
			}
			//input list slug already exist
			$list_exist = Lists::where('slug' ,'like', $list_slug."%")->get();
			if(count($list_exist)>0){
				$count = count($list_exist)+1;
				$list_slug = $list_slug.'-'.$count;
			}
			
			$Lists = new Lists();
			$Lists->title = $list_title;
			$Lists->slug = $list_slug;
			if(Input::has('description')){
				$location->text = Input::get('description');
			}else{
				$Lists->text = '';
			}
			if(Input::has('category-image')){
				$location->image = Input::get('category-image');
			}else{
				$Lists->image = '';
			}
			$Lists->active = 1;
			$Lists->featured = 1;
			if(Session::get('id')){
				$Lists->user_id = Session::get('id');
			}else{
				$Lists->user_id = 0;
			}
			$Lists->save();
			
		}
		return Redirect::to('/admin/categories-list');
	}
	public function CategoriesDelete($id)
	{
		$Lists = Lists::where('id', '=', $id)->delete();
		return Redirect::to('/admin/categories-list');
	}
	public function  CategoriesList()
	{
		$categorieslist = Lists::orderBy('id','asc')
						->paginate(5);
		return View::make('admin.categorieslist',array('categorieslist' => $categorieslist));
	}
//------------------------------List end--------------------------------
//------------------------------Tag start-------------------------------
	public function  TagList()
	{
		$taglist = Tag::orderBy('id','desc')
		->paginate(10);
		return View::make('admin.taglist',array('taglist' => $taglist));
	}
	public function TagAddView()
	{
		return View::make('admin.tagadd');
	}
	public function TagAdd()
	{
		if(Input::has('title')){
		$tag = new Tag();
		$tag->title = Input::get('title');
		$tag->text = Input::get('text');
		$tag_slug = str_replace(' ', '-',  strtolower(trim(Input::get('title'))));
		if(strpos($tag_slug, '&')){
			$tag_slug = preg_replace("/&/", "-and-", $tag_slug);  
		}
		$tag->slug = $tag_slug;
		if(Input::has('image')){
			$tag->image = Input::get('image');
		}else{
			$tag->image = '';
		}
		$tag->active = Input::get('status');
		$tag->count = 0;
		$tag->user_id = 0;		//@todo
		$tag->date_updated = date("Y-m-d H:i:s",time());		//@todo
		$tag->date_created = date("Y-m-d H:i:s",time());
		$tag->save();
		}
		return Redirect::to('/admin/tag-list');
	}
	public function TagDelete($id)
	{
		$Tag = Tag::where('id', '=', $id)->delete();
		return Redirect::to('/admin/tag-list');
	}
	//------------------------------Tag end------------------------------
}