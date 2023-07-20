<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\OrderByDay;
use App\Nova\Metrics\TotalProduct;
use App\Nova\Metrics\TotalRevenue;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new NewUsers(),
//            new TotalRevenue(),
//            new TotalProduct(),
//            new OrderByDay()
        ];
    }
}
