<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
            'room_id' => 'sometimes|required|exists:rooms,id',
            'tanggal' => 'sometimes|required|date',
            'jam_mulai' => 'sometimes|required|date_format:H:i',
            'jam_selesai' => 'sometimes|required|date_format:H:i|after:jam_mulai',
            'status' => 'sometimes|required|in:pending,approved,rejected,completed,cancelled',
            'keperluan' => 'nullable|string|max:500',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'catatan' => 'nullable|string',
        ];
    }
}
