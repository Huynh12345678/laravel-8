<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Mproduct;
use App\Models\Mcatalog;
use App\Models\Mproducer;
use App\Models\Mbrand;
use App\Models\Mcomment;
use App\Models\Mreply;

class ProductsController extends Controller
{
    public function index($page = 1, Request $request)
    {
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $mcatalog = new Mcatalog;
        $catalogAccordion = $mcatalog->catalogAccordion();

        $filter = $request->filter;
        $select = '';
        if (isset($filter)) {
            $where = $request->filter;
            $result = explode('-', $where);
            $value = $result[0];
            $order = $result[1];
            $getData = array(
                '0' => $value,
                '1' => $order
            );
            Session::put('productFilter', $getData);
        } else {
            if (Session::get('productFilter')) {
                $getData = Session::get('productFilter');
                $value = $getData[0];
                $order = $getData[1];
                $option = $value . '-' . $order;
                if ($option == 'created_at-desc') {
                    $select .= ' <option value="created_at-desc" selected>Mặc định</option>';
                } else {
                    $select .= ' <option value="created_at-desc">Mặc định</option>';
                }

                if ($option == 'created_at-asc') {
                    $select .= '  <option value="created_at-asc" selected>Sản phẩm cũ nhất</option>';
                } else {
                    $select .= '  <option value="created_at-asc">Sản phẩm cũ nhất</option>';
                }

                if ($option == 'name-asc') {
                    $select .= '<option value="name-asc" selected>Tên (A - Z)</option>';
                } else {
                    $select .= '  <option value="name-asc">Tên (A - Z)</option>';
                }

                if ($option == 'name-desc') {
                    $select .= '<option value="name-desc" selected>Tên (Z - A)</option>';
                } else {
                    $select .= '  <option value="name-desc">Tên (Z - A)</option>';
                }

                if ($option == 'price-asc') {
                    $select .= '<option value="price-asc" selected>Giá (Thấp -> Cao)</option>';
                } else {
                    $select .= '  <option value="price-asc">Giá (Thấp -> Cao)</option>';
                }

                if ($option == 'price-desc') {
                    $select .= '<option value="price-desc" selected>Giá (Cao -> Thấp)</option>';
                } else {
                    $select .= '  <option value="price-desc">Giá (Cao -> Thấp)</option>';
                }

                if ($option == 'view-desc') {
                    $select .= '<option value="view-desc" selected>Lượt xem (Thấp -> Cao)</option>';
                } else {
                    $select .= '  <option value="view-desc">Lượt xem (Thấp -> Cao)</option>';
                }

                if ($option == 'view-asc') {
                    $select .= '<option value="view-asc" selected>Lượt xem (Cao -> Thấp)</option>';
                } else {
                    $select .= '  <option value="view-asc">Lượt xem (Cao -> Thấp)</option>';
                }
            } else {
                $value = 'created_at';
                $order = 'desc';

                $select .= '<option value="created_at-desc" selected>Mặc định</option>
                <option value="created_at-asc">Sản phẩm cũ nhất</option>
                <option value="name-asc">Tên (A - Z)</option>
                <option value="name-desc">Tên (Z - A)</option>
                <option value="price-asc">Giá (Thấp -> Cao)</option>
                <option value="price-desc">Giá (Cao -> Thấp)</option>
                <option value="view-asc">Lượt xem (Thấp -> Cao)</option>
                <option value="view-desc">Lượt xem (Cao -> Thấp)</option>';
            }
        }

        $listProductNews = Mproduct::where('status', 1)
        ->where('trash', 1)
        ->where('featured', 0)
        ->orderBy($value, $order)
        ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
        ->paginate(12);

        $listProductCount = Mproduct::where('status', 1)
        ->where('trash', 1)
        ->where('featured', 0)
        ->orderBy($value, $order)
        ->select('name', 'thumb', 'view', 'price', 'sale', 'slug', 'id', 'sku')
        ->count();

        if(isset($filter)) {
            return view('frontend.products.indexFilter', compact('listProductNews', 'catalogAccordion', 'select'));
        } else {
            return view('frontend.products.index', compact('listProductNews', 'catalogAccordion', 'select', 'listProductCount'));
        }
    }

