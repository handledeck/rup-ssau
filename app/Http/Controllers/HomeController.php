<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        
        
        \View::share('ids',array('navid'=>6,'act'=>7));
		return view('home')->with('data');
	}
    
    protected function GetFormatDate($date=null){
        $dtn=null;
        if(!isset($date)){
            $dtn=getDate();
        }
        else{
            $dtn=date('Y-m-d',$date/1000);
        }
        return array($dtn['year'],$dtn['mday'],$dtn['mon'],0,0,0);
    }

}
