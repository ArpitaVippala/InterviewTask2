<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\BasicTrait;
use App\UsersModel;
use App\PostsModel;
use App\BannedPostsModel;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Session;
use Cache;

class AdminController extends Controller{
    
    use BasicTrait;

    public function createNew(){
        $emps = DB::table('employees')->get();
        return view('admin.createEmp', array('data'=>$emps));
    }

    public function createUserAjax(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());
            $res = Validator::make($req->all(), [
                'username' => ['required', 'string', 'max:255'],
                'emailId' => ['required', 'string', 'email', 'max:255'],
                'mobile'=>['required', 'numeric', 'digits:10'],
                'designation' =>['required'],
                'salary'=>['required', 'numeric']
            ]);
            // dd($res->errors());
            if($res->fails()){
                echo "ERROR1";
            }
            else{
                $empId = DB::table('employees')
                        ->insertGetId(['empName'=>$req->username, 'empEmail'=>$req->emailId, 'empMobile'=>$req->mobile,
                        'empDesg'=>$req->designation, 'empSalary'=>$req->salary, 'created_at'=>date('Y-m-d H:i:s')]) ;      
                if(!empty($empId)){
                    echo "SUCCESS";
                }else{
                    echo "ERROR";
                }                        
            }
        }
    }

    public function salary(){
        return view('admin.salary');
    }

    public function AdminDashboard(){
        $users = UsersModel::count();
        $posts = PostsModel::count();
        return view('admin.adminDashboard', array('posts'=>$posts, 'users'=>$users));
    }

    public function salaryCal(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());die();
            $salary = "10000";
            $workingDays = $req->workingDays;
            $absentDays = $req->absentDays;
            $lateDays = $req->lateDays;
            $earlyDays = $req->earlyDays;
            $calDays = ($workingDays>0)?$workingDays:0;

            if($calDays > 0){
                
                if($absentDays > 0){
                    $calDays = $calDays - $absentDays;
                }

                if($lateDays > 2){
                    $calDays = $calDays-1;
                }

                if($earlyDays >10){
                    $calDays = $calDays+1;
                }
            }else{
                $calDays =0;
            }
            $calSalary =  ($salary/31)* $calDays;
            $calSalary = number_format($calSalary, 2);
            echo json_encode(array('status'=>'success', 'calculatedSalary'=>$calSalary));          
        }
    }

    public function addUser(){
        $users = UsersModel::where('role', 'user')->get();
        return view('admin.addUser', array('users'=>$users));
    }

    public function saveUser(Request $req){
        if(!empty($req->all())){
            $user = new UsersModel();
            $user->username = $req->fullName;
            $user->emailId = $req->email;
            $user->pwd = $req->pwd;
            $user->mobile = $req->mobile;
            $user->role = 'user';
            $user->created_at = date('Y-m-d H:i:s');
            if($user->save()){
                $msg = "User created successfully";
                return redirect()->route('Users')->with(array('success'=>'User created successfully'));
            }else{
                $msg = "Oops! Something went wrong";
                return redirect()->route('Users')->with(array('error'=>'Oops! Something went wrong'));
            }   
        }
    }

    public function getUser(Request $req){
        if(!empty($req->userId)){
            $user = UsersModel::where('userId', $req->userId)->get();
            if(!empty($user)){
                echo $user;
            }else{
                echo "ERROR";
            }
        }else{
            echo "ERROR";
        }
    }

    public function updateUser(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());die();
            $data = array('username'=>$req->editfullName, 'emailId'=>$req->editemail, 'mobile'=>$req->editmobile, 'pwd'=>$req->editPwd, 'restrict_comments'=>$req->commentCond, 'restrict_post_del'=>$req->postRemove);
            $user = UsersModel::where('userId', $req->userid)->update($data);
            if(!empty($user)){
                return redirect()->route('Users')->with(array('success'=>'User created successfully'));
            }else{
                return redirect()->route('Users')->with(array('error'=>'Oops! Something went wrong'));
            }
        }
    }

    public function adminPosts(){
        $posts = PostsModel::select('posts.postId', 'posts.postTitle', 'u.username as postedBy', 'u.restrict_post_del', 'u.userId', 'posts.createdDatetime as date')
                ->join('users as u', 'posts.userId', '=', 'u.userId')
                ->where('posts.status', '1')
                ->orderBy('posts.postId', 'DESC')
                ->get();
        // print_r($posts);die();
        $comments = 'Need to fetch';
        return view('admin.posts', array('posts'=>$posts));
    }

    public function getPost(Request $req){
        if(!empty($req->all())){
            $optionStr = '';
            $dataObj = [];
            $post = PostsModel::where('postId', $req->postId)->get();
            if(!empty($post)){
                $users = UsersModel::where('role', 'user')->get();
                $dataObj['post'] = $post;
                if(!empty($users)){
                    foreach($users as $user){
                        $optionStr .= "<option value=$user->userId>$user->username</option>";
                    }
                    $dataObj['optionStr'] = $optionStr;
                }
                echo json_encode($dataObj);
            }else{
                echo "ERROR";
            }
        }else{
            echo "ERROR";
        }
    }

    public function saveBannedPost(Request $req){
        // print_r($req->all());
        if(!empty($req->all())){
            if(!empty($req->usersList)){
                foreach($req->usersList as $user){
                    $save = false;
                    $banPost = new BannedPostsModel;
                    $banPost->userId = $user;
                    $banPost->postId = $req->postId;
                    $banPost->status = '1';
                    $banPost->createdDateTime = date('Y-m-d H:i:s');
                    if($banPost->save()){
                        $save = true;
                    }
                }
                if($save){
                    return redirect()->route('AdminPosts')->with('success', 'settings updated successfully');
                }else{
                    return redirect()->route('AdminPosts')->with('error', 'OOPS! Something went wrong');
                }
            }else{
                return redirect()->route('AdminPosts')->with('error', 'OOPS! Something went wrong');
            }
        }else{
            return redirect()->route('AdminPosts')->with('error', 'OOPS! Something went wrong');
        }
    }

    public function logout(Request $req){
        Auth::logout();
        Session::flush();
        cache::flush();
        return redirect()->route('Login');
    }
}
