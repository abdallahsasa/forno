<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private $index_view;
    private $show_view;
    private $soon_view;


    public function __construct()
    {
        $this->index_view = 'index';
        $this->menu_view = 'menu';
        $this->show_view = 'show';
        $this->soon_view = 'coming_soon';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $filter = request()->has('filter') ? request()->filter : 'all';

        if ($filter == "all")
            $products = Product::where('status', '=', 'active')
                ->inRandomOrder()
                ->limit(8)
                ->get();
        else
            $products = Category::findOrFail($filter)->products()->latest()->get();

        $categories = Category::where('status', '=', 'active')->get();
        return view($this->index_view, compact(['products', 'categories', 'filter']));
    }
    public function menu()
    {
        $filter = request()->has('filter') ? request()->filter : 'all';

        if ($filter == "all")
            $products = Product::where('status', '=', 'active')
                ->inRandomOrder()
                ->get();
        else
            $products = Category::findOrFail($filter)->products()->latest()->get();
        $categories = Category::where('status', '=', 'active')->get();
        return view($this->menu_view, compact(['products', 'categories', 'filter']));
    }
    public function filtermenu($categoryfilter)
    {
        $filter = request()->has('filter') ? request()->filter : 'all';

        if ($filter == "all")
            $products = Product::where('status', '=', 'active')
                ->inRandomOrder()
                ->get();
        else
            $products = Category::findOrFail($filter)->products()->latest()->get();
        $categories = Category::where('status', '=', 'active')->get();
        return view($this->menu_view, compact(['products', 'categories', 'filter','categoryfilter']));
    }
    /**
     * Display Coming Soon Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function soon()
    {
        return view($this->soon_view);
    }
}
