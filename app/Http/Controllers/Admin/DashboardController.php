<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mproduct;
use App\Models\Mcontact;
use App\Models\Morder;

class DashboardController extends Controller
{
    public function index()
    {
        $listProduct = Mproduct::count();
        $listContact = Mcontact::count();
        $listOrderNew = Morder::where('status', 1)->count();
        $listOrderComplete = Morder::where('status', 3)->count();

        $now = getdate();
        
        $listOrderToday = Morder::where('status', 3)
        ->whereDay('orderdate', $now['mday'])
        ->whereMonth('orderdate', $now['mon'])
        ->whereYear('orderdate', $now['year'])
        ->get();

        $listOrderMonth = Morder::where('status', 3)
        ->whereMonth('orderdate', $now['mon'])
        ->whereYear('orderdate', $now['year'])
        ->get();
        
        $listOrderYear = Morder::where('status', 3)
        ->whereYear('orderdate', $now['year'])
        ->get();

        $totalDay = 0;
        $totalMonth = 0;
        $totalYear = 0;

        foreach ($listOrderToday as $item) {
            $totalDay += $item['money'];
        }

        foreach ($listOrderMonth as $item) {
            $totalMonth += $item['money'];
        }

        foreach ($listOrderYear as $item) {
            $totalYear += $item['money'];
        }

        $formatTotalDay = number_format($totalDay, 0, ',', '.'). ' VNĐ';
        $formatTotalMonth = number_format($totalMonth, 0, ',', '.'). ' VNĐ';
        $formatTotalYear = number_format($totalYear, 0, ',', '.'). ' VNĐ';

        return view('backend.dashboard.index', compact('listProduct', 'listContact', 'listOrderComplete', 'listOrderNew', 'formatTotalDay', 'formatTotalYear', 'formatTotalMonth'));
    }
}
