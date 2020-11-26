<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UsersModel;
use App\PostsModel;
use App\CommentsModel;
use App\BannedPostsModel;
use DB;
use Auth;
use Session;
use Validator;

class UserController extends Controller
{
    public function login(){
        if(!empty(session('user')['userId'])){
            return redirect()->route('Products');
        }else{
            return view('login');
        }
    }

    public function loginUser(Request $req){
        //$user = LoginModel::checkLogin($req);
        if(!empty($req->all())) {            
            $user = UserModel::checkLogin($req->email);
            if(!empty($user[0])){
                // print_r($user);die();
                Session::put('user', ['userId'=>$user[0]->id, 'userName'=>$user[0]->clientName, 'userEmail'=>$user[0]->email, 'userEmail'=>$user[0]->mobile, 'userStatus'=>$user[0]->status]);
                Session::put('currency',1);
                
                return redirect()->route('Products');
            }else{
                return redirect()->back()->with('message', 'Invalid Credentials');
            }
        }
    }    

    public function signUp(){
        return view('signup');
    }

    public function dashboard(){
        return view('user.dashboard');
    }

    public function posts(){
        $thisUser = session('user')['userId'];
        $posts = DB::select(DB::raw("select posts.postId, posts.postTitle, u.username as postedBy, u.restrict_post_del, u.userId, 
        posts.createdDatetime as date from posts join users as u on posts.userId = u.userId 
        where posts.postId NOT IN (SELECT postId FROM banned_users_posts where userId = $thisUser) "));
        $postsArr = [];
        if(!empty($posts)){
            foreach($posts as $post){
                $count = CommentsModel::where(array('postId'=>$post->postId, 'status'=>'1'))->count();
                $post->commentcount = $count;
                $postsArr[] = $post;
            }
        }
        return view('user.posts', array('posts'=>$postsArr));
    }

    public function savePost(Request $req){
        if(!empty($req->all())){    
            $thisUserId = session('user')['userId']; 
            $post = new PostsModel;
            $post->postTitle = $req->postTitle;
            $post->postDesc = $req->postDesc;
            $post->userId = $thisUserId;
            $post->createdDateTime = date('Y-m-d H:i:s');
            if($post->save()){
                return redirect()->route('Posts')->with('success', 'Post created successfully');
            }else{
                return redirect()->route('Posts')->with('error', 'Oops! Something went wrong');
            }
        }
    }

    public function post(Request $req){
        if(!empty($req->postId)){
            $comment = 0;
            $delete = 0;
            $thisUser = session('user')['userId'];
            // print_r($req->postId);
            $postData = PostsModel::select('u.username', 'u.restrict_comments', 'u.restrict_post_del', 'posts.postTitle', 'posts.postDesc', 'posts.userId')
                                    ->join('users as u', 'posts.userId', '=', 'u.userId')
                                    ->where('postId', $req->postId)->get();
            $postComm = CommentsModel::select('comments.*', 'u.username', 'comments.createdDateTime')
                                    ->join('users as u', 'comments.userId', '=', 'u.userId')                        
                                    ->where(array('postId'=>$req->postId, 'status'=>'1'))
                                    ->orderBy('comments.commentId', 'DESC')
                                    ->get();
            if(!empty($postData)){
                if($thisUser == $postData[0]->userId){
                    $delete = 1;
                }else{
                    $comment = 1;
                }
                $postDataArr = [];
                foreach($postData as $post){
                    $userRestrict = UsersModel::select('restrict_comments', 'restrict_post_del')->where('userId', $thisUser)->get();
                    // echo '<pre>';print_r($userRestrict);die();
                    $post->restrict_comments = $userRestrict[0]['restrict_comments'];
                    $post->restrict_post_del = $userRestrict[0]['restrict_post_del'];
                    $postDataArr[] = $post;
                }
            }            
            // print_r($postDataArr);die();
            return view('user.post', array('postData'=>$postDataArr, 'postComm'=>$postComm, 'comment'=>$comment, 'delete'=>$delete));            
        }else{
            return redirect()->route('Posts');
        }
    }

    public function saveComment(Request $req){
        if(!empty($req->all())){
            // print_r($req->all());die();
            $thisUser = session('user')['userId'];
            $comment = new CommentsModel;
            $comment->postId = $req->postId;
            $comment->commentDesc = $req->commentVal;
            $comment->userId = $thisUser;
            $comment->createdDateTime = date('Y-m-d H:i:s');
            if($comment->save()){
                return redirect()->route('Posts')->with('success', "comment added successfully");
            }
        }else{
            return redirect()->route('Posts')->with('error', "Oops! Something went wrong");
        }
    }

    public function deleteComment(Request $req){
        if(!empty($req->commentId)){
            // print_r($req->commentId);die();
            $comment = CommentsModel::where('commentId', $req->commentId)->update(array('status'=>'0'));            
            if(!empty($comment)){
                echo "SUCCESS";
            }else{
                echo "ERROR";
            }
        }
    }

    public function deletePost(Request $req){
        if(!empty($req->postId)){
            // print_r($req->commentId);die();
            $post = PostsModel::where('postId', $req->postId)->update(array('status'=>'0'));            
            if(!empty($post)){
                echo "SUCCESS";
            }else{
                echo "ERROR";
            }
        }
    }
}
