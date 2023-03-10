<?php

namespace App\Http\Controllers;

use App\Models\EquimentImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;

class EquimentsController extends Controller
{
    function Index()
    {
        $list_loai = DB::table('equiment_types')->get();
        return view('pages.Equiments.Equiment.equiment', compact('list_loai'));
    }
    public function Get($perpage, $curentpage, $keyword = null)
    {
        if ($keyword == null) {
            $equiment_types = DB::table('equiment_types as et')
                ->select(['et.id', 'et.name'])
                ->get()
                ->toArray();


            $newtable = array();

            foreach ($equiment_types as $value) {

                $result = DB::table('equiments as e')
                    ->select(['id', 'image', 'name', 'status'])
                    ->where('e.equiment_type_id', '=', $value->id)
                    ->get()
                    ->toArray();


                $list_equiment = $this->paginate($result, $perpage, $curentpage);

                if (count($list_equiment) != 0) {
                    $newtable['' . $value->name . ''] = $list_equiment;
                }

            }
        }

        return $newtable;
    }

    function paginate($item, $perpage, $page)
    {
        $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($item);
        $curentpage = $page;
        $offset = ($curentpage * $perpage) - $perpage;
        $itemtoshow = array_slice($item, $offset, $perpage);
        return new \Illuminate\Pagination\LengthAwarePaginator($itemtoshow, $total, $perpage);
    }

    function Create(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'min:6'],
                'image' => ['required'],
                'specifications' => ['required', 'min:6'],
                'manufacture' => ['required', 'min:6'],
                'price' => ['required', 'regex:/^[0-9]+$/'],
                'warranty_date' => ['date'],
                'out_of_date' => ['date'],
            ],
            [
                'name.required' => "T??n thi???t b??? kh??ng ???????c ????? tr???ng!",
                'name.min' => "T??n thi???t b??? ph???i l???n h??n 6 k?? t???!",
                'image.required' => "???nh thi???t b??? kh??ng ???????c ????? tr???ng!",
                'specifications.required' => "Th??ng s??? thi???t b??? kh??ng ???????c ????? tr???ng!",
                'specifications.min' => "Th??ng s??? thi???t b??? ph???i l???n h??n 6 k?? t???!",
                'manufacture.required' => "Nh?? cung c???p kh??ng ???????c ????? tr???ng!",
                'manufacture.min' => "Nh?? cung c???p ph???i l???n h??n 6 k?? t???!",
                'price.required' => "Gi?? nh???p kh??ng ???????c ????? tr???ng!",
                'price.regex' => "Gi?? nh???p ph???i l?? s???!",
                'warranty_date.date' => "Ng??y kh??ng h???p l???!",
                'out_of_date.date' => "Ng??y kh??ng h???p l???!",
            ]
        );

        if ($request->has('image')) {
            $file = $request->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $name = $request->name;
        $image = $file_name;
        $specifications = $request->specifications;
        $manufacture = $request->manufacture;
        $price = $request->price;
        $warranty_date = $request->warranty_date;
        $out_of_date = $request->out_of_date;
        $created = Carbon::Now();
        $updated = Carbon::Now();

        $result = DB::table('equiments')
            ->insert([
                'name' => $name,
                'image' => $image,
                'specifications' => $specifications,
                'manufacture' => $manufacture,
                'price' => $price,
                'warranty_date' => $warranty_date,
                'out_of_date' => $out_of_date,
                'equiment_type_id' => $request->equiment_type_id,
                'created_at' => $created,
                'updated_at' => $updated,
            ]);

        $message = $result == 1 ? "Th??nh c??ng" : "Th???t b???i";

        return response()->json([
            'message' => $message
        ], 200);
    }

    function ImportExcel(Request $request)
    {
        $data = Excel::toArray(new EquimentImport, $request->file);

        return response()->json([
            'rows' => $data,
        ]);
    }
}