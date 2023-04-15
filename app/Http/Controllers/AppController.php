<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AppController extends Controller
{
    public function index()
    {
        // product data from database
        $data = DB::table('productTable')
            ->get();

        return view('index', compact('data'));
    }

    public function pos()
    {
        return view('pos');
    }

    public function receiptPage()
    {
        $lastData =  DB::table('sales')
            ->latest()
            ->first();
        return view('receipt', compact('lastData'));
    }

    public function recordsPage()
    {

        // product data from database
        $dDate = Carbon::now()->format('Y-m-d');

        $result = DB::table('sales')
            ->where('date', '=', $dDate)
            ->sum('total');
        $data_records = DB::table('sales')
            ->where('date', '=', $dDate)
            ->get();
        return view('records', compact('data_records', 'result'));
    }



    // Data and Authentication

    public function addProducts(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'item_price' => 'required|integer',
            'item_quant' => 'required|integer',
            'item_type' => 'required|string',
        ]);

        $dDate = Carbon::now()->format('Y-m-d H:i:s');

        $query = DB::table('productTable')->insertOrIgnore([
            'product_name' => $request->item_name,
            'product_price' => $request->item_price,
            'product_quantity' => $request->item_quant,
            'product_category' => $request->item_type,
            'product_status' => 'in-stock',
            'date' => Carbon::now()->format('Y-m-d'),
            'created_at' => $dDate,
        ]);

        if ($query) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', "Failed to store the items");
        }
    }

    public function searchProds(Request $req)
    {
        $req->validate(['item-by-name' => 'required|string']);

        $itemName = $req->input('item-by-name');

        $search = DB::table('productTable')
            ->where('product_name', 'like', '%' . $itemName . '%')
            ->get();
        return view('searched', compact('search', 'req'));
    }

    public function sellProds(Request $request)
    {
        // $request->validate([
        //     'prod_name' => 'required|string',
        //     'prod_quantity' => 'required|integer',
        // ]);

        $checkProd = DB::table('productTable')
            ->where('product_name', '=', $request->input('prod_name'))
            ->first();


        if ($checkProd == []) {
            return ["result" => "There is no product with such name"];
        } else {
            if ($checkProd->product_quantity == 0) {
                return ["result" => "This item is out of stock"];
            } else if ($request->input('prod_quantity') > $checkProd->product_quantity) {
                return ["result" => "Not enough stock to sell"];
            } else {
                $dDate = Carbon::now()->format('Y-m-d H:i:s');

                $p = DB::table('productTable')
                    ->where('product_name', '=', $request->prod_name)
                    ->first();
                DB::table('sales')->insert([
                    'name' => $request->input('prod_name'),
                    'price' => $checkProd->product_price,
                    'quantity' => $request->input('prod_quantity'),
                    'date' => Carbon::now()->format('Y-m-d'),
                    'total' => ($p->product_price * $request->prod_quantity),
                    'created_at' => $dDate,
                ]);

                DB::table('productTable')
                    ->where('product_name', $request->input('prod_name'))
                    ->decrement('product_quantity', $request->input('prod_quantity'));
                return ["result" => "Item Sold"];
            }
        }
    }

    public function deleteProds($id)
    {
        DB::table('productTable')
            ->where('id', '=', $id)
            ->delete();
        return redirect()->route('dashboard');
    }

    public function action(Request $request)
    {
        $qr = $request->get('query');
        $info = DB::table('productTable')
            ->where('product_name', 'like', '%' . $qr . '%')
            ->get();
        $dataModified = array();
        foreach ($info as $data) {
            $dataModified[] = $data->product_name;
        }
        return response()->json($dataModified);
    }
}
