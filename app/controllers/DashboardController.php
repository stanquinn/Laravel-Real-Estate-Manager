<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Erick
 * Date: 1/5/14
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */
class DashboardController extends BaseController
{
    protected $layout = 'layouts.default';

    public function main(){
        View::share('page_title','Dashboard');
        return View::make('admin.dashboard');
    }
}