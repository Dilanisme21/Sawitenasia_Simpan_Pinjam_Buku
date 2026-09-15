<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sawitenasia Simpan Pinjam Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

<!-- Style Custom Toast Melayang -->
    <style>
        .custom-alert-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 320px;
            max-width: 420px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border: none;
            padding-right: 3.5rem !important;
        }
    </style>
</head>
<body>

    <!-- Notifikasi Sukses (Hijau) -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert-toast border-start border-success border-4 d-flex align-items-center my-0" id="success-alert" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-check-circle-fill me-2 flex-shrink-0 text-success" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l5-5.25a.75.75 0 0 0-.012-1.056z"/>
            </svg>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Notifikasi Gagal (Merah) -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show custom-alert-toast border-start border-danger border-4 d-flex align-items-center my-0" id="error-alert" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle-fill me-2 flex-shrink-0 text-danger" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
            <div>
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Konten Utama Halaman -->
    @stack('isi-halaman')

    <!-- JavaScript Auto Hide (5 Detik) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let successAlert = document.getElementById('success-alert');
            let errorAlert = document.getElementById('error-alert');
            
            function autoHideAlert(element) {
                if (element) {
                    setTimeout(function() {
                        element.style.transition = "all 0.5s ease";
                        element.style.opacity = "0";
                        element.style.transform = "translateY(-10px)";

                        setTimeout(function() {
                            element.remove();
                        }, 500);
                    }, 5000);
                }
            }

            autoHideAlert(successAlert);
            autoHideAlert(errorAlert);
        });
    </script>
</body>
</html>