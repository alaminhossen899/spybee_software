<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class usermanagementController extends Controller
{
    public function useraddview(){
        $roles = DB::table('userroles')->get();
//        return view('user.index', ['users' => $users]);
        return view('adminPannel.usrmanagement.softwareuser',['roles'=>$roles]);
    }
    public function userlistview(){
        $users=DB::table('users')->orderBy('id', 'desc')->get();
        return view('adminPannel.usrmanagement.softwareuserlist',['users'=>$users]);
    }
    public function userroleview(){
        $roles = DB::table('userroles')->get();
        return view('adminPannel.usrmanagement.userrole',['roles'=>$roles]);
    }
    public function customeraddview(){
        return view('adminPannel.usrmanagement.addcustomer');
    }
    public function customerlist(){
        $customers = DB::table('customers')->get();
        return view('adminPannel.usrmanagement.viewcustomer',['customers'=>$customers]);
    }

    public function insertsofuser(Request $request){
       $insert=DB::table('users')->insert(
           [
               'name'=>$request->name,
               'email'=>$request->email,
               'role'=>$request->role,
               'id_no'=>$request->id_no,
               'phone'=>$request->phone,
               'password'=>bcrypt($request->password),
               'address'=>$request->address,
               'profile_image'=>$request->profile_image,

           ]
       );
       if ($insert){
           return response()->json("success");
       }
       else
           return response()->json("error");


    }

    public function insertrole(Request $request){
        $insert=DB::table('userroles')->insert(
            [
                'userrole'=>$request->userrole,

            ]
        );
        if ($insert){
            return response()->json("success");
        }
        else
            return response()->json("error");


    }
    
    public function insertcustomer(Request $request){
        $insert=DB::table('customers')->insert(
            [
                'customername'=>$request->customername,
                'customercompany'=>$request->customercompany,
                'customeremail'=>$request->customeremail,
                'customercontact'=>$request->customercontact,
                'customeraltcontact'=>$request->customeraltcontact,
                'phone'=>$request->phone,
                'phone1'=>$request->phone1,
                'customeraddress'=>$request->customeraddress,
                'profileimage'=>$request->profileimage,

            ]
        );
        if ($insert){
            return response()->json("success");
        }
        else
            return response()->json("error");
    }

    public function delete($id){
        $delete=DB::table('userroles')->where('id',$id)->delete();
        if ($delete){
            return response()->json("success");
        }
        else
            return response()->json("error");

    }

    public function indvidview($id){
        $users=DB::table('users')->where('id',$id)->first();
        return view('adminPannel.usrmanagement.individualsoftusrview',['users'=>$users]);
    }
    public function indvidedit($id){
        $roles = DB::table('userroles')->get();
        $users=DB::table('users')->where('id',$id)->first();
        return view('adminPannel.usrmanagement.updateuser',['users'=>$users],['roles'=>$roles]);
    }
    public function indvidupdate(Request $request){
        $id=$request->id;

        $update=DB::table('users')->where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'role'=>$request->role,
            'id_no'=>$request->id_no,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'profile_image'=>$request->profile_image,
        ]);
        if ($update){
            return response()->json("success");
        }
        else
            return response()->json("error");
}

public function deleteuser($id){

        $delete=DB::table('users')->where('id',$id)->delete();
    if ($delete){
        return response()->json("success");
    }
    else
        return response()->json("error");
}

public function useralllist(){
    $users=DB::table('users')->orderBy('id', 'desc')->get();
    return view('adminPannel.usrmanagement.softwareuserlist',['users'=>$users]);
}

public function customindividual($id){
    $customers=DB::table('customers')->where('id',$id)->first();
    return view('adminPannel.usrmanagement.individualcustomer',['customers'=>$customers]);
}

public function customerupdate(Request $request){
    $id=$request->id;

    $update=DB::table('customers')->where('id',$id)->update([
        'customername'=>$request->customername,
        'customercompany'=>$request->customercompany,
        'customeremail'=>$request->customeremail,
        'customercontact'=>$request->customercontact,
        'customeraltcontact'=>$request->customeraltcontact,
        'phone'=>$request->phone,
        'phone1'=>$request->phone1,
        'customeraddress'=>$request->customeraddress,

    ]);
    if ($update){
        return response()->json("success");
    }
    else
        return response()->json("error");

}

public function custupdview($id){
    $users=DB::table('customers')->where('id',$id)->first();
    return view('adminPannel.usrmanagement.updatecustomer',['customers'=>$users]);
}
public function deletecustomer($id){
    $delete=DB::table('customers')->where('id',$id)->delete();
    if ($delete){
        return response()->json("success");
    }
    else
        return response()->json("error");
}


}