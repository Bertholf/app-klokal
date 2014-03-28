<?php
class TagController extends BaseController {

	public function index()
	{
		$tags = Tag::orderBy('count', 'DESC')->with('topUser')->paginate(10);

		return 	View::make('tag.index', array('tags'=>$tags));
	}

}
