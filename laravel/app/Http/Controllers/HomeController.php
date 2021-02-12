<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function uploadUserImage(Request $request) {
        $request -> validate([
            'image' => 'required|file'
        ]);

        $this-> deleteUserImage();
        $image = $request -> file('image');
        $ext = $image -> getClientOriginalExtension();
        $name = rand(100000, 9999999) . '_' . time();
        $destFile = $name . '.' . $ext;
        $file = $image -> storeAs('image', $destFile, 'public');

        $user = Auth::user();
        $user -> image = $destFile;

        $user -> save();

        return redirect()-> back();
    }

    public function clearUserImage(){

      $this-> deleteUserImage();


      $user = Auth::user();
      $user -> image = null;

      $user -> save();

      return redirect()-> back();



    }

    private function deleteUserImage(){

      $user = Auth::user();

      try {

        $imageNameDelete = $user -> image;

        $file = storage_path('app/public/image/' . $imageNameDelete);
        $rest = File::delete($file);

      } catch (\Exception $e) {

      }




    }
}
