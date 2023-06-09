<?php

namespace App\Helpers;

class KelompokNabati
{
    // List kelompok nabati beserta titik kritisnya
    public const kelompokNabati = [
        'Dried products' => ['laktosa','minyak-nabati'],
        'Tepung terigu' => ['vitamin'],
        'Oleoresin' => ['emulsifier'],
        'Emulsifier nabati' => ['enzim'],
        'HVP' => ['enzim'],
        'Minyak nabati' => ['karbon-aktif'],
        'Margarin' => ['minyak-nabati', 'vitamin', 'emulsifier', 'flavor', 'pewarna'],
        'Gula' => ['karbon-aktif', 'resin'],
        'Pewarna' => ['emulsifier', 'pelapis', 'pelarut'],
        'Jam / Selai' => ['pewarna', 'gula', 'mikrobial'],
        'Manisan buah-buahan' => ['flavor', 'pewarna', 'gula', 'mikrobial'],
        'Sari buah & konsentrat' => ['vitamin', 'enzim', 'flavor', 'pewarna', 'gula', 'gelatin'],
        'Buah-buahan kalengan' => ['flavor', 'gula', 'mikrobial'],
        'Saus' => ['gula', 'mikrobial'],
        'Pati & turunannya' => ['enzim'],
    ];

    public static function get($kelompok)
    {
        return self::kelompokNabati[$kelompok];
    }
}
