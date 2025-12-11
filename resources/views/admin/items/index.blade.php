<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assetadmin/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assetadmin/img/favicon.png') }}">
  <title>
    Manajemen Barang - Inventaris Barang
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Barang</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Manajemen Barang</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Cari barang...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="{{ route('admin.items.create') }}" class="btn btn-white btn-sm me-3">
                <i class="fas fa-plus me-2"></i>Tambah Barang
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h6>Daftar Barang Kantor</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stok</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kondisi</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($items as $item)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          @if($item->image)
                          <div>
                            <img src="{{ asset('storage/' . $item->image) }}" class="avatar avatar-sm me-3" alt="{{ $item->name }}">
                          </div>
                          @else
                          <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                            <i class="ni ni-box-2 text-white opacity-10"></i>
                          </div>
                          @endif
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ Str::limit($item->description, 50) }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $item->category->name ?? 'N/A' }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-{{ $item->stock_quantity > 10 ? 'success' : ($item->stock_quantity > 0 ? 'warning' : 'danger') }}">
                          {{ $item->stock_quantity }}
                        </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-{{ $item->condition === 'baik' ? 'success' : ($item->condition === 'rusak' ? 'danger' : 'warning') }}">
                          {{ ucfirst(str_replace('_', ' ', $item->condition)) }}
                        </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-{{ $item->status === 'tersedia' ? 'success' : ($item->status === 'dipinjam' ? 'info' : 'secondary') }}">
                          {{ ucfirst($item->status) }}
                        </span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $item->location ?? 'N/A' }}</span>
                      </td>
                      <td class="align-middle">
                        <div class="dropdown">
                          <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                            <li><a class="dropdown-item" href="{{ route('admin.items.show', $item) }}">Lihat Detail</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.items.edit', $item) }}">Edit</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                              <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                              </form>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                          <i class="ni ni-box-2 text-secondary mb-3" style="font-size: 3rem;"></i>
                          <h6 class="text-secondary">Belum ada barang</h6>
                          <p class="text-xs text-secondary mb-3">Mulai tambahkan barang kantor Anda</p>
                          <a href="{{ route('admin.items.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-2"></i>Tambah Barang Pertama
                          </a>
                        </div>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <div class="text-sm text-muted">
                Menampilkan {{ $items->firstItem() ?? 0 }} sampai {{ $items->lastItem() ?? 0 }} dari {{ $items->total() }} barang
              </div>
              {{ $items->links() }}
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
  <script src="{{ asset('assetadmin/js/plugins/chartjs.min.js') }}"></script>
</body>

</html>
