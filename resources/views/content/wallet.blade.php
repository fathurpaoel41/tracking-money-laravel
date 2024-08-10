@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- Start Row -->
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                  
                    <div class="d-flex align-items-end row">
                    @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                      <div class="col-sm-7">
                        <div class="card-body">
                       
                          <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                          <p class="mb-4">
                            Kamu hanya mempunyai maksimal 3 wallet <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#basicModal">Tambah Wallet</a>
                          </p>
                          <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Wallet</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <form class="mb-3" action="{{ route('addWallet') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Name Wallet</label>
                                        <input type="text" id="nameBasic" class="form-control @error('nama_dompet') is-invalid @enderror" placeholder="Enter Name Wallet" name="nama_dompet" value="{{ old('nama_dompet') }}" />
                                        @error('nama_dompet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Deskription Wallet</label>
                                        <textarea class="form-control @error('deskripsi_dompet') is-invalid @enderror" name="deskripsi_dompet" id="exampleFormControlTextarea1" rows="3">{{ old('deskripsi_dompet') }}</textarea>
                                        @error('deskripsi_dompet')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" type="submit">Add Wallet</button>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/icons/baru/wallet-icon.png"
                            height="140"
                            alt="View Badge User"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Row -->    
                </div>
              </div>
            </div>
    <!-- / Content -->
@endsection

@section('page-scripts')
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>
@endsection