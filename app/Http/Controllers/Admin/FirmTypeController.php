<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    FirmType,
};
use Mail,Hash,File,Auth,DB,Helper,Exception,Session,Redirect,Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class FirmTypeController extends Controller
{
    //========================= Firm Type Member Funcations ========================//

    public function index() {
        return view('admin.firm_type.index');
    }

    public function getall(Request $request) {
        $firmType = FirmType::orderBy('id', 'desc')->get();

        return response()->json([
            'draw' => 1,
            'recordsTotal' => $firmType->count(),
            'recordsFiltered' => $firmType->count(),
            'data' => $firmType
        ]);
    }

    public function create() {
        return view('admin.firm_type.create');
    }

    public function store(Request $request) {
        // Validate the request with unique check
        $validatedData = $request->validate([
            'firmType' => [
                'required',
                'string',
                'max:255',
                Rule::unique('firm_types', 'name')->ignore($request->fitmtypeid), // Ensure uniqueness, ignoring current ID
            ],
        ]);

        // Use updateOrCreate to handle both create and update
        FirmType::updateOrCreate(
            ['id' => $request->fitmtypeid], // Condition for update
            ['name' => $request->firmType]   // Data to update or create
        );

        return redirect()->route('admin.firm.type.index')->with('success',
            $request->fitmtypeid ? 'Firm Type updated successfully.' : 'Firm Type saved successfully.'
        );
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
