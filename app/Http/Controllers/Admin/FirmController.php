<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Firm,
    FirmType
};
use Exception;
use Illuminate\Validation\Rule;

class FirmController extends Controller
{
    //========================= Firm Type Member Functions ========================//

    public function index()
    {
        try {
            return view('admin.firm.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function getall(Request $request)
    {
        try {
            $firms = Firm::with('firmType')->orderBy('id', 'desc')->get();
            return response()->json(['data' => $firms]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function create()
    {
        try {
            $firmTypes = FirmType::where('status', 'active')->orderBy('id', 'desc')->get();
            return view('admin.firm.create', compact('firmTypes'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
{
    $validatedData = [];

    try {
        // Validate the input
        $validatedData = $request->validate([
            'firmType' => [
                'required',
                'string',
                'max:255',
                Rule::unique('firms', 'firm_name')->ignore($request->frimid),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('firms', 'email')->ignore($request->frimid),
            ],
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('firms', 'phone')->ignore($request->frimid),
            ],
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required|string|max:10',
        ]);

        // Update or create the firm data
        Firm::updateOrCreate(
            ['id' => $request->frimid],
            [
                'firm_type' => $request->firmType,
                'firm_name' => $request->firm_name, // Assuming firmType is the same as firm_name
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
            ]
        );

        // Redirect to the index route with success message
        return redirect()->route('admin.firm.index')->with(
            'success',
            $request->frimid ? 'Firm Type updated successfully.' : 'Firm Type saved successfully.'
        );
    } catch (Exception $e) {
        // If validation fails or exception occurs, redirect back with errors and input
        return redirect()->back()->withErrors($e->getMessage())->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


    public function status(Request $request)
    {
        try {

            $firmid = $request->firmtypeid;
            $status = $request->status;
            $firm = Firm::find($firmid);

            if (!$firm) {
                throw new Exception('Firm not found.');
            }

            $firm->status = $status;
            $firm->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $firm = Firm::find($id);

            if (!$firm) {
                throw new Exception('Firm not found.');
            }

            $firm->delete();

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
        try {
            $firmTypes = FirmType::where('status', 'active')->orderBy('id', 'desc')->get();
            $firm = Firm::find($id);

            if (!$firm) {
                return redirect()->route('admin.firm.type.index')->with('error', 'Firm Type not found.');
            }

            return view('admin.firm.edit', compact('firmTypes', 'firm'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
