<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private $user;
    private $account;

    public function __construct(User $user,Account $account)
    {
        $this->user = $user;
        $this->account = $account;
    }

    public function dashboard()
    {
        $user = auth()->user();
        $account = $user->account;
        return view('pages.dashboard', compact('user', 'account'));
    }

    /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $accounts = $this->account->oldest()->get();

            return view('pages.index', compact('accounts'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.add-account');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'balance' => 'required|min:1|max:50'
        ]);

        $this->account->balance = $request->balance;
        $this->account->user_id = Auth::id();

        $this->account->save();

        return redirect()->route('account.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $account = $user->accounts()->findOrFail($id);

        $accounts = $user->accounts;

        return view('pages.deposit', ['account' => $account, 'accounts' => $accounts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user();
        $account = $user->accounts()->findOrFail($id);

        $accounts = $user->accounts;

        return view('pages.withdrawal', ['account' => $account, 'accounts' => $accounts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $account = $this->account->findOrFail($id);

        $request->validate([
            'amount' => 'required|numeric|min:0'
        ]);

        $amount = $request->amount;

        if ($request->has('deposit')) {
            $account->balance += $amount;
        } elseif ($request->has('withdrawal')) {
            if ($account->balance < $amount) {
                return back()->withErrors(['amount' => 'Your current account balance is: $' . $account->balance]);
            }
            $account->balance -= $amount;
        }

        $account->save();

        return redirect()->route('account.index');
    }
}
