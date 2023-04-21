<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.index');
    }

    public function profile()
    {
        return view('dashboard.admin.profile');
    }

    public function settings()
    {
        return view('dashboard.admin.settings');
    }

    public function updateinfo(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'favoritecolor'=>'required'
        ]);
        
        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $query = User::find(Auth::user()->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'favoriteColor'=>$request->favoritecolor,
            ]);
            
            if(!$query){
                return response()->json(['status'=>0,'msg'=>'Ada data yang salah']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Profile anda berhasil diubah']);
            }
        }
    }

    public function updatePicture(Request $request)
    {
        $path = 'users/images/'; // Tempat penyimpanan file gambar
        $file = $request->file('admin_image'); // Mengambil berdasarkan id input file datanya
        $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg'; // format gambar

        // Upload New Image
        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status'=>0,'msg'=>'Ada data yang salah, upload foto baru gagal.']);
        } else {
            // Get gambar lama
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

            if ($oldPicture != '') {
                if(File::exists(public_path($path.$oldPicture))){
                    File::delete(public_path($path.$oldPicture));
                }
            }
            
            // Update DB (Database tabelnya)
            $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

            if(!$upload){
                return response()->json(['status'=>0,'msg'=>'Ada data yang salah, gagal mengubah data picture di database.']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Foto profile anda berhasil diubah']);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'oldpassword'=>[
                'required', function($attribute, $value, $fail){
                    if(!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('Passsword saat ini salah'));
                    } 
                },
                'min:8',
                'max:30'
            ],
            'newpassword'=>'required|min:8|max:30',
            'cnewpassword'=>'required|same:newpassword'
        ],[
            'oldpassword.required'=>'Masukan password lama anda',
            'oldpassword.min'=>'Password lama minimal 8 karakter',
            'oldpassword.max'=>'Password lama maksimal 30 karakter',
            'newpassword.required'=>'Masukan password baru anda',
            'newpassword.min'=>'Password baru minimal 8 karakter',
            'newpassword.max'=>'Password baru maksimal 30 karakter',
            'cnewpassword.required'=>'Masukan kembali password baru anda',
            'cnewpassword.same'=>'Password baru kedua harus sama dengan password baru pertama'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $update = User::find(Auth::user()->id)->update(['password'=>Hash::make($request->newpassword)]);

            if(!$update){
                return response()->json(['status'=>0,'msg'=>'Ada data yang salah, Gagal untuk mengubah password']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Password anda berhasil diubah']);
            }
        }
    }
}
