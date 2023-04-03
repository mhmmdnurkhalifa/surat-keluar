<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MailRequest;
use App\Models\Mail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MailController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Mail::with(['user'])->where('users_id', Auth::user()->id);

            return DataTables::of($query)
                ->addcolumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdwon">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown" style="font-size: 14px">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="font-size: 14px">
                                    <a href="' . route('mail-edit', $item->id) . '" class="dropdown-item">
                                        Edit
                                    </a>
                                    <form action="' . route('mail.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button class="dropdown-item text-danger" type="submit" >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('out_date', function ($item) {
                    return $item->out_date;
                })
                ->editColumn('file', function ($item) {
                    return $item->file ? '<a href="' . asset('file/' . $item->file) . '"><img src="' . url('images/download-mail.png') . '" style="max-height:30px;"/></a>' : '';
                })
                ->rawColumns(['action', 'file'])
                ->make();
        }

        return view('pages.user.mail.index');
    }
    public function create()
    {

        $mails = Mail::all();
        return view('pages.user.mail.create', [
            'mails' => $mails
        ]);
    }

    public function store(MailRequest $request)
    {
        $file = $request->file('file');
        $fileName =  $request->title . '.' . $request->file('file')->getClientOriginalExtension();
        $file->move('file/', $fileName);

        $data = $request->all();
        $data['file'] = $fileName;

        Mail::create($data);
        return redirect()->route('mail');
    }

    public function edit($id)
    {

        $mails = Mail::findOrFail($id);
        return view('pages.user.mail.edit', [
            'mails' => $mails
        ]);

    }

    public function update(MailRequest $request, $id)
    {
        $file_hidden = $request->file_hidden;
        $file = $request->file('file');
        if ($request->file('file')) {
            $file_hidden =  $request->title . '.' . $request->file('file')->getClientOriginalExtension();
            $file->move('file/', $file_hidden);
        }
        $data = $request->all();
        $data['file'] = $file_hidden;

        $item = Mail::findOrFail($id);
        $item->update($data);
        return redirect()->route('mail');
    }
    public function destroy($id)
    {
        $item = Mail::findOrFail($id);
        $item->delete();
        return redirect()->route('mail');
    }
}
