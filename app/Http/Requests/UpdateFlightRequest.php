<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:255',
            'origin_id' => 'required|integer|exists:locations,id',
            'destination_id' => 'required|integer|exists:locations,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'base_price' => 'required|numeric|min:0',
            'seats_available' => 'required|integer|min:0',
        ];
    }
}
