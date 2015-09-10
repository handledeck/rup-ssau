<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Est;
use Est\Intake\OrshaRows;
use Illuminate\Http\Request;
use View;



class IntakeController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function GetVitebskIntake(){
        //$vitebsk=Est::GetIntake('vitebsk');
        View::share('ids',array('navid'=>0,'act'=>2));
        return view('intake\main')->with('object',array('title'=>"Витебские ЭС",'url'=>'intake/vitebsk/','blade'=>view('intake\vitebsk')));
    }

    public function GetGlubokoeIntake(){
        //$glub=Est::GetIntake('glubokoe');
        View::share('ids',array('navid'=>0,'act'=>5));
        return view('intake\main')->with('object',array('title'=>"Глубокские ЭС",'url'=>'intake/glubokoe/','blade'=>view('intake\glubokoe')));
    }

    public function GetPolotskIntake(){
        //$polotsk=Est::GetIntake('polotsk');
        View::share('ids',array('navid'=>0,'act'=>3));
        return view('intake\main')->with('object',array('title'=>"Полоцкие ЭС",'url'=>'intake/polotsk/','blade'=>view('intake\polotsk')));
    }

    public function GetRupIntake(){
       // $rup=Est::GetIntake('rup');
        //$gen=$rup->GetGenirate();
        View::share('ids',array('navid'=>0,'act'=>1));
        return view('intake\main')->with('object',array('title'=>"РУП Витебскэнерго",'url'=>'intake/rup/','blade'=>view('intake\rup')));
    }

    public function GetOrshaIntake(){
        //$orsha=Est::GetIntake('orsha');
        View::share('ids',array('navid'=>0,'act'=>4));
        //$ser=$orsha->intakeSerialize();
        return view('intake\main')->with('object',array('title'=>"Оршанские ЭС",'url'=>'intake/orsha/','blade'=>view('intake\orsha')));
    }

    public function intake($obj,$date=null){
        $data=null;
        if($obj=='rup')
            $data=Est::GetIntake('rup',$date);
        if($obj=='vitebsk')
            $data=Est::GetIntake('vitebsk',$date);
        if($obj=='polotsk')
            $data=Est::GetIntake('polotsk',$date);
        if($obj=='orsha')
            $data=Est::GetIntake('orsha',$date);
        if($obj=='glubokoe')
            $data=Est::GetIntake('glubokoe',$date);
        if($data!=null)
            return $data->serialize();
        else return null;
    }

	public function index()
	{
        
       
	}

	
	public function create()
	{

	}

	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
