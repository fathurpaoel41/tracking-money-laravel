@extends('layouts.main')

@section('title', 'Wallet')

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
                            Kamu hanya mempunyai maksimal 3 wallet
                            @if($countWallet < 3)
                                <a href="javascript:;" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal">Tambah Wallet</a>
                            @else
                                <button class="btn btn-sm btn-outline-primary" disabled>Tambah Wallet</button>
                            @endif
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
                              <form class="mb-3" action="{{ route('addWallet') }}" method="POST" id="walletForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="nameWallet" class="form-label">Name Wallet</label>
                                            <input type="text" id="nameWallet" class="form-control" placeholder="Enter Name Wallet" name="nama_dompet" />
                                            <div class="invalid-feedback" id="nama_dompet_error"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="descriptionWallet" class="form-label">Deskription Wallet</label>
                                            <textarea class="form-control" name="deskripsi_dompet" id="descriptionWallet" rows="3"></textarea>
                                            <div class="invalid-feedback" id="deskripsi_dompet_error"></div>
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
                <h6 class="pb-1 mb-4 text-muted">Dompet Anda</h6>
                <div class="row mb-5">
                  @foreach($dataWallet as $wallet)
                  <div class="col-md-6 col-lg-4 mb-3">
                      <div class="card">
                          <div class="card-body">
                              <h5 class="card-title">{{ $wallet->nama_dompet }}</h5>
                              <p class="card-text">
                                  {{ $wallet->deskripsi_dompet }}
                              </p>
                              <a href="{{ route('detailWallet', ['id' => $wallet->id_dompet]) }}" class="btn btn-primary btn-sm">Detail</a>
                          </div>
                      </div>
                  </div>
                  @endforeach
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
