<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assetadmin/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assetadmin/img/favicon.png') }}">
  <title>
    Tambah Barang - Inventaris Barang
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assetadmin/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assetadmin/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assetadmin/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assetadmin/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @include('layouts.sidebar')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm"><a class="text-white" href="{{ route('admin.items.index') }}">Barang</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Tambah Barang Baru</h6>
        </nav>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Form Tambah Barang</h6>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name" class="form-control-label">Nama Barang <span class="text-danger">*</span></label>
                      <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required>
                      @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="category_id" class="form-control-label">Kategori <span class="text-danger">*</span></label>
                      <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="supplier_id" class="form-control-label">Supplier</label>
                      <select class="form-control @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                        <option value="">Pilih Supplier</option>
                        @foreach($suppliers as $supplier)
                          <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                      </select>
                      @error('supplier_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stock_quantity" class="form-control-label">Jumlah Stok <span class="text-danger">*</span></label>
                      <input class="form-control @error('stock_quantity') is-invalid @enderror" type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 1) }}" min="0" required>
                      @error('stock_quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="unit_price" class="form-control-label">Harga Satuan</label>
                      <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input class="form-control @error('unit_price') is-invalid @enderror" type="number" id="unit_price" name="unit_price" value="{{ old('unit_price') }}" min="0" step="0.01">
                      </div>
                      @error('unit_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="location" class="form-control-label">Lokasi</label>
                      <input class="form-control @error('location') is-invalid @enderror" type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Ruang Meeting, Lantai 2">
                      @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="condition" class="form-control-label">Kondisi <span class="text-danger">*</span></label>
                      <select class="form-control @error('condition') is-invalid @enderror" id="condition" name="condition" required>
                        <option value="">Pilih Kondisi</option>
                        <option value="baik" {{ old('condition') == 'baik' ? 'selected' : '' }}>Baik</option>
                        <option value="rusak" {{ old('condition') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="perlu_perbaikan" {{ old('condition') == 'perlu_perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                      </select>
                      @error('condition')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status" class="form-control-label">Status <span class="text-danger">*</span></label>
                      <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikeluarkan" {{ old('status') == 'dikeluarkan' ? 'selected' : '' }}>Dikeluarkan</option>
                      </select>
                      @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="purchase_date" class="form-control-label">Tanggal Pembelian</label>
                      <input class="form-control @error('purchase_date') is-invalid @enderror" type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}">
                      @error('purchase_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="warranty_expiry" class="form-control-label">Garansi Berakhir</label>
                      <input class="form-control @error('warranty_expiry') is-invalid @enderror" type="date" id="warranty_expiry" name="warranty_expiry" value="{{ old('warranty_expiry') }}">
                      @error('warranty_expiry')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="description" class="form-control-label">Deskripsi</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Deskripsikan barang ini...">{{ old('description') }}</textarea>
                  @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="image" class="form-control-label">Foto Barang</label>
                  <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept="image/*">
                  <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="d-flex justify-content-between">
                  <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-primary">Simpan Barang</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('assetadmin/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assetadmin/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assetadmin/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assetadmin/js/plugins/smooth-scrollbar.min.js') }}"></script>
</body>

</html>
