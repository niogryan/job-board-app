<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobPostController extends Controller
{
    //
    public function home(){

        $data['jobs'] = JobPost::where('status','Approved')
                    ->orderBy('created_at', 'desc')
                    ->get();
        $response = Http::get('https://mrge-group-gmbh.jobs.personio.de/xml');
        $data['api_jobs'] = null;
        if ($response->ok()) {
            $data['api_jobs'] = json_decode(json_encode(simplexml_load_string($response->body(), "SimpleXMLElement", LIBXML_NOCDATA)),true);
            $data['api_jobs'] = (!empty($data['api_jobs']) ?  $data['api_jobs']['position'] : null);
            session()->put('api_jobs', $data['api_jobs']);
        } 
        return view('home',$data);
    }

    public function viewForm(){
        return view('viewform');
    }

    public function submitJobPost(Request $request){
        try{
            $input = $request->validate([
                'emailaddress'  => 'required|email',
                'title'         =>  'required',
                'description'   =>  'required',
                'location'      =>  'required',
            ]);


            $user = User::where('email',$input['emailaddress'])
                        ->first();

            if (!empty($user) && $user->ispost == 1){
                $job = new JobPost();
                $job->userid = $user->id;
                $job->title = $input['title'];
                $job->description = $input['description'];
                $job->location = $input['location'];
                $job->status = 'Approved';
                $job->save();

                if ($job->save()) {
                    return back()->with('success', 'Job post has been successfully saved.');
                } else {
                    return back()->with('error', 'Something went wrong. Please try again.');
                }
            }
            else if (!empty($user) && $user->ispost == 0){
                return back()->with('error', 'Your previous job post is currently awaiting admin approval. Kindly wait for confirmation.');
            }
            else{
                $newUserID = 0;
                $user = User::where('email',$input['emailaddress'])->first();
                
                if ($user){
                    $user->ispost = 0;
                    $user->save();
                    $newUserID = $user->id;
                }
                else{
                    $user = new User();
                    $user->email = $input['emailaddress'];
                    $user->ispost = 0;

                    if (!$user->save()) {
                        return back()->with('error', 'Something went wrong. Please try again.');
                    }

                   $newUserID = $user->id;
                }

                $job = new JobPost();
                $job->userid = $newUserID;
                $job->title = $input['title'];
                $job->description = $input['description'];
                $job->location = $input['location'];
                $job->status = 'Pending';
                $job->save();

                if ($job->save()) {
                    return back()->with('success', 'Job post has been successfully saved.');
                } else {
                    return back()->with('error', 'Something went wrong. Please try again.');
                }
            }
            return back()->with('success','Job successfully posted!');

        }
        catch(\Exception $e){
             return back()->withErrors([
                'formError' => 'High level error: ' . $e->getMessage(),
            ]);
        }
    }

    public function viewAdmin(){

         $data['pending'] = User::join('tbl_jobs','tbl_jobs.userid','=','users.id')
                    ->whereIn('ispost', [0,2])
                    ->where('status', 'Pending')
                    ->select('email','users.id','title', 'description','location','status','tbl_jobs.created_at')
                    ->get();
        return view('viewAdmin', $data);
    }

      public function approvePost($id){
           if (empty($id) || !is_numeric($id)){
                return back()->with('error','Something went wrong. Please try again.');
           }

           $user = User::find($id);
           if ($user){
                $user->ispost = 1;
                $user->save();
           }

           JobPost::where('userid', $id)
                    ->where('status', 'Pending')
                    ->update(['status' => 'Approved']);

            return back()->with('success','Job post has been successfully approved!');
      }

    public function spamPost($id){
        if (empty($id) || !is_numeric($id)){
            return back()->with('error','Something went wrong. Please try again.');
        }

        $user = User::find($id);
        if ($user){
            $user->ispost = 3;
            $user->save();
        }

        JobPost::where('userid', $id)
                ->update(['status' => 'Spam']);


        return back()->with('success','The job was flagged as spam successfully!');
    }

    public function viewFullDetails ($src, $id){
        $data['details'] =  null;
        $data['src'] = $src;
        if ($src == 'personio'){
            if (!session()->has('api_jobs')){
                return back()->with('error','Something went wrong. Please try again.');
            }
            $api_jobs = session()->get('api_jobs');
            foreach($api_jobs as $job){
                if ($id == $job['id']){
                    $data['details'] = $job;
                }
            }
        }
        else  if ($src == 'jobboard'){
           $data['details'] = JobPost::find($id);
        }
        else{
            return back()->with('error','Something went wrong. Please try again.');
        }

        return view('viewfulldetails', $data);
    }
}
