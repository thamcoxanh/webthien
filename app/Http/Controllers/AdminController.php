<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\History;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function __construct() {

    }

    public function getIndex() {


        $year = date("Y");
        $date = new \DateTime();
        $date->setISODate($year, 53);
        $weeks = $date->format("W") === "53" ? 53 : 52;

        $allDataYear = [];
        for($i= 1 ; $i <= $weeks ; $i++){
            $dto = new \DateTime();
            $ret['week_start'] = $dto->setISODate($year, $i)->format('Y-m-d');
            $ret['week_end'] = $dto->modify('+6 days')->format('Y-m-d');
            $allPaypal = History::where('created_at', '<=',$ret['week_end'])->where('created_at', '>=',$ret['week_start'])->get();
            $item_data = array();
            if(count($allPaypal) == 0){
                $item_data = array('week_start' => $ret['week_start'],"week" => $i, 'price' => 0 ,'week_end'=>$ret['week_end']);
            }else{
                $count = 0;
                foreach ($allPaypal as $key => $value) {
                    $count += $value->price;
                }
                $item_data = array('week_start' => $ret['week_start'],"week" => $i, 'price' => $count,'week_end'=>$ret['week_end']);

            }
            $allDataYear[$i-1] = $item_data;
        }


        $year_old = $year -1 ;
        $date = new \DateTime();
        $date->setISODate($year_old, 53);
        $weeks_old = $date->format("W") === "53" ? 53 : 52;

        $allDataYearOld = [];
        for($i= 1 ; $i <= $weeks_old ; $i++){
            $dto_old = new \DateTime();
            $ret_old['week_start'] = $dto_old->setISODate($year_old, $i)->format('Y-m-d');
            $ret_old['week_end'] = $dto_old->modify('+6 days')->format('Y-m-d');

            $allPaypal = History::where('created_at', '<=',$ret_old['week_end'])->where('created_at', '>=',$ret_old['week_start'])->get();
            $item_data = array();
            if(count($allPaypal) == 0){
                $item_data = array('week_start' => $ret_old['week_start'],"week" => $i, 'price' => 0 ,'week_end'=>$ret_old['week_end']);
            }else{
                $count = 0;
                foreach ($allPaypal as $key => $value) {
                    $count += $value->price;
                }
                $item_data = array('week_start' => $ret_old['week_start'],"week" => $i, 'price' => $count,'week_end'=>$ret_old['week_end']);

            }
            $allDataYearOld[$i-1] = $item_data;
        }

        $allDataMonthOfYear = [];
        for($i= 1 ; $i <= 12 ; $i++){
            $ret_month['week_start'] = $year.'-'.$i.'-'.'1';
            $ret_month['week_end'] = date("Y-m-t", strtotime($ret_month['week_start']));;

            $allPaypal = History::where('created_at', '<=',$ret_month['week_end'])->where('created_at', '>=',$ret_month['week_start'])->get();
            $item_data = array();
            if(count($allPaypal) == 0){
                $item_data = array('week_start' => $ret_month['week_start'],"month" => $i, 'price' => 0 ,'week_end'=>$ret_month['week_end']);
            }else{
                $count = 0;
                foreach ($allPaypal as $key => $value) {
                    $count += $value->price;
                }
                $item_data = array('week_start' => $ret_month['week_start'],"month" => $i, 'price' => $count,'week_end'=>$ret_month['week_end']);

            }
            $allDataMonthOfYear[$i-1] = $item_data;
        }

        $allDataMonthOldOfYear = [];
        for($i= 1 ; $i <= 12 ; $i++){
            $ret_month['week_start'] = $year_old.'-'.$i.'-'.'1';
            $ret_month['week_end'] = date("Y-m-t", strtotime($ret_month['week_start']));;

            $allPaypal = History::where('created_at', '<=',$ret_month['week_end'])->where('created_at', '>=',$ret_month['week_start'])->get();
            $item_data = array();
            if(count($allPaypal) == 0){
                $item_data = array('week_start' => $ret_month['week_start'],"month" => $i, 'price' => 0 ,'week_end'=>$ret_month['week_end']);
            }else{
                $count = 0;
                foreach ($allPaypal as $key => $value) {
                    $count += $value->price;
                }
                $item_data = array('week_start' => $ret_month['week_start'],"month" => $i, 'price' => $count,'week_end'=>$ret_month['week_end']);

            }
            $allDataMonthOldOfYear[$i-1] = $item_data;
        }
        $data = array(
            'title'=>'Home Admin',
            'menu' => 'admin',
            'year' => $allDataYear,
            'year_old' => $allDataYearOld,
            'month_year' => $allDataMonthOfYear,
            'month_year_old' => $allDataMonthOldOfYear,
            'title_year_old' => $year_old,
            'title_year' => $year,
          );
        return view('admin', $data);
    }




}
