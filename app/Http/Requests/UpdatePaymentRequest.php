<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => 'required|exists:bookings,id',
            'payment_gateway' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:initiated,paid,failed',
            'transaction_reference' => 'nullable|string|max:255',
            'paid_at' => 'nullable|date',
        ];
    }
}
