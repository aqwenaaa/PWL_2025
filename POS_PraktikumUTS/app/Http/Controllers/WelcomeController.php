<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
        public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        // Data metrik untuk dashboard
        $newOrders = 150;
        $bounceRate = 53;
        $userRegistrations = 44;
        $uniqueVisitors = 65;

        return view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'newOrders' => $newOrders,
            'bounceRate' => $bounceRate,
            'userRegistrations' => $userRegistrations,
            'uniqueVisitors' => $uniqueVisitors
        ]);
    }
}