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
                            <label for="nama_pemasukan" class="form-label">Nama Pemasukan</label>
                            <input type="text" class="form-control" id="nama_pemasukan" name="nama_pemasukan">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_kategori_pemasukan" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_kategori_pemasukan" name="deskripsi_kategori_pemasukan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="icon_pemasukan" class="form-label">Icon</label>
                            <input type="text" class="form-control" id="icon_pemasukan" name="icon_pemasukan">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save Category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="{{ asset('/assets/js/dashboards-analytics.js') }}"></script>
    <script>
        let currentPage = 1;

        function loadCategories(page) {
            fetch(`/categories/${page}`)
                .then(response => response.json())
                .then(data => {
                    let tableHtml = '<table class="table"><thead><tr><th>ID</th><th>Nama Pemasukan</th><th>Deskripsi</th><th>Icon</th><th>Actions</th></tr></thead><tbody>';
                    data.data.forEach(category => {
                        tableHtml += `<tr>
                            <td>${category.kategori_pemasukan_id}</td>
                            <td>${category.nama_pemasukan}</td>
                            <td>${category.deskripsi_kategori_pemasukan}</td>
                            <td>${category.icon_pemasukan}</td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
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
                });
}


        // Load initial data
        loadCategories(1);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addCategoryForm');
    const nameInput = document.getElementById('nama_pemasukan');
    const descriptionInput = document.getElementById('deskripsi_kategori_pemasukan');

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

    nameInput.addEventListener('input', function() {
        validateInput(this, 'nama_dompet_error', 'Name Wallet is required');
    });

    descriptionInput.addEventListener('input', function() {
        validateInput(this, 'deskripsi_dompet_error', 'Description Wallet is required');
    });

    form.addEventListener('submit', function(e) {
        let isValid = true;

        isValid = validateInput(nameInput, 'nama_dompet_error', 'Name Wallet is required') && isValid;
        isValid = validateInput(descriptionInput, 'deskripsi_dompet_error', 'Description Wallet is required') && isValid;

        if (!isValid) {
            e.preventDefault();
        }
    });
});
        </script>
@endsection
