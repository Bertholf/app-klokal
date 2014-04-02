put this function in class MemberController

call this function in class MemberController public function index()
// 		$this->updateTableListUser(1);		
// 		$this->updateTableListUser(2);		

public function updateTableListUser($i){
	//update database user_list table
	// 		$all_user = User::get();
	$user_list = new UserList();
	$all_user_list = UserList::get();
	//update when user_list table is empty
	// 		dd(count($all_user_list));
	// 		dd(count($all_user_list));
	if(count($all_user_list) == 0 && $i == 1 )
	{
		$all_user = User::orderBy('id')->skip(0)->take(10000)->get();

		foreach ($all_user as $auser){
			$user_id = $auser->id;
			$list_id = $auser->type_id;
			$date_created = date('Y-m-d H:i:s',time());
			$user_listedby = 0;
			$tag = UserList::create(array('user_id' => $user_id,'list_id' => $list_id,'date_created' => $date_created, 'user_listedby' => $user_listedby));
		}
	}

	if(count($all_user_list) <10001 && $i == 2){
			
		$all_user = User::orderBy('id')->skip(10000)->take(24500)->get();
			
		foreach ($all_user as $auser){
			$user_id = $auser->id;
			$list_id = $auser->type_id;
			$date_created = date('Y-m-d H:i:s',time());
			$user_listedby = 0;
			$tag = UserList::create(array('user_id' => $user_id,'list_id' => $list_id,'date_created' => $date_created, 'user_listedby' => $user_listedby));
		}
	}
}