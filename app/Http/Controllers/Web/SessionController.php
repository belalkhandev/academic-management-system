<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\SessionStoreFormRequest;
use App\Http\Requests\SessionUpdateFormRequest;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Class SessionController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Session',
            'page_header' => 'Session List',
            'sessions' => Session::get(),
        ];

        return view('dashboard.session.index')->with(array_merge($this->data, $data));
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create Session',
            'page_header' => 'Create Session'
        ];

        return view('dashboard.session.create')->with(array_merge($this->data, $data));
    }

    public function store(SessionStoreFormRequest $request)
    {
        $session = new Session();
        $session->name = $request->get('name');
        $session->status = $request->get('status');
        
        if ($session->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Session Created Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Create Session'
        ]);
    }

    public function edit(Session $session, $id)
    {
        $data = [
            'page_title' => 'Update Session',
            'page_header' => 'Update Session',
            'Session' => $session->findOrFail($id)
        ];

        return view('dashboard.Session.edit')->with(array_merge($this->data, $data));
    }

    public function update(SessionUpdateFormRequest $request, $id)
    {
        $session = Session::findOrFail($id);
        $session->name = $request->get('name');
        $session->status = $request->get('status');

        if ($session->save()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Updated!',
                'message' => 'Session Updated Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Update Session'
        ]);
    }

    public function destroy(Session $session, $id)
    {
        if (!Auth::user()->canDo(['manage_admin'])) {
            abort(401, 'Unauthorized Access.');
        }

        $session = $session->findOrFail($id);

        if ($session->delete()) {
            return response()->json([
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Session Deleted Successfully'
            ]);
        }

        return response()->json([
            'type' => 'error',
            'title' => 'Failed!',
            'message' => 'Failed to Delete Session'
        ]);
    }
}
