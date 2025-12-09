<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller
{
    public function index()
    {
        // Total de alunos     
        $totalMembers = DB::selectOne("
            SELECT COUNT(*) AS total FROM members
        ")->total;


        // Alunos criados nos últimos 30 dias
        $recentMembers = DB::selectOne("
            SELECT COUNT(*) AS total 
            FROM members 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
        ")->total;


        // Gráfico - cadastros por mês nos últimos 6 meses       
        $dataSelect = DB::select("
            SELECT 
                DATE_FORMAT(created_at, '%Y-%m') AS month,
                COUNT(*) AS total
            FROM members
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY month
            ORDER BY month
        ");

        // Faço ele virar um array
        foreach($dataSelect as $val){
            $arraySelect[$val->month] = $val->total;
        }
        // crio o array com 6 meses e adiciono caso tiver dado
        $chartData = [];
        for($i = 0; $i < 6; $i++){

            $month = date('Y-m', strtotime("-$i month"));

            $chartData[] = [
                'month' => $month,
                'total' => $arraySelect[$month] ?? 0,
            ];
        }
        
        $dataSelectReais = DB::select("
            SELECT 
                DATE_FORMAT(created_at, '%Y-%m') AS month,
                SUM(plan_value) AS total
            FROM members
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY month
            ORDER BY month
        ");

        // Faço ele virar um array
        $valueTotal = 0;
        foreach($dataSelectReais as $val){
            $arraySelectReais[$val->month] = $val->total;
            $valueTotal += $val->total;
        }
        // crio o array com 6 meses e adiciono caso tiver dado
        $chartDataReais = [];
        for($i = 0; $i < 6; $i++){

            $month = date('Y-m', strtotime("-$i month"));

            $chartDataReais[] = [
                'month' => $month,
                'total' => $arraySelectReais[$month] ?? 0,
            ];
        }

        return inertia('Tenant/Dashboard', [
            'totalMembers' => $totalMembers,
            'recentMembers' => $recentMembers,
            'chartData' => $chartData,
            'chartDataReais' => $chartDataReais ?? [],
            'valueTotal' => number_format($valueTotal, 2, ',', '.'),
        ]);
    }
}


?>