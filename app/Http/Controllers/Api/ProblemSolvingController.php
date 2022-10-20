<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
{
    public function sendTwoVar($var1, $var2)
    {
        $countnum = 0;
        while ($var1 <= $var2) {
            if (fmod($var1, 5) !=  0 || ($var1 / 5) % 2 == 0) {
                echo 'var1 : ' . $var1 . '<br/>';
                $countnum++;
            }
            $var1++;
        }
        echo 'count numbers Is : ' . $countnum;

    }

    /*
    * e.g. A=1 - B=2 - Z=26 - AA=27 - CZ=104 - DA=105 - ZZ=702 - AAA=703
    */
    function stringtointvalue($str)
    {
        $amount = 0;
        $strarra = array_reverse(str_split($str));

        for ($i = 0; $i < strlen($str); $i++) {
            $amount += (ord($strarra[$i]) - 64) * pow(26, $i);
        }
        return $amount;
    }
    function positionalcomparison($a, $b)
    {
        $a1 = $this->stringtointvalue($a);
        $b1 = $this->stringtointvalue($b);
        if ($a1 > $b1) return 1;
        else if ($a1 < $b1) return -1;
        else return 0;
    }

    function getcolumnrange($min, $max)
    {
        $pointer = strtolower($min);
        $output = array();
        while ($this->positionalcomparison($pointer, strtolower($max)) <= 0) {
            array_push($output, $pointer);
            $pointer++;
        }
        print_r($output);

    }


    /**
     * @param Integer[] $nums
     * @param Integer $x
     * @return Integer
     */
    function minOperations($nums, $x)
    {
        $len = count($nums);
        $min = $len + 1;
        $sum = 0;

        /* Find the # of operations from the left. */
        $left = 0;
        while($left < $len)
        {
            $sum += $nums[$left];
            if($sum < $x)
                $left++;
            else
            {
                if($sum == $x)
                    $min = 1 + $left;
                else
                {
                    $sum -= $nums[$left];
                    $left--;
                }
                break;
            }
        }
        if($left == $len && $sum < $x)
            return -1;

        /* Start moving to the right. */
        $right = $len - 1;
        while($right > $left)
        {
            /* Add the next number on the right. */
            $sum += $nums[$right];

            /* Take numbers from the left side until we're at or below x. */
            while($sum > $x && $left >= 0)
            {
                $sum -= $nums[$left];
                $left--;
            }

            if($sum > $x)
                break;
            if($sum == $x)
                $min = min($min, $left + 1 + ($len - $right));
            $right--;
        }
        return ($min <= $x) ? $min : -1;
    }

}
