<?php

namespace HR\Http\Controllers;

use HR\RejectReasons;
use Illuminate\Http\Request;

class RejectReasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = RejectReasons::paginate(20);

        return view('admin.reject_reasons.index',compact('reasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reject_reasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'reason' => 'required|string|max:256'
        ]);

        $reject_reason = new RejectReasons();

        $reject_reason->reason = $request['reason'];
        $reject_reason->created_by = auth()->user()->id;

        if($reject_reason->save())
            return redirect(route('reject_reasons.index'))->with('flash_message', 'دلیل رد با موفقیت افزوده شد.');

        return redirect()->back()->withErrors(['خطا در ذخیره اطلاعات']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \HR\RejectReasons  $rejectReasons
     * @return \Illuminate\Http\Response
     */
    public function show(RejectReasons $rejectReasons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HR\RejectReasons  $rejectReasons
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rejectReason = RejectReasons::find($id);
        return view('admin.reject_reasons.edit', compact('rejectReason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HR\RejectReasons  $rejectReasons
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'reason' => 'required|string|max:256'
        ]);
        $rejectReasons = RejectReasons::find($id);
        $rejectReasons->reason = $request['reason'];
        $rejectReasons->modified_by = auth()->user()->id;

        if($rejectReasons->save())
            return redirect(route('reject_reasons.index'))->with('flash_message', 'دلیل رد با موفقیت ویرایش شد.');

        return redirect()->back()->withErrors(['خطا در ذخیره اطلاعات']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HR\RejectReasons  $rejectReasons
     * @return \Illuminate\Http\Response
     */
    public function destroy($rejectReasons)
    {
        if(RejectReasons::find($rejectReasons)->delete())
            return redirect('reject_reasons.index')->with('flash_message', 'دلیل رد با موفقیت حذف شد.');

        return redirect()->back()->withErrors(['خطا در حذف اطلاعات']);
    }
}
