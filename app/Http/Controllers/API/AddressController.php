<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 10);

        if($id)
        {
            $address = Address::with(['user'])->find($id);

            if($address){
                return ResponseFormatter::success(
                    $address,
                    'Data alamat berhasil diambil'
                );
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data alamat tidak ada',
                    404
                );
            }
        }

        $address = Address::with(['user'])->where('user_id', Auth::user()->id);

        return ResponseFormatter::success(
            $address->paginate($limit),
            'Data list alamat berhasil diambil'
        );
    }

    public function addAddress(Request $request)
    {
        try{
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'kategori' => 'required',
                'provinsi' => 'required',
                'kota_kabupaten' => 'required',
                'kelurahan' => 'required',
                'kecamatan' => 'required',
                'detail_alamat' => 'required'
            ]);
            

            $address = Address::create([
                'user_id' => $request->user_id,
                'kategori' => $request->kategori,
                'provinsi' => $request->provinsi,
                'kota_kabupaten' => $request->kota_kabupaten,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'detail_alamat' => $request->detail_alamat
            ]);

            $address = Address::with(['user'])->find($address->id);


            return ResponseFormatter::success($address, 'Data alamat berhasil ditambahkan');

        } catch (Exception $error){
            return ResponseFormatter::error($error->getMessage(), 'Tidak berhasil menambahkan alamat');
        }
    }

    public function updateAddress(Request $request, $id)
    {

        $data = $request->all();

        $address = Address::findOrFail($id);
        $address->update($data);

        return ResponseFormatter::success($address, 'Address Updated');
    }

}
