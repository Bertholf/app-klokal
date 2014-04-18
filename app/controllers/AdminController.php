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
	
	public function userDelete($id)
	{
		$Lists = Lists::where('id', '=', $id)->delete();
		return Redirect::to('/admin/users-list');
	}
	
	public function userModify()
	{
	
	}
	
	public function userList()
	{
		$userlist = User::orderBy('id','desc')
						->paginate(10);
		return View::make('admin.userlist',array('userlist' => $userlist));
	}
	
	public function userSearch()
	{
		if(Input::has('name') || Input::has('location') || Input::has('type')){
			$name = Input::get('name');
			$location = Input::get('location');
			$type = Input::get('type');
			$userlist = User::where('name','like',$name."%")->paginate(10);
			foreach($userlist as $user_key => $user_value){
// 				dd($user_value->location_id);
				if(Input::has('location')){
					if($user_value->location_id != Input::get('location')) unset($userlist[$user_key]);
				}
				
				if (Input::has('type')){
					if($user_value->location_id != Input::get('type')) unset($userlist[$user_key]);
				}
				
			}
		if(count($userlist) == 0){
			return Redirect::to('/admin/users-list');
		}else{
			return View::make('admin.userlist',array('userlist' => $userlist));
		}	
		}else{
			return Redirect::to('/admin/users-list');
		}
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
	
	public function locationModifyView($loaction_id)
	{
		if($loaction_id>0){
			$location = Location::where('LocationID', '=', $loaction_id)
								->first();
			return View::make('admin.locationedit',array('location' => $location));
		}
		
		return Redirect::to('/admin/location-list');
	}
	public function locationModify()
	{
		if(Input::has('title') && Input::has('id')){
			if(Input::has('description')){
				$LocationText = Input::get('description');
			}else{
				$LocationText = '';
			}
			
			if(Input::has('image')){
				$LocationImage = Input::get('image');
			}else{
				$LocationImage = '';
			}
			
			$status = Input::get('status');
			$scan = Input::get('scan-mode');
			$location = Location::where('LocationID', Input::get('id'))
			->update(array( 'LocationTitle' => Input::get('title') , 
						    'LocationText' => $LocationText,
							'LocationLatitude' => Input::get('latitude'),
							'LocationLongitude' => Input::get('longitude'),
							'LocationRadius' => Input::get('radius'),
							'LocationImage' => $LocationImage,
							'LocationActive' => (int)$status,
							'LocationScan' => (int)$scan
					));
		}
		return Redirect::to('/admin/location-list');
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
	public function categoriesAddView()
	{
		return View::make('admin.categoriesadd');
	}
	public function categoriesAdd()
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
	public function categoriesDelete($id)
	{
		$Lists = Lists::where('id', '=', $id)->delete();
		return Redirect::to('/admin/categories-list');
	}
	public function  categoriesList()
	{
		$categorieslist = Lists::orderBy('id','asc')
						->paginate(5);
		return View::make('admin.categorieslist',array('categorieslist' => $categorieslist));
	}
	public function categoriesModifyView($categorie_id)
	{
		if($categorie_id>0){
			$categorie = Lists::where('id', '=', $categorie_id)
			->first();
			return View::make('admin.categoriesedit',array('categorie' => $categorie));
		}
	
		return Redirect::to('/admin/categories-list');
	}
	public function categoriesModify()
	{
		if(Input::has('title') && Input::has('id')){
			if(Input::has('description')){
				$Text = Input::get('description');
			}else{
				$Text = '';
			}
				
			if(Input::has('image')){
				$Image = Input::get('image');
			}else{
				$Image = '';
			}
				
			$status = Input::get('status');
			
			$lists = Lists::where('id', Input::get('id'))
			->update(array( 'title' => Input::get('title') ,
					'text' => $Text,
					'image' => $Image,
					'active' => (int)$status,
			));
		}
		return Redirect::to('/admin/categories-list');
	}
	
//------------------------------List end--------------------------------
//------------------------------Tag start-------------------------------
	public function  tagList()
	{
		$taglist = Tag::orderBy('id','desc')
		->paginate(10);
		return View::make('admin.taglist',array('taglist' => $taglist));
	}
	public function tagAddView()
	{
		return View::make('admin.tagadd');
	}
	public function tagAdd()
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
	public function tagDelete($id)
	{
		$Tag = Tag::where('id', '=', $id)->delete();
		return Redirect::to('/admin/tag-list');
	}
	public function tagModifyView($tag_id)
	{
		if($tag_id>0){
			$tag = Tag::where('id', '=', $tag_id)
			->first();
			return View::make('admin.tagedit',array('tag' => $tag));
		}
	
		return Redirect::to('/admin/tag-list');
	}
	public function tagModify()
	{
		if(Input::has('title') && Input::has('id')){
			if(Input::has('description')){
				$Text = Input::get('description');
			}else{
				$Text = '';
			}
	
			if(Input::has('image')){
				$Image = Input::get('image');
			}else{
				$Image = '';
			}
	
			$status = Input::get('status');
				
			$lists = Tag::where('id', Input::get('id'))
			->update(array( 'title' => Input::get('title') ,
					'text' => $Text,
					'image' => $Image,
					'active' => (int)$status,
					'date_updated' => date("Y-m-d H:i:s",time())
			));
		}
		return Redirect::to('/admin/tag-list');
	}
	//------------------------------Tag end------------------------------
}