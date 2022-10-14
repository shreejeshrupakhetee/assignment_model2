<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends BackendBaseController
{
    protected $route ='user.';
    protected $panel ='User';
    protected $view ='backend.user.';
    protected $title;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->title= 'List';
        $data['row']=User::all();
//        return view('backend.post.index',compact('data'));

        return view($this->__loadDataToView($this->view . 'index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  $this->title= 'Create';
        return view($this->__loadDataToView($this->view . 'create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
//        dd('hi');
        $data['row']=User::create($request->all());
        if ($data['row']){
            request()->session()->flash('success',$this->panel . 'Created Successfully');
        }else{
            request()->session()->flash('error',$this->panel . 'Creation Failed');
        }
//        return redirect()->route('category.index',compact('data'));
        return redirect()->route($this->__loadDataToView($this->route . 'index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->title= 'View';
        $data['row']=User::findOrFail($id);
        $studentData= User::find(1);
        $subjects= Comment::orderBy('comment', 'asc')->get();
        return view($this->__loadDataToView($this->view . 'view'),compact('data','studentData', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { $this->title= 'Edit';
        $data['row']=User::findOrFail($id);
        return view($this->__loadDataToView($this->view . 'edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $data['row'] =User::findOrFail($id);
        if(!$data ['row']){
            request()->session()->flash('error','Invalid Request');
            return redirect()->route($this->__loadDataToView($this->route . 'index'));
        }
        if ($data['row']->update($request->all())) {
            $request->session()->flash('success', $this->panel .' Update Successfully');
        } else {
            $request->session()->flash('error', $this->panel .' Update failed');

        }
        return redirect()->route($this->__loadDataToView($this->route . 'index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::findorfail($id)->delete();
        return redirect()->route($this->__loadDataToView($this->route . 'index'))->with('success','Data Deleted Successfully');
    }

//    public function check_slug(Request $request)
//    {
//        $slug = str_slug($request->name);
//        return response()->json(['slug' => $slug]);
//    }
    public function recycle()
    {
        $this->title= 'Recycle';
        $data['row']=User::onlyTrashed()->get();


        return view($this->__loadDataToView($this->view . 'recycle'),compact('data'));
    }

    public function restore($id){
        $data['row'] =User:: where('id',$id)->withTrashed()->first();

        if ($data['row']->restore()){
            request()->session()->flash('success', $this->panel.' restored successfully');
        } else{
            request()->session()->flash('error', $this->panel.' restore failed');
        }
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $data['row']= User:: where('id',$id)->withTrashed()->first();
        if ($data['row']->forceDelete()){
            request()->session()->flash('success', $this->panel.' Delete successfully');
        } else{
            request()->session()->flash('error', $this->panel.' Delete failed');
        }
        return redirect()->route($this->__loadDataToView($this->route . 'index'))->with('success','Data Deleted Successfully');
    }
    public function book_event(Request $request, User $user, Event $event)
    {
        $note = '';
        if($request->note){
            $note = $request->note;
        }
        if($user->events()->save($event, array('note' => $note))){
            return response()->json(['message'=>'User Event Created','data'=>$event],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);
    }

}
