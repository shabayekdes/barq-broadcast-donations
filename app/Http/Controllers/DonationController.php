<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('donation.index')->with('donates', $donates->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $donate = new Donation();

        return view('donation.create', compact('donate'));

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
        Donation::create($request->all());

        return redirect('donations');
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
                            ->get();
        

        return view('donation.unread')->with('donates', $donates);
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Donation  $donate
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        if($donation->read){
            return redirect()->back()->withErrors(['can not update this record because it is read']);
        }

        return view('donation.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Donation  $donate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        if($donation->read){
            return redirect()->back()->withErrors(['can not update this record because it is read']);
        }

        $this->validateRequest($request);
        $donation->update($request->all());

        return redirect('donations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Donation  $donate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        if($donation->read){
            return redirect()->back()->withErrors(['can not update this record because it is read']);
        }
        $donation->delete();
        return response()->json(['status' => true, 'message' => 'Amount deleted successfully!!']);

    }

    private function validateRequest($request)
    {
        return $this->validate($request, [
            'amount' => 'required|integer',
        ]);
    }
}
