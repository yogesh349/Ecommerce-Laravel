<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipCity;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingController extends Controller
{
    //

    public function divisionView(){
		$divisions = ShipDivision::orderBy('id','DESC')->get();
		return view('backend.ship.division.view_division',compact('divisions'));

	}


    public function DivisionStore(Request $request){

    	$request->validate([
    		'division_name' => 'required',   	 

    	]);


	ShipDivision::insert([

		'division_name' => $request->division_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Division Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 


    public function DivisionEdit($id){

        $divisions = ShipDivision::findOrFail($id);
           return view('backend.ship.division.edit_division',compact('divisions'));
          }

    
    public function DivisionUpdate(Request $request,$id){
            ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
            ]);
    
            $notification = array(
                'message' => 'Division Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('manage.division')->with($notification);
    
    
        } // end mehtod 


        public function DivisionDelete($id){

            ShipDivision::findOrFail($id)->delete();
    
            $notification = array(
                'message' => 'Division Deleted Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
    
        } // end method 


         //Start Ship District
        public function DistrictView(){
            $division = ShipDivision::orderBy('division_name','ASC')->get();
            $district = ShipDistrict::orderBy('id','DESC')->get();
                return view('backend.ship.district.view_district',compact('division','district'));
            }


            public function DistrictStore(Request $request){

                $request->validate([
                    'division_id' => 'required',  
                    'district_name' => 'required',  	 
        
                ]);
        
        
            ShipDistrict::insert([
        
                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'created_at' => Carbon::now(),
        
                ]);
        
                $notification = array(
                    'message' => 'District Inserted Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->back()->with($notification);
        
            } // end method 


            public function DistrictEdit($id){

                $division = ShipDivision::orderBy('division_name','ASC')->get();
                $district = ShipDistrict::findOrFail($id);
                   return view('backend.ship.district.edit_district',compact('district','division'));
            }


            public function DistrictUpdate(Request $request,$id){

                ShipDistrict::findOrFail($id)->update([
        
                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'created_at' => Carbon::now(),
        
                ]);
        
                $notification = array(
                    'message' => 'District Updated Successfully',
                    'alert-type' => 'info'
                );
        
                return redirect()->route('manage.district')->with($notification);
        
        
            } // end mehtod 
      

            public function DistrictDelete($id){

                ShipDistrict::findOrFail($id)->delete();
        
                $notification = array(
                    'message' => 'District Deleted Successfully',
                    'alert-type' => 'info'
                );
        
                return redirect()->back()->with($notification);
        
            } // end method 


            //Start Ship city



            public function CityView(){
                $division = ShipDivision::orderBy('division_name','ASC')->get();
                $district = ShipDistrict::orderBy('district_name','ASC')->get();
                $city = ShipCity::orderBy('id','DESC')->get();
		        return view('backend.ship.city.view_city',compact('division','district','city'));
            }

            //End ship city

            public function DistrictAjax($id){
                $districts=ShipDistrict::where('division_id',$id)->orderBy('district_name','ASC')->get();
                return response($districts);
            }

            public function CityStore(Request $request){
                $request->validate([
                    'division_id' => 'required',  
                    'district_id' => 'required', 
                    'city_name' => 'required', 	 
        
                ]);
        
        
            ShipCity::insert([
        
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'city_name' => $request->city_name,
                'created_at' => Carbon::now(),
        
                ]);
        
                $notification = array(
                    'message' => 'City Inserted Successfully',
                    'alert-type' => 'success'
                );
        
                return redirect()->back()->with($notification);
            }

            public function CityEdit($id){
                $division = ShipDivision::orderBy('division_name','ASC')->get();
                $district = ShipDistrict::orderBy('district_name','ASC')->get();
                $city = ShipCity::findOrFail($id);
		        return view('backend.ship.city.edit_city',compact('division','district','city'));
            }


            public function CityUpdate(Request $request,$id){
                ShipCity::findOrFail($id)->update([

                    'division_id' => $request->division_id,
                    'district_id' => $request->district_id,
                    'city_name' => $request->city_name,
                    'created_at' => Carbon::now(),
            
                    ]);
            
                    $notification = array(
                        'message' => 'City Updated Successfully',
                        'alert-type' => 'info'
                    );
            
                    return redirect()->route('manage.city')->with($notification);

            }


            public function CityDelete($id){
                ShipCity::findOrFail($id)->delete();

                $notification = array(
                    'message' => 'City Deleted Successfully',
                    'alert-type' => 'info'
                );
        
                return redirect()->back()->with($notification);
            }
      
}
