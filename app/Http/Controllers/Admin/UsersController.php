<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\StoreUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Users = User::where('role', 0)->paginate(10);
        return view('Admin\user\index', compact('Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin\user\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        
        try {
            $user = new User;

            //$user = time() . $user->getClientOriginalName();

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->role = $request->role;

            $user->is_admin = $retVal = ($request->role==1) ? 1 : 0 ;

            $user->password = bcrypt($request->password);

            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->phone2 = $request->phone2;
            
            $user->save();
            toastr()->success('Data has been saved successfully!');
            return redirect()->route('index.users');
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin\user\show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin\user\edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->role = $request->role;

            $user->is_admin = $retVal = ($request->role==1) ? 1 : 0 ;

            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->phone2 = $request->phone2;

            $user->update();

            toastr()->success('Data has been updated successfully!');
            return redirect()->route('index.users');
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = user::findOrFail($id);

            $user->delete();

            toastr()->success('User Data has been Deleted successfully!');
            return redirect()->back();
        } catch (Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }
}