    public function catalog($slug, $page = 1, Request $request)
    {
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });
        
        $row = Mcatalog::where('trash', 1)
        ->where('status', 1)
        ->where('slug', $slug)
        ->first();

        $listCat = Mcatalog::where('trash', 1)
        ->where('status', 1)
        ->where('parent_id', $row['id'])
        ->get();

        $listCatid[] = $row['id'];
        foreach ($listCat as $item) {
            $listCatid[] = $item['id'];
            $listCat = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('parent_id', $item['id'])
            ->get();
            foreach ($listCat as $item1) {
                $listCatid[] = $item1['id'];
            }
        }

        $mproduct = new Mproduct;
        $mcatalog = new Mcatalog;
        $catalogAccordion = $mcatalog->catalogAccordion();

        if ($row != null) {
            $catBreadCrumb1 = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('id', $row['parent_id'])
            ->select('name', 'parent_id', 'slug')
            ->first();
        } else {
            $catBreadCrumb1 = '';
        }

        if ($catBreadCrumb1 != null) {
            $catBreadCrumb2 = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('id', $catBreadCrumb1['parent_id'])
            ->select('name', 'parent_id', 'slug')
            ->first();
        } else {
            $catBreadCrumb2 = '';
        }

        if ($catBreadCrumb2 != null) {
            $catBreadCrumb3 = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('id', $catBreadCrumb2['parent_id'])
            ->select('name', 'parent_id', 'slug')
            ->first();
        } else {
            $catBreadCrumb3 = '';
        }

        $filter = $request->filter;
        $select = '';
        if (isset($filter)) {
            $where = $request->filter;
            $result = explode('-', $where);
            $value = $result[0];
            $order = $result[1];
            $getData = array(
                '0' => $value,
                '1' => $order
            );
            Session::put('productFilterCatalog', $getData);
        } else {
            if (Session::get('productFilterCatalog')) {
                $getData = Session::get('productFilterCatalog');
                $value = $getData[0];
                $order = $getData[1];
                $option = $value . '-' . $order;
                if ($option == 'created_at-desc') {
                    $select .= ' <option value="created_at-desc" selected>Mặc định</option>';
                } else {
                    $select .= ' <option value="created_at-desc">Mặc định</option>';
                }

                if ($option == 'created_at-asc') {
                    $select .= '  <option value="created_at-asc" selected>Sản phẩm cũ nhất</option>';
                } else {
                    $select .= '  <option value="created_at-asc">Sản phẩm cũ nhất</option>';
                }

                if ($option == 'name-asc') {
                    $select .= '<option value="name-asc" selected>Tên (A - Z)</option>';
                } else {
                    $select .= '  <option value="name-asc">Tên (A - Z)</option>';
                }

                if ($option == 'name-desc') {
                    $select .= '<option value="name-desc" selected>Tên (Z - A)</option>';
                } else {
                    $select .= '  <option value="name-desc">Tên (Z - A)</option>';
                }

                if ($option == 'price-asc') {
                    $select .= '<option value="price-asc" selected>Giá (Thấp -> Cao)</option>';
                } else {
                    $select .= '  <option value="price-asc">Giá (Thấp -> Cao)</option>';
                }

                if ($option == 'price-desc') {
                    $select .= '<option value="price-desc" selected>Giá (Cao -> Thấp)</option>';
                } else {
                    $select .= '  <option value="price-desc">Giá (Cao -> Thấp)</option>';
                }

                if ($option == 'view-desc') {
                    $select .= '<option value="view-desc" selected>Lượt xem (Thấp -> Cao)</option>';
                } else {
                    $select .= '  <option value="view-desc">Lượt xem (Thấp -> Cao)</option>';
                }

                if ($option == 'view-asc') {
                    $select .= '<option value="view-asc" selected>Lượt xem (Cao -> Thấp)</option>';
                } else {
                    $select .= '  <option value="view-asc">Lượt xem (Cao -> Thấp)</option>';
                }
            } else {
                $value = 'created_at';
                $order = 'desc';

                $select .= '<option value="created_at-desc" selected>Mặc định</option>
                <option value="created_at-asc">Sản phẩm cũ nhất</option>
                <option value="name-asc">Tên (A - Z)</option>
                <option value="name-desc">Tên (Z - A)</option>
                <option value="price-asc">Giá (Thấp -> Cao)</option>
                <option value="price-desc">Giá (Cao -> Thấp)</option>
                <option value="view-asc">Lượt xem (Thấp -> Cao)</option>
                <option value="view-desc">Lượt xem (Cao -> Thấp)</option>';
            }
        }

        $listProductByCat = $mproduct->productByCatalog($listCatid, $value, $order);
        $listProductByCatCount = $mproduct->productByCatalogCount($listCatid, $value, $order);

        if(isset($filter)) {
            return view('frontend.products.catalogFilter', compact('row', 'catalogAccordion', 'listProductByCat', 'catBreadCrumb1', 'catBreadCrumb2', 'catBreadCrumb3', 'select', 'listProductByCatCount'));
        } else {
            return view('frontend.products.catalog', compact('row', 'catalogAccordion', 'listProductByCat', 'catBreadCrumb1', 'catBreadCrumb2', 'catBreadCrumb3', 'select', 'listProductByCatCount'));
        }
    }

    public function detail($slug)
    {
        $row = Mproduct::where('trash', 1)
        ->where('status', 1)
        ->where('slug', $slug)
        ->first();

        $catName = Mcatalog::where('trash', 1)
        ->where('status', 1)
        ->where('id', $row['catid'])
        ->select('name', 'parent_id', 'slug')
        ->first();

        if ($catName != null) {
            $catBreadCrumb = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('id', $catName['parent_id'])
            ->select('name', 'parent_id', 'slug')
            ->first();
        } else {
            $catName = '';
        }

        if ($catBreadCrumb != null) {
            $catBreadCrumb1 = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('id', $catBreadCrumb['parent_id'])
            ->select('name', 'parent_id', 'slug')
            ->first();
        } else {
            $catBreadCrumb1 = '';
        }

        if ($catBreadCrumb1 != null) {
            $catBreadCrumb2 = Mcatalog::where('trash', 1)
            ->where('status', 1)
            ->where('id', $catBreadCrumb1['parent_id'])
            ->select('name', 'parent_id', 'slug')
            ->first();
        } else {
            $catBreadCrumb2 = '';
        }

        $producerName = Mproducer::where('status', 1)
        ->where('id', $row['producerid'])
        ->select('name')
        ->first();

        $brandName = Mbrand::where('status', 1)
        ->where('id', $row['brandid'])
        ->select('name')
        ->first();

        $thumbList = explode(',', $row['thumb_list']);

        $listProductRelated = Mproduct::where('trash', 1)
        ->where('status', 1)
        ->where('id', '!=', $row['id'])
        ->where('catid', '=', $row['catid'])
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

        $updateView = Mproduct::find($row['id']);
        $updateView->view = $updateView['view'] + 1;
        $updateView->save();

        return view('frontend.products.detail', compact('row', 'thumbList', 'listProductRelated', 'catName', 'producerName', 'brandName', 'catBreadCrumb', 'catBreadCrumb1', 'catBreadCrumb2'));
    }

    public function showComment(Request $request, $id)
    {
        if($request->ajax()) {
            $html = '';

            if(Session::has('userLogin')) {
                $listComment = Mcomment::where('productid', $id)
                ->join('user', 'user.id', '=', 'comment.userid')
                ->orderBy('commentDate', 'desc')
                ->select('user.created_at as userDate', 'comment.created_at as commentDate', 'user.*', 'comment.*')
                ->get();
                
                if (count($listComment)) {
                    $html .= '<div class="section__detail-comment-wrapper">';

                    foreach ($listComment as $item) {
                    $html .= '<div class="section__detail-comment-wrapper-body my-2">
                        <div class="d-flex">
                            <div class="section__detail-comment-wrapper-thumb" style="width: 7%">';

                            if($item['thumb'] == 'user.png') {
                                $html .= '   <img src="'.url('images/user.png').'" class="img-fluid" width="60px" height="60px" alt="User">';
                            } else {
                                $html .= '   <img src="'.url('uploads/user/'.$item['thumb']).'" class="img-fluid" width="60px" height="60px" alt="'.$item['fullname'].'" style="margin-top: 8px">';
                            }
                            $html .= '</div>

                            <div class="section__detail-comment-wrapper-content" style="width: 83%">
                                <div class="section__detail-comment-info d-flex align-items-center">
                                    <h2>'.$item['fullname'].'</h2>
                                    <div class="text-warning ml-3">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>

                                    <div class="section__detail-comment-info-reply ml-3 replyComment" data-id="'.$item['id'].'">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="section__detail-comment-date text-muted mt-1">
                                    '.$item['commentDate'].'
                                </div>

                                <div class="section__detail-comment-intro text-muted mt-1">
                                    '.$item['body'].'
                                </div>

                            </div>
                        </div>';

                        $listReply = Mreply::where('commentid', $item['id'])
                        ->join('user', 'user.id', '=', 'reply.userid')
                        ->join('comment', 'comment.id', '=', 'reply.commentid')
                        ->orderBy('replyDate', 'desc')
                        ->select('reply.created_at as replyDate', 'comment.created_at as commentDate', 'user.created_at as userDate', 'comment.id as commentId', 'comment.body as commentBody', 'reply.body as replyBody', 'reply.*', 'comment.*', 'user.*', 'comment.id as replyId')
                        ->get();

                        if (count($listReply)) {
                            $html .= '<div class="section__detail-comment-wrapper-reply my-3 ml-5">';
                            
                            foreach ($listReply as $row) {
                                $html .= '<div class="d-flex">
                                <div class="section__detail-comment-wrapper-thumb" style="width: 7%">';
                                    if($row['thumb'] == 'user.png') {
                                        $html .= '   <img src="'.url('images/user.png').'" class="img-fluid" width="60px" height="60px" alt="User">';
                                    } else {
                                        $html .= '   <img src="'.url('uploads/user/'.$item['thumb']).'" class="img-fluid" width="60px" height="60px" alt="'.$item['fullname'].'" style="margin-top: 8px">';
                                    }
                                $html .= '</div>

                                <div class="section__detail-comment-wrapper-content" style="width: 83%">
                                    <div class="section__detail-comment-info d-flex align-items-center">
                                        <h2>'.$row['fullname'].'</h2>
                                        <div class="text-warning ml-3">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>

                                        <div class="section__detail-comment-info-reply ml-3 replyComment" data-id="'.$row['replyId'].'">
                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    <div class="section__detail-comment-date text-muted mt-1">
                                        '.$row['replyDate'].'
                                    </div>

                                    <div class="section__detail-comment-intro text-muted mt-1">
                                        '.$row['replyBody'].'
                                    </div>

                                </div>
                            </div>';
                            }
                            $html .= '</div>';
                        }
                        $html .= '</div>';
                }
                $html .= '</div>';
                } else {
                    $html .= '<div class="section__detail-empty text-center">
                    <h2 class="text-capitalize text-danger">
                        Sản phẩm chưa có bình luận nào. Bạn hãy là người đầu tiên viết bình luận nào.
                    </h2>
                </div>';
                }
            } else {
                $html .= '<div class="section__detail-empty text-center">
                <h2 class="text-capitalize text-danger">
                    Bạn hãy đăng nhập để có thể xem bình luân về sản phẩm này nhé.
                </h2>
            </div>';
            }
            echo $html;
        }
    }

    public function showNameReply(Request $request)
    {
        if($request->ajax()) {
            $html = '';

            $getId = $request->id;
            $row = Mcomment::find($getId);

            $html .= '<div>
                <h3 class="text-capitalize"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Trả lời bình luận: '.$row['body'].'</h3>
            </div>
            <form action="'. route('userPostReply') .'" method="POST" id="postReplyForm">
                <input type="hidden" name="commentid" id="commentid" value="'.$row['id'].'">
                <div id="changeReply"></div>
                <div class="form-group">
                    <label class="text-capitalize">Nội dung đánh giá</label>
                    <textarea name="bodyReply" id="bodyReply" class="form-control" cols="30" rows="10" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="section__detail-comment-form-btn">
                        Trả lời
                    </button>
                </div>
            </form>
            ';
            echo $html;
        }
    }

    public function postComment(Request $request)
    {
        if($request->ajax()) {
            if (Session::has('userLogin')) {
                $userId = Session::get('userLogin.userId');
            }
            
            $mcomment = new Mcomment;
            $mcomment->body = $request->body;
            $mcomment->productid = $request->productid;
            $mcomment->userid = $userId;
            $mcomment->save();
        }
    }

    public function postReply(Request $request)
    {
        if($request->ajax()) {  
            if (Session::has('userLogin')) {
                $userId = Session::get('userLogin.userId');
            }
            
            $mreply = new Mreply;
            $mreply->body = $request->bodyReply;
            $mreply->commentid = $request->commentid;
            $mreply->userid = $userId;
            $mreply->save();
        }
    }
}
