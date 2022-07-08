<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Comment;
use App\Models\Reply;
use App\Notifications\SmsNotification;

class ProposalController extends Controller
{
    public function storeProposal(Request $request) {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $string = str_shuffle($pin);

        $request->validate([
            'subject' => 'required',
            'status' => 'required',
            'team' => 'required',
            'organized_by' => 'required',
            'mobile' => 'required|min:10',
            'data_time' => 'required',
            'entered_by' => 'required',
        ]);

        $proposal = new Proposal;

        $proposal->reference_number=$string;
        $proposal->subject=$request->subject;
        $proposal->status=$request->status;
        $proposal->team=$request->team;
        $proposal->organized_by=$request->organized_by;
        $proposal->mobile=$request->mobile;
        $proposal->entered_date_time=$request->data_time;
        $proposal->entered_by=$request->entered_by;
        $proposal->save();

        return back()->with('msg', 'The proposal was successfully added.');
    }


    public function viewProposals(Request $request) {
        $data=Proposal::all();
        return view('dashboard.user.manage-proposals')->with('viewProposals',$data);
    }

    public function deleteProposal($id){
        DB::table('proposals')->where('id',$id)->delete();
        return back()->with('message', 'The proposal was successfully deleted.');
    }

    public function editProposal($id){
        $data = DB::table('proposals')->where('id',$id)->first();
        return view('dashboard.user.edit-proposal', compact('data'));
    }

    public function updateProposal(Request $request){

        $request->validate([
            'subject' => 'required',
            'status' => 'required',
            'team' => 'required',
            'organized_by' => 'required',
            'mobile' => 'required|min:10',
            'data_time' => 'required',
            'entered_by' => 'required',
        ]);

        DB::table('proposals')->where('id', $request->id)->update([
            'subject'=>$request->subject,
            'status'=>$request->status,
            'team'=>$request->team,
            'organized_by'=>$request->organized_by,
            'mobile'=>$request->mobile,
            'entered_date_time'=>$request->data_time,
            'entered_by'=>$request->entered_by,
        ]);
        return redirect()->to('/user/manage-proposals')->with('msg', 'The proposal was successfully updated.');
    }

    public function addComments($proposal_id){

        $data=Proposal::all()->where('id', '=', $proposal_id);
        $comment=Comment::all()->where('proposal_id', '=', $proposal_id);
        $reply=Reply::all()->where('proposal_id', '=', $proposal_id);
        // $reply=Reply::join('comments','comments.c_id','=','replies.comment_id')
        //             ->select('replies.name',
        //                     'replies.reply',
        //                     'replies.user_id',
        //                     'replies.proposal_id',
        //                     'replies.comment_id',
        //                     'replies.id',
        //                     'comments.c_id')
        //                     ->where('replies.proposal_id', '=', $proposal_id)
        //                     ->where('replies.comment_id', '=', 'comments.c_id')
        //                     ->get();

        return view('dashboard.user.add-comments')->with('data',$data)->with('comment',$comment)->with('reply',$reply);


    }

    public function add_comment(Request $request){
        $comment = new Comment;

        $comment->name=$request->user_name;
        $comment->user_id=$request->user_id;
        $comment->comment=$request->comment;
        $comment->proposal_id=$request->proposal_id;

        $comment->save();
        return redirect()->back();
    }

    public function add_reply(Request $request){
        $reply = new Reply;

        $reply->name=$request->user_name;
        $reply->comment_id=$request->commentID;
        $reply->reply=$request->reply;
        $reply->user_id=$request->user_id;
        $reply->proposal_id=$request->proposal_id;

        $reply->save();
        return redirect()->back();
    }

}

