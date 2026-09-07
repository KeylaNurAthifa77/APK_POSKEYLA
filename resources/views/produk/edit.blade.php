@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <h3 class="fw-bold mb-4">Edit Produk</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Terjadi kesalahan input:
                            </strong>

                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert">
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('produk.update', $produk->id) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        @include('produk._form')

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection