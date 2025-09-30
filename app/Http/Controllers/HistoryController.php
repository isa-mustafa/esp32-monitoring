<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use DateTime;

class HistoryController extends Controller
{
    public function index()
    {
        $factory = (new Factory)->withServiceAccount(base_path('firebase.json'));
        $database = $factory->createDatabase();

        // Ambil data dari Firebase
        $reference = $database->getReference('events/history');
        $snapshot = $reference->getValue();

        if (!$snapshot) {
            $grouped = [];
        } else {
            $data = array_values($snapshot);

            // Kelompokkan berdasarkan tanggal
            $grouped = [];
            foreach ($data as $item) {
                $dateKey = $this->getDateKey($item['time']);
                $grouped[$dateKey][] = $item;
            }

            // Urutkan berdasarkan tanggal terbaru
            uksort($grouped, function ($a, $b) {
                return strtotime($b) - strtotime($a);
            });
        }

        return view('history.index', compact('grouped'));
    }

    private function getDateKey($iso)
    {
        $d = new DateTime($iso);
        return $d->format('Y-m-d');
    }

    public static function formatLocalTime($iso)
    {
        $d = new DateTime($iso);
        return $d->format('d-m-Y H:i:s');
    }

    public static function getDateLabel($dateKey)
    {
        $today = new DateTime();
        $yesterday = new DateTime();
        $yesterday->modify('-1 day');

        $todayKey = $today->format('Y-m-d');
        $yesterdayKey = $yesterday->format('Y-m-d');

        if ($dateKey === $todayKey) return "Hari Ini";
        if ($dateKey === $yesterdayKey) return "Kemarin";

        $d = new DateTime($dateKey);
        return $d->format('d-m-Y');
    }
}
