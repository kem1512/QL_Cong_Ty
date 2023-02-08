<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WareHousesController extends Controller
{
    public function Get($perpage, $orderby, $keyword = null)
    {
        if ($keyword == null) {
            $list = DB::table('storehouses')
                ->orderBy('created_at', $orderby)
                ->paginate($perpage);
            return response()->json(
                ['warehouses' => $list],
                200
            );
        }

        $list = DB::table('storehouses')
            ->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('address', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', $orderby)
            ->paginate($perpage);

        return response()->json(
            ['warehouses' => $list],
            200
        );
    }

    public function Delete($id)
    {
        $mesage = "";
        $check = DB::table('storehouse_details')->where('storehouse_id', '=', $id)->get();
        if ($check->count() > 0) {
            $mesage = "Không thể xóa";
        } else {
            $result = DB::table('storehouses')->where('id', '=', $id)->delete();
            if ($result == 0) {
                $mesage = "Thất bại";
            } else {
                $mesage = "Thành công";
            }
        }

        return response()->json([
            'message' => $mesage,
        ], 200);
    }

    public function GetById($id)
    {
        $result = DB::table('storehouses')->find($id);

        return response()->json([
            'message' => $result,
        ], 200);
    }
}