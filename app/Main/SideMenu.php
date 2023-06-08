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
            'Rekomendasi Bahan Halal Pengganti' => [
                'icon' => 'file-text',
                'route_name' => 'file-manager',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Rekomendasi Bahan Halal Pengganti'
            ],
            'Riwayat Pengecekan' => [
                'icon' => 'clock',
                'route_name' => 'point-of-sale',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Riwayat Pengecekan'
            ],
            'devider'
        ];
    }
}
