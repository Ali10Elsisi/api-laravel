<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnSelf;

class DeviceController extends Controller
{
    //
    function list($id=null)
    {
        // $model1=Device::all();
        // $model2=Product::all();
        // return $model1.$model2;
        
        // $device= Device::find($id) ;
        // $product =Product::find($id);
        // return $device.$product;
 
        // return $id?Device::find($id):Device::all();
    }

    function add(Request $req)
    {
        $device=new Device;
        $device->device_name=$req->name;
        $device->device_description=$req->desc;

        $result=$device->save();

        if($result)
        {
            return ["the resutl"=>"the data has been saved"];
        }
        else
        {
            return ["Result"=>"Data has not been saved"];
        }
    }

    function update(Request $req)
    {
        $device=Device::find($req->id);
        $device->device_name=$req->name;
        $device->device_description=$req->desc;
        $result=$device->save();

        if($result)
        {
            return ["the resutl"=>"the data has been updated"];
        }
        else
        {
            return ["Result"=>"operation failed"];
        }
        
    }

    function delete($id)
    {
        $device=Device::find($id);
        $result=$device->delete();
        if($result)
        {
            return "the device has been deleted";
        }
        else
        {
            return "the operation failed";
        }
    }

    function search($name)
    {
        return Device::where('device_name',"like", "%".$name."%")->get();
    }

    function testData(Request $req)
    {
        $rules=array(
            "desc" => "required|max:25"
        );
        $validator=Validator::make($req->all(),$rules);
        if ($validator->fails())
        { 
            return response()->json($validator->errors(),401);
        }
        else
        {
            $device=new Device;
            $device->device_name =$req->name;
            $device->device_description=$req->desc;
            $result=$device->save();
    
            if($result)
            {
                return ["the resutl"=>"the data has been saved"];
            }
            else
            {
                return ["Result"=>"Data has not been saved"];
            }
            
        }

    }



    
}
