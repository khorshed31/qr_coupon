<?php

namespace Module\Product\Services;

use App\Models\User;
use Carbon\Carbon;
use Module\Product\Models\Customer;
use Module\Product\Models\Product;


class HelperService
{


    public function dahboardData()
    {

        $data['total_products'] = Product::query()->count();
        $data['total_users'] = User::query()->where('type','user')->count();
        $data['total_customers'] = Customer::query()->count();
        return $data;
    }

    public function sidebars()
    {
        return (object)[
            [
                'name' => 'Sale',
                'url' => '#',
                'icon' => 'fa fa-shopping-bag',
                'target' => '',
                'child' => [
                    [
                        'name' => 'POS Sale',
                        'url' => route('dokani.sales.create'),
                        'icon' => 'fa-caret-right',
                        'target' => '',
                    ],
                    [
                        'name' => 'Sales list',
                        'url' => route('dokani.sales.index'),
                        'icon' => 'fa-caret-right',
                        'target' => '_blank',
                    ],
                    [
                        'name' => 'Due Collection',
                        'url' => route('dokani.collections.create'),
                        'icon' => 'fa-caret-right',
                        'target' => '_blank',
                    ],
                ],
            ],
        ];
    }
}
