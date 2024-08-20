@extends('layouts.main')

@section('title', 'Category Input')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Category Input Card -->
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
                                <h5 class="card-title text-primary">Category Input</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                    Add Category
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Data Table Card -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Category List</h5>
                    </div>
                    <div class="card-body">
                        <div id="loadingSpinner" class="text-center" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div id="categoryTable"></div>
                        <div id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addCategoryInput') }}" method="POST" id="addCategoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Nama Pemasukan</label>
                            <input type="text" class="form-control" id="nameInput" name="nama_pemasukan">
                            <div class="invalid-feedback" id="nama_pemasukan_error"></div>
                        </div>
                        <div class="col mb-3">
                            <label for="description_input" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description_input" name="deskripsi_kategori_pemasukan"></textarea>
                            <div class="invalid-feedback" id="deskripsi_kategori_pemasukan_error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="iconInput" class="form-label">Icon</label>
                            <select class="form-select" id="iconInput" name="icon_pemasukan">
                                <option value="">Select an icon</option>
                                <option value="menu-icon tf-icons bx bx-wallet-alt" data-icon="bx bx-wallet-alt"><i class="menu-icon tf-icons bx bx-wallet-alt"></i>Wallet</option>
                                <option value="menu-icon tf-icons bx bx-money" data-icon="bx bx-money">Money</option>
                                <option value="menu-icon tf-icons bx bx-dollar" data-icon="bx bx-dollar">Dollar</option>
                                <option value="menu-icon tf-icons bx bx-cart" data-icon="bx bx-cart"><i class="menu-icon tf-icons bx bx-cart"></i>Cart</option>
                                <option value="menu-icon tf-icons bx bx-shopping-bag" data-icon="bx bx-shopping-bag">Shopping Bag</option>
                                <option value="menu-icon tf-icons bx bx-credit-card" data-icon="bx bx-credit-card">Credit Card</option>
                                <option value="menu-icon tf-icons bx bx-diamond" data-icon="bx bx-diamond">Diamond</option>
                                <option value="menu-icon tf-icons bx bx-gift" data-icon="bx bx-gift">Gift</option>
                                <option value="menu-icon tf-icons bx bx-coin" data-icon="bx bx-coin">Coin</option>
                                <option value="menu-icon tf-icons bx bx-bank" data-icon="bx bx-bank">Bank</option>
                            </select>
                            <div class="invalid-feedback" id="iconInputError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentPage = 1;

        function loadCategories(page) {
            document.getElementById('loadingSpinner').style.display = 'block';
            document.getElementById('categoryTable').style.display = 'none';

                fetch(`/categoriesInput/${page}`)
                    .then(response => response.json())
                    .then(data => {
                        let tableHtml = '<table class="table"><thead><tr><th>Nama Pemasukan</th><th>Deskripsi</th><th>Icon</th><th>Actions</th></tr></thead><tbody>';
                        data.data.forEach(category => {
                            tableHtml += `<tr>
                                <td>${category.nama_pemasukan}</td>
                                <td>${category.deskripsi_kategori_pemasukan}</td>
                                <td><i class="${category.icon_pemasukan}"></i></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                    <form onsubmit="deleteCategory(event, this)" action="/deleteCategoriesInput/${category.kategori_pemasukan_id}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>`;
                        });
                        tableHtml += '</tbody></table>';
                        document.getElementById('categoryTable').innerHTML = tableHtml;

                        let paginationHtml = '';
                        if (data.current_page > 1) {
                            paginationHtml += `<button class="btn btn-sm btn-outline-primary" onclick="loadCategories(${data.current_page - 1})">←</button> `;
                        }
                        for (let i = 1; i <= data.last_page; i++) {
                            paginationHtml += `<button class="btn btn-sm ${i === data.current_page ? 'btn-primary' : 'btn-outline-primary'}" onclick="loadCategories(${i})">${i}</button> `;
                        }
                        if (data.current_page < data.last_page) {
                            paginationHtml += `<button class="btn btn-sm btn-outline-primary" onclick="loadCategories(${data.current_page + 1})">→</button>`;
                        }
                        document.getElementById('pagination').innerHTML = paginationHtml;
                        currentPage = data.current_page;

                        document.getElementById('loadingSpinner').style.display = 'none';
                        document.getElementById('categoryTable').style.display = 'block';
                    });
        }

        // Load initial data
        loadCategories(1);

        function deleteCategory(event, form) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(form.action, {
                            method: 'POST',
                            body: new FormData(form)
                        })
                        .then(response => {
                            //message
                        })
                        .then(data => {
                                Swal.fire(
                                    'Deleted!',
                                    "yey",
                                    'success'
                                ).then(() => {
                                    loadCategories(1);
                                });

                        });
                    }
                });
            }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('addCategoryForm');
            const namaPemasukan = document.getElementById('nameInput');
            const descriptionInput = document.getElementById('description_input');
            const iconInput = document.getElementById('iconInput');

            function validateInput(input, errorId, errorMessage) {
                const errorElement = document.getElementById(errorId);
                if (input.value.trim() === '') {
                    input.classList.add('is-invalid');
                    errorElement.textContent = errorMessage;
                    return false;
                } else {
                    input.classList.remove('is-invalid');
                    errorElement.textContent = '';
                    return true;
                }
            }

            namaPemasukan.addEventListener('input', function() {
                validateInput(this, 'nama_pemasukan_error', 'Name Wallet is required');
            });

            descriptionInput.addEventListener('input', function() {
                validateInput(this, 'deskripsi_kategori_pemasukan_error', 'Description Wallet is required');
            });

            iconInput.addEventListener('input', function(){
                validateInput(this, 'iconInputError', 'Icon Wallet is required');
            });

            form.addEventListener('submit', function(e) {
                let isValid = true;

                isValid = validateInput(namaPemasukan, 'nama_pemasukan_error', 'Kategori Pemasukan Harus Diisi') && isValid;
                isValid = validateInput(descriptionInput, 'deskripsi_kategori_pemasukan_error', 'Description Wallet is required') && isValid;
                isValid = validateInput(iconInput, 'iconInputError', 'Icon Wallet is required') && isValid;

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
