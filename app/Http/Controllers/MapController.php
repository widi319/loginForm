<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class MapController extends Controller
{
    public function index()
    {
      //Mapper::map(-0.944080, 100.354655);
      return \View('map');
    }

    public function showEditMap(Request $request){
        $lat = $request->get('lat','');
        $long = $request->get('long','');
        //Mapper::renderJavascript();
        return \View::make('showEditMap');
    }
}
