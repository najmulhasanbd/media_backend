<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Media Admin') }}</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}" />

  <style>
    body, button, input, select, textarea, .form-control, .form-select, .nav-item a, .dropdown-header, p, h1, h2, h3, h4, h5, h6, table, .table {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }

    /* Font Awesome Protection (Must not be overridden by text fonts) */
    .fa, .fas, .fa-solid, .far, .fa-regular, .fab, .fa-brands, [class^="fa-"], [class*=" fa-"] {
      font-family: "Font Awesome 6 Free", "Font Awesome 6 Brands" !important;
      display: inline-block;
      font-style: normal;
      font-variant: normal;
      text-rendering: auto;
      line-height: 1;
    }
    .fa, .fas, .fa-solid {
      font-family: "Font Awesome 6 Free" !important;
      font-weight: 900 !important;
    }
    .far, .fa-regular {
      font-family: "Font Awesome 6 Free" !important;
      font-weight: 400 !important;
    }
    .fab, .fa-brands {
      font-family: "Font Awesome 6 Brands" !important;
      font-weight: 400 !important;
    }

    body {
      background-color: #f4f7fe;
      color: #1e293b;
      -webkit-font-smoothing: antialiased;
    }

    .cursor-pointer {
      cursor: pointer;
    }

    /* Cinematic Header for Admin Pages */
    .admin-page-header {
      background: radial-gradient(circle at 10% 20%, rgba(245, 158, 11, 0.12) 0%, transparent 40%),
                  linear-gradient(135deg, #090a10 0%, #111422 60%, #1e1b4b 100%);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 18px;
      padding: 24px 28px;
      color: #ffffff;
      box-shadow: 0 10px 25px rgba(10, 11, 18, 0.15);
      position: relative;
      overflow: hidden;
      margin-bottom: 24px;
    }

    .admin-page-header .header-badge {
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-weight: 700;
      background: linear-gradient(135deg, #fbbf24, #f59e0b);
      color: #0b0c10;
      padding: 4px 12px;
      border-radius: 50rem;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 8px;
    }

    .btn-gold-action {
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
      color: #0b0c10 !important;
      font-weight: 700;
      border: none;
      box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
      transition: all 0.3s ease;
      border-radius: 50rem;
      padding: 8px 22px;
      font-size: 0.9rem;
    }

    .btn-gold-action:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 22px rgba(245, 158, 11, 0.45);
      color: #000 !important;
    }

    .card-modern {
      background: #ffffff;
      border: 1px solid #edf2f7;
      border-radius: 18px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.025);
      overflow: hidden;
    }

    /* Ultra-Clean Input Fields */
    .form-control, .form-select {
      border-radius: 12px;
      border: 1.5px solid #e2e8f0;
      padding: 11px 16px;
      font-size: 0.925rem;
      color: #0f172a;
      background-color: #ffffff;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    }

    .form-control:focus, .form-select:focus {
      border-color: #f59e0b;
      background-color: #ffffff;
      box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.16);
      outline: none;
    }

    .form-label {
      font-weight: 600;
      color: #334155;
      font-size: 0.84rem;
      margin-bottom: 7px;
      letter-spacing: 0.2px;
      display: block;
    }

    /* Beautiful Input Groups */
    .input-group-modern {
      display: flex;
      align-items: stretch;
      width: 100%;
      border-radius: 12px;
      transition: all 0.25s ease;
    }

    .input-group-modern .input-group-text {
      background-color: #f8fafc;
      border: 1.5px solid #e2e8f0;
      border-right: none;
      border-radius: 12px 0 0 12px;
      color: #64748b;
      padding: 0 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.95rem;
      min-width: 48px;
      transition: all 0.25s ease;
    }

    .input-group-modern .form-control,
    .input-group-modern .form-select {
      border-radius: 0 12px 12px 0 !important;
      border-left: 1px solid #f1f5f9;
    }

    .input-group-modern:focus-within .input-group-text {
      border-color: #f59e0b;
      color: #d97706;
      background-color: #fffbeb;
    }

    .input-group-modern:focus-within .form-control,
    .input-group-modern:focus-within .form-select {
      border-color: #f59e0b;
      box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.16);
    }

    /* Modern Table Styling */
    .table {
      margin-bottom: 0;
    }

    .table thead th {
      font-size: 0.76rem;
      text-transform: uppercase;
      letter-spacing: 0.7px;
      font-weight: 700;
      color: #475569;
      background-color: #f8fafc;
      border-bottom: 1.5px solid #e2e8f0;
      padding: 16px 20px;
    }

    .table tbody td {
      padding: 16px 20px;
      vertical-align: middle;
      border-bottom: 1px solid #f1f5f9;
      font-size: 0.9rem;
      color: #1e293b;
    }

    .table-hover tbody tr:hover {
      background-color: #fbfcfe;
    }

    .action-btn-circle {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #e2e8f0;
      background: #ffffff;
      color: #475569;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .action-btn-circle:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      border-color: #cbd5e1;
    }

    /* Drag Handle & Ghost */
    .cursor-grab {
      cursor: grab !important;
      font-size: 1.05rem;
      transition: color 0.2s ease;
    }
    .cursor-grab:hover {
      color: #f59e0b !important;
    }
    .cursor-grab:active {
      cursor: grabbing !important;
    }
    .sortable-ghost {
      opacity: 0.5;
      background: #fffbeb !important;
      border: 2px dashed #f59e0b !important;
    }

    /* Drag & Drop File Upload Dropzone */
    .file-dropzone {
      border: 2px dashed #cbd5e1;
      border-radius: 14px;
      padding: 24px;
      text-align: center;
      background-color: #f8fafc;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
    }
    .file-dropzone:hover, .file-dropzone.dragover {
      border-color: #f59e0b;
      background-color: #fffbeb;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(245, 158, 11, 0.1);
    }
    .file-dropzone input[type="file"] {
      position: absolute;
      top: 0; left: 0; width: 100%; height: 100%;
      opacity: 0;
      cursor: pointer;
      z-index: 5;
    }
    .file-dropzone .dropzone-icon {
      font-size: 2.2rem;
      color: #94a3b8;
      margin-bottom: 8px;
      transition: all 0.3s ease;
    }
    .file-dropzone:hover .dropzone-icon, .file-dropzone.dragover .dropzone-icon {
      color: #f59e0b;
      transform: scale(1.1);
    }
    .file-dropzone .dropzone-title {
      font-weight: 600;
      color: #1e293b;
      font-size: 0.95rem;
      margin-bottom: 4px;
    }
    .file-dropzone .dropzone-subtitle {
      color: #64748b;
      font-size: 0.8rem;
    }
    .file-dropzone .preview-wrapper {
      position: relative;
      display: inline-block;
      margin-top: 12px;
      z-index: 10;
    }
    .file-dropzone .preview-image {
      max-height: 160px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      object-fit: cover;
    }

    /* Sidebar Refinements */
    .app-sidebar {
      background: #0e1424 !important;
      border-right: 1px solid rgba(255, 255, 255, 0.05);
    }
    .nav-item a, .dropdown-header {
      font-size: 0.88rem !important;
      font-weight: 500 !important;
      letter-spacing: 0.2px !important;
      border-radius: 10px !important;
      margin: 4px 12px !important;
      padding: 10px 16px !important;
      color: #94a3b8 !important;
      transition: all 0.2s ease !important;
    }
    .nav-item a:hover, .dropdown-header:hover {
      color: #ffffff !important;
      background: rgba(255, 255, 255, 0.06) !important;
    }
    .nav-item.active > a {
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(245, 158, 11, 0.05) 100%) !important;
      color: #ffffff !important;
      font-weight: 600 !important;
      border-left: 3px solid #f59e0b !important;
    }
    .nav-item.active > a i:first-child, .nav-item a:hover i:first-child {
      color: #f59e0b !important;
    }
    .submenu {
      background: rgba(0, 0, 0, 0.25) !important;
      border-radius: 10px !important;
      margin: 4px 12px 8px !important;
      padding: 4px 0 !important;
    }
    .submenu a {
      font-size: 0.825rem !important;
      padding: 7px 16px !important;
      color: #cbd5e1 !important;
    }
    .submenu a:hover {
      color: #f59e0b !important;
    }
  </style>

  @stack('styles')
