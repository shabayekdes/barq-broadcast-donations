<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Donation;
use Carbon\Carbon;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donates = Donation::where('created_at', '<=', Carbon::now()->subMinutes(1)->toDateTimeString());
        
        $donates->update([
            'read' => true
        ]);
        return response()->json(['status' => true, 'total_amount' => $donates->sum('amount')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $donate = Donation::create($request->all());

        return response()->json(['status' => true, 'message' => 'Amount added successfully!!']);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unread()
    {
        $donates = Donation::where('read', 0)
                            ->where('created_at', '<=', Carbon::now()->subMinutes(1)->toDateTimeString())
                            ->sum('amount');
        

        return response()->json(['status' => true, 'total_amount' => $donates]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Donation  $donate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donate)
    {
        if($donate->read){
            return response()->json(['status' => false, 'message' => 'can not update this record because it is read'], 404);
        }
        $this->validateRequest($request);
        $donate->update($request->all());

        return response()->json(['status' => true, 'message' => 'Amount updated successfully!!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Donation  $donate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donate)
    {
        if($donate->read){
            return response()->json(['status' => false, 'message' => 'can not update this record because it is read'], 404);
        }

        $donate->delete();

        return response()->json(['status' => true, 'message' => 'Amount deleted successfully!!']);

    }

    private function validateRequest($request)
    {
        return $this->validate($request, [
            'amount' => 'required|integer',
        ]);
    }
}
