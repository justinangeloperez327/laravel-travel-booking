<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
        public function index(Request $request)
    {
        $query = Payment::with('booking');
        if ($search = $request->input('search')) {
            $query->where('transaction_reference', 'like', "%$search%");
        }
        $payments = $query->orderByDesc('created_at')->paginate(15);

        return Inertia::render('payments/index', [
            'payments' => $payments,
            'filters' => [
                'search' => $search ?? null,
            ]
        ]);
    }

    public function show(Payment $payment)
    {
        $payment->load('booking');
        return Inertia::render('payments/show', [
            'payment' => $payment,
        ]);
    }

    public function create()
    {
        return Inertia::render('payments/create');
    }

    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->validated());
        return redirect()->route('payments.index')->with('success', 'Payment created!');
    }

    public function edit(Payment $payment)
    {
        return Inertia::render('payments/edit', [
            'payment' => $payment,
        ]);
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect()->route('payments.index')->with('success', 'Payment updated!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted!');
    }
}
