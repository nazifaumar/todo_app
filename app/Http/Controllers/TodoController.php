<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function register(){
        return view('dashboard.register');
    }
     public function index()
    {
        return view('dashboard.login');
    }
    public function registerAccount(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email:dns',
            'username' => 'required|min:4|max:12',
            'password' => 'required|min:4',
            'name' => 'required|min:3',
        ]);

        // $request-> = value attribute name pada input
        // knp yg dikirim 5 data? karena table pada db todos membutuhkan 6 column input
        // salah satunya column 'done_time' yg tipenya nullable, karna nullable jd ga perlu dikirim nilai
        // 'user_id' untuk memberitahu data todo ini milik siapa, diambil melalui fitur auth
        // 'status' tipenya boolean, 0 = blm dikerjakan, 1 = sudah dikerjakan (todonya)
    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

        return redirect('/')->with('succes', 'Successfully added account, please login !');
    }
    
        public function Auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exists' => 'Username not available',
            'username.required' => 'username wajib diisi',
            'password.required' => 'password wajib diisi',
        ]);

        $user = $request->only('username', 'password');
        //auth
        if(Auth::attempt($user)){
            return redirect('/todo');
        }else {
            return redirect()->back()->with('error', 'Login failed, please check and try again');
        }

    }

    public function todo()
    {
           // ambil data dari table todos dengan model Todo
        // all() fungsinya untuk menambil semua data di table 
        //where()fungsinya
        $todos = Todo::where('user_id', '=', Auth::user()->id)->get();
        // kirim data yang sudah diambil ke file blade / ke file yang menampilkan halaman
        // kirim melalui compact ()
        // isi compact sesuaikan dengan nama variable 
        return view('dashboard.todo', compact('todos'));
    }

    public function create(){
        return view('dashboard.create');
    }

    public function home(){
        return view('dashboard.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    
    
     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);

        Todo::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/todo')->with('succesAdd', 'Successfully added todo !'); 
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo ,$id)
    {
        //
        $todo = Todo::where('id', $id)->first();
        //
        return view('dashboard.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */


    public function completed()
    {
        return view('dashboard.completed');

    }

    public function updateCompleted($id)
    {
        //cara data yang mau diubah status nya menjadi 'completed' dan column done_time
        Todo::where('id', $id)->update([
            'status'=>1,
            'done_time'=>\Carbon\Carbon::now(),
        ]);
        return redirect()->back()->with('done', 'Todo telah selesai di kerjakan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required|min:5',
        ]);

        Todo::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect('/todo')->with('successUpdate', 'Data todo berhasil diperbaharui!');
    }

    /**W
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect()->route('todo')->with('succes-delete', 'Berhasil menghapus');*/

        Todo::where('id', '=', $id)->delete();
        return redirect()->back()->with('delete', 'Berhasil menghapus data Todo!');
    }
} 