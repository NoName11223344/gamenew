<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::orderBy('id', "DESC")->paginate(10);

        return view('admin.promotion.list')->with([
            'promotions' => $promotions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotion.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')){
            $file = $request->file('image');
            $randomize = rand(111111, 999999);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomize . '.' . $extension;
            $file->move(public_path('uploads'), $filename);

        }
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'descripiton' => $request->descripiton,
            'image' => public_path('uploads').'/'.$filename,
            'status' => 1,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'rate' => $request->rate,
            'created_at' => new \DateTime(),
        ];

        Promotion::insert($data);

        return redirect(route('promotion.index'))->with(['success', "Thêm mới thành công"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->file('image')){
            $file = $request->file('image');
            $randomize = rand(111111, 999999);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = $randomize . '.' . $extension;
            $file->move(public_path('uploads'), $filename);

        }
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'descripiton' => $request->descripiton,
            'image' => public_path('uploads').'/'.$filename,
            'status' => 1,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'rate' => $request->rate,
        ];

        Promotion::where('id', $id)->update($data);

        return redirect(route('promotion.index'))->with(['success', "Cập nhật thành công"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->destroy($id);
        return redirect(route('promotion.index'))->with(['success', "Cập nhật thành công"]);
    }
}