</head>

<body class="sidebar-collapsed">
  <div class="page">
    @include('admin.layouts.header')

    @include('admin.layouts.sidebar')

    <main class="main-content app-content">
      @yield('content')
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
  <script src="{{ asset('backend/js/main.js') }}"></script>

  <!-- Global Reusable Sortable Table Reordering Helper -->
  <script>
    window.initSortableTable = function(tbodyId, reorderUrl, successMsg) {
      var el = document.getElementById(tbodyId);
      if (!el) return;
      new Sortable(el, {
        handle: '.cursor-grab',
        animation: 200,
        ghostClass: 'sortable-ghost',
        onEnd: function() {
          var order = [];
          $('#' + tbodyId + ' tr').each(function() {
            var id = $(this).data('id');
            if (id) order.push(id);
          });
          if (order.length === 0) return;
          $.ajax({
            url: reorderUrl,
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { order: order },
            success: function(res) {
              if (typeof toastr !== 'undefined') {
                toastr.success(successMsg || 'Display order updated successfully!');
              }
            },
            error: function() {
              if (typeof toastr !== 'undefined') {
                toastr.error('Failed to update order.');
              }
            }
          });
        }
      });
    };
  </script>

  <!-- Global Form Spinner & Prevent Double-Submit -->
  <script>
    $(document).on('submit', 'form', function(e) {
      var form = $(this);
      if (form.data('submitting') === true) {
        e.preventDefault();
        return false;
      }
      if (this.checkValidity()) {
        var submitBtn = form.find('button[type="submit"]');
        if (submitBtn.length > 0 && !submitBtn.hasClass('no-spinner')) {
          submitBtn.prop('disabled', true);
          submitBtn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Saving...');
        }
        form.data('submitting', true);
      }
    });

    // Global Drag & Drop File Upload Preview Handler
    $(document).ready(function() {
      $('.file-dropzone').each(function() {
        var dropzone = $(this);
        var fileInput = dropzone.find('input[type="file"]');
        var previewContainer = dropzone.find('.preview-wrapper');

        dropzone.on('dragover dragenter', function(e) {
          e.preventDefault();
          e.stopPropagation();
          dropzone.addClass('dragover');
        });

        dropzone.on('dragleave dragend drop', function(e) {
          e.preventDefault();
          e.stopPropagation();
          dropzone.removeClass('dragover');
        });

        fileInput.on('change', function() {
          var files = this.files;
          if (files && files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              previewContainer.html('<div class="position-relative d-inline-block"><img src="' + e.target.result + '" class="preview-image"><span class="badge bg-success position-absolute top-0 end-0 m-1"><i class="fa-solid fa-check"></i> Selected</span></div>');
              previewContainer.removeClass('d-none');
              dropzone.find('.dropzone-icon').addClass('text-success');
              dropzone.find('.dropzone-title').text(files[0].name);
            };
            reader.readAsDataURL(files[0]);
          }
        });
      });
    });
  </script>

  <!-- Reusable SweetAlert2 confirmation & alert handlers -->
  <script>
    $(document).on('click', '.confirm-delete, .btn-delete', function (e) {
      e.preventDefault();
      var form = $(this).closest('form');
      var url = $(this).attr('href');
      var title = $(this).data('confirm-title') || 'Are you sure?';
      var text = $(this).data('confirm-text') || 'You will not be able to revert this!';

      Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          if (form.length > 0) {
            form.submit();
          } else if (url && url !== '#' && url !== 'javascript:void(0)') {
            window.location.href = url;
          }
        }
      });
    });

    window.showAlert = function(type, title, message) {
      Swal.fire({
        icon: type,
        title: title,
        text: message
      });
    };
  </script>

  <!-- Laravel Custom Toastr -->
  <x-custom-toastr position="top-right" duration="5000" />

  @stack('scripts')
</body>

</html>
