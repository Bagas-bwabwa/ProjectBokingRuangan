<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'nama_ruangan' => 'required|string|max:255',
            'jumlah_ruangan' => 'required|integer|min:1',
            'kapasitas' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:tersedia,tidak_tersedia,maintenance',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
        ];
    }
}
