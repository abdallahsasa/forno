<?php

namespace App\Http\Controllers\WebsiteProfile;

use App\Http\Controllers\Controller;
use App\Models\WebsiteProfile;
use Illuminate\Http\Request;

class WebsiteProfileController extends Controller
{
    public function __construct()
    {

        $this->index_view = 'dashboard.products.index';
        $this->create_view = 'dashboard.products.create';
        $this->show_view = 'dashboard.products.show';
        $this->edit_view = 'dashboard.products.edit';
        $this->edit_variation_view = 'dashboard.products.edit_variation';
        $this->index_route = 'dashboard.product.index';
        $this->create_route = 'product.create';
        $this->success_message = 'Thank You For Contacting Us Your ContactUs Has Received';
        $this->update_success_message = trans('admin.update_created_successfully');
        $this->error_message = "Your ContactUs Couldn't Be Send" ;
        $this->update_error_message = trans('admin.fail_while_update');
        $this->model_instance = WebsiteProfile::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=WebsiteProfile::all()->first();
        return view($this->index_view,compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = WebsiteProfile::all()->first();
        if (is_null($data)) {
            $validated_data = [
                'location' => 'location',
                'email' => 'email',
                'number' => 'number',
                'facebook' => 'facebook link',
                'instagram' => 'instagram link',
                'snapchat' => 'snapchat user name',
            ];

            $object = $this->model_instance::create($validated_data);
            $data=$object;
            return view('/dashboard.website_profile.index', compact('data'));
        }

        return view('/dashboard.website_profile.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $object= WebsiteProfile::all()->first();

        $validated_data = $request->validate([
            'location' => 'required|string|min:3|max:200',
            'email' => 'required|email',
            'number' => 'required',
            'facebook' => 'string|min:3|max:200',
            'instagram' => 'string|min:3|max:200',
            'snapchat' => 'string|min:3|max:200',
        ]);
        //dd($validated_data);
        $object->update($validated_data);

        return redirect()->back()->with('success', 'Data Have Been Updated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\WebsiteProfile $websiteProfile
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteProfile $websiteProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\WebsiteProfile $websiteProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(WebsiteProfile $websiteProfile)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\WebsiteProfile $websiteProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebsiteProfile $websiteProfile)
    {
        //
    }
}
