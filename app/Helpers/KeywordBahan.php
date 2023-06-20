<?php

namespace App\Helpers;

class KeywordBahan
{
    public const KeywordBahan = [
        'daging', 'emulsifier', 'enzim', 'flavor', 'gelatin', 'gula', 'garam', 'jerohan', 'aktif',
        'kulit', 'laktosa', 'lemak', 'minyak nabati', 'pelapis', 'pelarut', 'pemanis', 'penyedap',
        'pengawet', 'pewarna', 'resin', 'vitamin'
    ];
    
    public static function get($bahan)
    {
        return self::KeywordBahan[$bahan];
    }

    public static function getRecommendationQuery($activity){
        $cleanedActivity = str_replace("-", " ", strtolower($activity));
        $words = explode(' ', $cleanedActivity);
        $keyword = self::KeywordBahan;
        $query = '';
        
        for ($i = count($words) - 1; $i >= 0; $i--) {
            for ($j = 0; $j < count($keyword); $j++ ) {
                if (str_contains($words[$i], $keyword[$j])) {
                    $query = $keyword[$j];
                    break 2;
                }
            }
        }

        return $query;
    }
}
