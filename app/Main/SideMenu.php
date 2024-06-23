<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'Beranda' => [
                'icon' => 'home',
                'route_name' => 'index',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Beranda',
            ],
            'Cek Kehalalan Produk' => [
                'icon' => 'crosshair',
                'route_name' => 'product.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Cek Kehalalan Produk'
            ],
            'Screening Produk Hewani' => [
                'icon' => 'crosshair',
                'route_name' => 'screening.history-hewani',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Screening Produk Hewani'
            ],
            'Screening Produk Nabati' => [
                'icon' => 'crosshair',
                'route_name' => 'screening.history-nabati',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Screening Produk Nabati'
            ],
            'Screening Produk Jadi' => [
                'icon' => 'crosshair',
                'route_name' => 'screening.history-produk-jadi',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Screening Produk Jadi'
            ],
            'Rekomendasi Bahan Halal Pengganti' => [
                'icon' => 'file-text',
                'route_name' => 'recommendation.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Rekomendasi Bahan Halal Pengganti'
            ],
            'Riwayat Pengecekan' => [
                'icon' => 'clock',
                'route_name' => 'history.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Riwayat Pengecekan'
            ],
            'devider'
        ];
    }
}
