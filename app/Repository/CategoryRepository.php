<?php

namespace App\Repository;

use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    public function getData($request)
    {
        $response = ['status' => false, 'data' => null, 'message' => null];
        $explodeRequest = explode('/', $request->category);

        if (count($explodeRequest) == 1) {
            $data = Category::where('name', 'like', "%$request->category%")->get();
            if ($data->isEmpty()) {
                $response['message'] = "there is no data master $request->category";
                return $response;
            }
            $response['status'] = true;
            $response['data'] = $data;
        } else if (count($explodeRequest) == 2) {
            $getVehicle = Category::where('name', $explodeRequest[0])->whereNull('parent_id')->first();
            if (!$getVehicle) {
                $response['message'] = "there is no data master $explodeRequest[0]";
                return $response;
            }

            $getParentVehicle = Category::where('name', $request->category)->whereNotNull('parent_id')->first();
            if (!$getParentVehicle) {
                $response['message'] = "there is no data parent $request->category";
                return $response;
            }

            $decodeData = (array) json_decode(json_encode($getParentVehicle->parent_id), true);
            array_push($decodeData, $getParentVehicle->id);

            $encodeData = json_encode($decodeData);

            $response['status'] = true;
            $response['data'] = Category::whereRaw("JSON_CONTAINS(parent_id, '$encodeData', '$')")->orWhere('id', $getVehicle->id)->orWhere('name', $request->category)->get();
        } else {
            $data = Category::where('name', $request->category)->first();
            if (!$data) {
                $response['message'] = "there is no data $request->category";
            }
            $response['status'] = true;
            $response['data'] = $data;
        }

        return $response;
    }
}
