<?php

namespace App\Helpers;

class Helper
{
    public static function formatRupiah($harga)
    {
        return 'Rp ' . number_format($harga, 0, ',', '.');
    }

    public static function isAdmin()
    {
        return session()->has('admin_id');
    }

    public static function isSuperAdmin()
    {
        $adminId = session()->get('admin_id');
        $admin = \App\Models\Admin::find($adminId);
        return $admin && $admin->role === 'superadmin';
    }

    public static function getAdminName()
    {
        $adminId = session()->get('admin_id');
        $admin = \App\Models\Admin::find($adminId);
        return $admin ? $admin->name : null;
    }
}