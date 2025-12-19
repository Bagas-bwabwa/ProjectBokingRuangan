@extends('layouts.admin')

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <h3 class="mb-0">Detail Kategori: {{ $category->nama_kategori }}</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama Kategori</dt>
                        <dd class="col-sm-9">{{ $category->nama_kategori }}</dd>
                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">{{ $category->deskripsi ?? '-' }}</dd>
                        <dt class="col-sm-3">Jumlah Ruangan</dt>
                        <dd class="col-sm-9">{{ $category->rooms->count() }}</dd>
                    </dl>
                    <div class="mt-4">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

