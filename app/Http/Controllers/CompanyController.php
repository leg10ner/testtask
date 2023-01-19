<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);

        return view('company.index',
            compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['image', 'mimetypes:image/jpeg,image/png', 'dimensions:max_width=150,max_height=150'],
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $file->store('public/images/photo');

            $url = Storage::url('images/photo/'.$file->hashName());
        } else {
            $url = null;
        }

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $url,
            'address' => $request->address,
        ]);

        return redirect()->route('companies')->with('message', 'Company successfully create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail((int)$id);
        $employees = $company->employees()->paginate(10);

        $address = $company->address;

        if($address) {
            $ch = curl_init('https://geocode-maps.yandex.ru/1.x/?apikey='.env('yandex_apikey').'&format=json&geocode=' . urlencode($address));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($res, true);

            $coordinates = $res['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
            $coordinates = explode(' ', $coordinates);
            $coordinates = [$coordinates[1], $coordinates[0]];
            $coordinates = implode(', ', $coordinates);
        } else {
            $coordinates = null;
        }

        return view('company.show',
            compact('company', 'employees', 'coordinates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail((int)$id);

        return view('company.edit', compact('company'));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['image', 'mimetypes:image/jpeg,image/png', 'dimensions:max_width=150,max_height=150'],
        ]);

        $company = Company::findOrFail($id);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $file->store('public/images/photo');

            $url = Storage::url('images/photo/'.$file->hashName());
        } else {
            $url = $company->logo;
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->logo = $url;
        $company->address = $request->address;

        $company->save();

        return redirect()->route('company.show', $company->id)->with('message', 'Company successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail((int)$id)->delete();

        return redirect()->route('companies')->with('message', 'Company successfully delete');
    }
}
