@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Navigasi Cepat</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('staff.items.index') }}" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="ni ni-box-2"></i> Kelola Barang
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('staff.suppliers.index') }}" class="btn btn-success btn-lg w-100 mb-3">
                                <i class="ni ni-delivery-fast"></i> Kelola Supplier
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
