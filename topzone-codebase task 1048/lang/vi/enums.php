<?php

use App\Enums\Admin\AdminRoles;
use App\Enums\User\{UserGender, UserVip, UserRoles};

return [
    AdminRoles::class => [
        AdminRoles::SuperAdmin->value => 'Dev',
        AdminRoles::Admin->value => 'Admin',
    ],
    UserGender::class => [
        UserGender::Male->value => 'Nam',
        UserGender::Female->value => 'Nữ',
        UserGender::Other->value => 'Khác',
    ],
    UserVip::class => [
        UserVip::Bronze->value => 'Đồng',
        UserVip::Silver->value => 'Bạc',
        UserVip::Gold->value => 'Vàng',
        UserVip::Diamond->value => 'Kim cương',
    ],
    UserRoles::class => [
        UserRoles::Member->value => 'Thành viên',
    ],
];