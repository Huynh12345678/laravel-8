<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Mcontact;
use App\Mail\ContactEmail;

class ContactController extends Controller
{
    public function index()
    {
        $list = Mcontact::orderBy('created_at', 'desc')
        ->get();

        $no = 1;

        return view('backend.contact.index', compact('list', 'no'));
    }

    public function detail($id)
    {
        $row = Mcontact::find($id);
        if (!$row) {
            return view('error');
        }

        return view('backend.contact.detail', compact('row'));
    }

    public function postDetail(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'reply' => 'required',
            ],
            [
                'reply.required' => 'Trả lời liên hệ không được bỏ trống.',
            ]
        );
        $row = Mcontact::find($id);
        $reply = $request->reply;
        Mail::to($row['email'])->send(new ContactEmail($row, $reply));
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $mcontact = new Mcontact;
        $mcontact = $mcontact->find($id);
        $row =  $mcontact->find($id);
        if(!$row) {
            return view('error');
        }

        $mcontact->delete();
        $request->session()->flash('success', 'Liên hệ của khách hàng ' . $row['name'] . ' đã được xóa vĩnh viễn.');
        return redirect()->route('adminContact');
    }
}
