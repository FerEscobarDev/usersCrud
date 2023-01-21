<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Category;
use App\Events\UserStore;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::with('category')
                        ->filter()->paginate(10)
                        ->appends(request()->except('page'));

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Users/Create',[
            'categories' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric|integer|exists:categories,id',
            'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100|min:5',            
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100',
            'cedula' => 'required|numeric|integer|digits_between:6,30|unique:users',
            'country' => 'required|string',
            'address' => 'required|string|max:180',            
            'mobil' => 'required|numeric|integer|digits:10',
            'email' => 'required|string|email|max:150|unique:users',
        ]);

        $user = User::create($request->all());
        $email = 'admin@example.com';

        event(new UserStore($user, $email));

        return Redirect::route('user.edit', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        $categories = Category::all();
        return Inertia::render('Users/Edit',[
            'user' => UserResource::make($user),
            'categories' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100|min:5',            
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u|string|max:100|min:5',
            'cedula' => 'required|numeric|integer|digits_between:6,30|unique:users,cedula,'.$user->id,
            'country' => 'required|string',
            'address' => 'required|string|max:180',            
            'mobil' => 'required|numeric|integer|digits:10',
            'email' => 'required|string|email|max:150|unique:users,email,'.$user->id,
            'category_id' => 'required|exists:categories,id',
        ]);

        $user->update($request->all());

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::route('user.index');
    }
}
