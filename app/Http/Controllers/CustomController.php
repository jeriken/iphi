<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Helpers\ApiResponse;

class CustomController extends Controller
{
    public function jumlahKas()
    {
        try {
            $data = DB::select('SELECT SUM(jumlah) as jumlah FROM kas');
            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();
            return ApiResponse::failed($e);
        }
    }
}
