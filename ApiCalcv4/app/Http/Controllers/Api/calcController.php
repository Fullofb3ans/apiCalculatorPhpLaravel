<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calculator;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use DB;

 function checkBd(){
    $сheckLeft = DB::table('Calculators')->select('left_value')->where('left_value', '!=', ' ')->orderBy('id','DESC')->first();
    $сheckRight = DB::table('Calculators')->select('right_value')->where('right_value', '!=', ' ')->orderBy('id','DESC')->first();
    $сheckOperation = DB::table('Calculators')->select('operation')->where('operation', '!=', ' ')->orderBy('id','DESC')->first();

    if (($сheckLeft == NULL)||($сheckRight == NULL)||($сheckOperation == NULL)||($сheckLeft == ' ')||($сheckRight == ' ')||($сheckOperation == ' '))
    {
        return false;
    }
    else {
        return true;
    }
}


class calcController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function history()
    {

        $count = DB::table('Calculators')->count();

        if ($count > 0) {

            return Calculator::all();
        } else {
            echo 'Empty';
        }
    }


    public function leftValue(Request $request, $a)
    {
        if (is_numeric($a)) {
            $leftValue = new Calculator();
            $leftValue->left_value = $a;
            $leftValue->save();
            return $leftValue;
        } else {
            echo 'enter a valid number';
        }
    }

    public function RightValue(Request $request, $a)
    {
        if (is_numeric($a)) {
            $RightValue = new Calculator();
            $RightValue->right_value = $a;
            $RightValue->save();
            return $RightValue;
        } else {
            echo 'enter a valid number';
        }
    }

    public function operation(Request $request, $a)
    {
        switch ($a) {
            case ('+'):
            case ('-'):
            case ('/'):
            case ('*'):
                $operation = new Calculator();
                $operation->operation = $a;
                $operation->save();
                return $operation;

            default:
                echo 'enter a valid operator';
                break;
        }
    }

    public function result(Request $request)
    {
        if (checkBd() == false) {
            echo 'invalid values';
        } else {
            $result = new Calculator();
            $result->left_value = DB::table('Calculators')->select('left_value')->where('left_value', '!=', ' ')->orderBy('id', 'DESC')->first()->left_value;
            $result->right_value = DB::table('Calculators')->select('right_value')->where('right_value', '!=', ' ')->orderBy('id', 'DESC')->first()->right_value;
            $result->operation = DB::table('Calculators')->select('operation')->where('operation', '!=', ' ')->orderBy('id', 'DESC')->first()->operation;

            switch ($result->operation) {
                case ('+'):
                    $result->result = $result->left_value + $result->right_value;
                    break;
                case ('-'):
                    $result->result = $result->left_value - $result->right_value;
                    break;
                case ('/'):
                    $result->result = $result->left_value / $result->right_value;
                    break;
                case ('*'):
                    $result->result = $result->left_value * $result->right_value;
                    break;
            }

            $result->save();
            return $result;
        }
    }
}
