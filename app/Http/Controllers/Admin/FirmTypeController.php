<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    FirmType,
};
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect,Validator;
use Carbon\Carbon;

class FirmTypeController extends Controller
{
    //========================= Firm Type Member Funcations ========================//

    public function index() {
        return view('admin.firm_type.index');
    }

    public function getall(Request $request) {
        $firmType = FirmType::orderBy('id', 'desc')->get();
        return response()->json(['data' => $firmType]);
    }

    public function create() {
        return view('admin.firm_type.create');
    }

    public function store(Request $request) {
        // Validate the request
        $validatedData = $request->validate([
            'firmType' => 'required|string|max:255' . ($request->firmtypeid ? '' : '|unique:firm_types,name'),
        ]);

        if ($request->firmtypeid) {
            // Update existing FirmType
            $firmType = FirmType::find($request->firmtypeid);
            if ($firmType) {
                $firmType->name = $request->firmType;
                $firmType->save();
                return redirect()->route('admin.firm.type.index')->with('success', 'Firm Type updated successfully.');
            }
            return redirect()->route('admin.firm.type.index')->with('error', 'Firm Type not found.');
        } else {
            // Create new FirmType
            FirmType::create([
                'name' => $request->firmType,
            ]);
            return redirect()->route('admin.firm.type.index')->with('success', 'Firm Type saved successfully.');
        }
    }


    public function status(Request $request) {
        try
        {
            $firmtypeid = $request->firmtypeid;
            $status = $request->status;
            $Firmtype = FirmType::find($firmtypeid);
            $Firmtype->status = $status;
            $Firmtype->save();
            return response()->json(['success' => true]);

        }catch(Exception $e){
            return response()->json(['success' => false,'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            FirmType::where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Firm Type deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $firmType = FirmType::find($id);

        if(!$firmType){
            return redirect()->route('admin.firm.type.index')->with('error', 'Firm Type not found.');
        }
        return view('admin.firm_type.edit', compact('firmType'));
    }
}
