<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mproduct;
use App\Models\Mcatalog;
use App\Models\Mslider;

class HomeController extends Controller
{
    public function index()
    {
        $listSlider =  Mslider::where('status', 1)
        ->orderBy('created_at', 'desc')
        ->select('name', 'thumb')
        ->take(8)
        ->get();

        $listProductNews = Mproduct::where('status', 1)
        ->where('trash', 1)
        ->where('featured', 0)
        ->orderBy('created_at', 'desc')
        ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
        ->take(10)
        ->get();

        $listProductFeatured = Mproduct::where('status', 1)
        ->where('trash', 1)
        ->where('featured', 1)
        ->orderBy('created_at', 'desc')
        ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
        ->take(10)
        ->get();

        $listProductMostView = Mproduct::where('status', 1)
        ->where('trash', 1)
        ->orderBy('view', 'desc')
        ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
        ->take(10)
        ->get();

        $listProductByCatalog = Mcatalog::where('status', 1)
        ->where('trash', 1)
        ->where('parent_id', 0)
        ->orderBy('created_at', 'asc')
        ->select('name', 'id')
        ->take(5)
        ->get();
        $mcatalog = new Mcatalog;
        $mproduct = new Mproduct;
        return view('frontend.home.index', compact('listProductNews', 'listProductFeatured', 'listProductMostView', 'listSlider', 'listProductByCatalog', 'mcatalog', 'mproduct'));
    }

    public function modal(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            if (isset($id) && !empty($id)) {
                $listProductModal = Mproduct::where('product.status', 1)
                    ->where('product.trash', 1)
                    ->where('product.id', $id)
                    ->join('catalog', 'product.catid', '=', 'catalog.id')
                    ->join('producer', 'product.producerid', '=', 'producer.id')
                    ->join('brand', 'product.brandid', '=', 'brand.id')
                    ->orderBy('product.created_at', 'desc')
                    ->select('product.name as productName', 'product.sku','product.thumb', 'product.thumb_list', 'product.intro_desc', 'product.sale', 'product.price', 'product.catid', 'catalog.name as catName', 'producer.name as producerName', 'brand.name as brandName', 'product.id')
                    ->get();

                $html = '';

                foreach ($listProductModal as $item) {
                    $html .= '<div class="row">
                    <div class="col-lg-6">
                        <div class="swiper-container gallery-top mb-3">
                            <div class="swiper-wrapper">';

                                $html .= '<div class="swiper-slide">
                                    <img src="'.url('uploads/product/'.$item['thumb']).'" class="img-fluid" alt="'.$item['name'].'" />
                                </div>';

                                $thumb_list = explode(',', $item['thumb_list']);
                                foreach ($thumb_list as $img) {
                                    $html .= '<div class="swiper-slide">
                                    <img src="'.url('uploads/product/'.$img).'" class="img-fluid" alt="'.$item['name'].'" />
                                </div>';
                                }
                                $html .= '</div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">';
                            $html .= '<div class="swiper-slide">
                            <img src="'.url('uploads/product/'.$item['thumb']).'" class="img-fluid" alt="'.$item['name'].'" />
                        </div>';

                        $thumb_list = explode(',', $item['thumb_list']);
                        foreach ($thumb_list as $img) {
                            $html .= '<div class="swiper-slide">
                            <img src="'.url('uploads/product/'.$img).'" class="img-fluid" alt="'.$item['name'].'" />
                        </div>';
                        }
                        $html .= '</div>
                        </div>
                    </div>
    
                    <div class="col-lg-6">
                        <div class="section__modal-info mt-4 mt-lg-0">
                            <div class="section__modal-info-name">
                                <h5>'.$item['productName'].' - '.$item['sku'].'</h5>
                            </div>
    
                            <div class="section__modal-info-price">';
                            if($item['sale'] > 0) {
                                $html .= ' <div class="section__modal-info-price-buy">
                                '.number_format($item['price'] - $item['price'] * ($item['sale'] / 100), 0, ',', '.').' VNĐ
                            </div>

                            <div class="section__modal-info-price-root">
                                '.number_format($item['price'], '0', ',', '.').' VNĐ
                            </div>';
                            } else {
                                $html .= ' <div class="section__modal-info-price-buy">
                                '.number_format($item['price'], '0', ',', '.').' VNĐ
                            </div>

                            <div class="section__modal-info-price-root d-none">
                                '.number_format($item['price'], '0', ',', '.').' VNĐ
                            </div>';
                            }
                               
                            $html .= '</div>
    
                            <div class="section__modal-info-intro mb-4">
                                <p class="text-muted">
                                    '.$item['intro_desc'].'
                                </p>
                            </div>
    
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex">
                                    <strong class="text-capitalize mr-3">'.__('detail.sku').':
                                    </strong>
                                    <p class="text-capitalize">'.$item['sku'].'</p>
                                </li>
    
                                <li class="d-flex">
                                    <strong class="text-capitalize mr-3">'.__('detail.catalog').': </strong>
                                    <p class="text-capitalize">'.$item['catName'].'</p>
                                </li>
    
                                <li class="d-flex">
                                    <strong class="text-capitalize mr-3">'.__('detail.producer').':
                                    </strong>
                                    <p class="text-capitalize">'.$item['producerName'].'</p>
                                </li>';

                            if($item['brandName'] != 'Empty') {
                                $html .= '<li class="d-flex">
                                <strong class="text-capitalize mr-3">'.__('detail.brand').':
                                </strong>
                                <p class="text-capitalize">'.$item['brandName'].'</p>
                            </li>';
                            } else {
                                $html .= '';
                            }
                            $html .='</ul>
    
                            <div class="section__modal-info-btn mb-4">
                                <a href="javascript:void(0)" class="section__product-container-addToCart"
                                data-id="'. $item['id'] .'"> Thêm vào giỏ </a>
    
                                <a href="javascript:void(0)">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
                }

                echo $html;
            }
        }
    }

    public function changeLanguage(Request $request)
    {
        $lang = $request->language;
        $language = config('app.locale');
        if ($lang == 'en') {
            $language = 'en';
        }
        if ($lang == 'vi') {
            $language = 'vi';
        }
        Session::put('language', $language);
        return redirect()->back();
    }
}
