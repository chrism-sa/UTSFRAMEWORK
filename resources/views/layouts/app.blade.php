<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHARSYSTEM</title>
    <link rel="icon" type="image/jpg" href="logo.jpg">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="logo">CHARSYSTEM</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                    <div class="login-register-bar">
                        <li class="nav-item">
                            <a class="nav-link login-link" href="{{ route('login') }}">
                                <i class="fas fa-user icon"></i> Login
                            </a>
                        </li>
                        @if (Route::has('login'))
                        <li class="nav-item register-link">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-check-circle icon"></i> Register
                            </a>
                        </li>
                        @endif
                    </div>
                    @else
                    <li class="nav-item dropdown">
                        @auth
                            @if(Auth::user()->role != 'admin') <!-- Periksa peran pengguna, jika bukan admin -->
                                <a id="notificationDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false" onclick="toggleNotificationList()">
                                    🔔
                                </a>
                            @endif
                        @endauth
                        <div id="notificationList" class="dropdown-content">
                            <!-- Notifikasi akan dimuat di sini -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt icon"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="container text-center">
            <p><a href="{{ route('about')}}">About Me</a> &copy; </p>
        </div>
    </footer>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // Fungsi untuk menampilkan atau menyembunyikan daftar notifikasi
    function toggleNotificationList() {
        var dropdown = document.getElementById("notificationList");
        if (dropdown.style.display === "block") {
            dropdown.style.display = "none";
            dropdown.innerHTML = ""; // Bersihkan konten notifikasi saat ditutup
        } else {
            dropdown.style.display = "block";
            dropdown.innerHTML = "<div class='spinner-border' role='status'><span class='sr-only'>Loading...</span></div>"; // Tampilkan spinner saat data dimuat
            // Muat deskripsi notifikasi secara dinamis
            loadNotifications();
        }
    }

    // Fungsi untuk memuat deskripsi notifikasi secara dinamis
    function loadNotifications() {
        // Buat XMLHttpRequest untuk memuat data notifikasi
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "{{ route('user.notifications') }}", true); // Ganti route dengan yang sesuai untuk notifikasi pengguna
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Berhasil memuat data, tambahkan deskripsi notifikasi ke dropdown
                    var response = JSON.parse(xhr.responseText);
                    var dropdown = document.getElementById("notificationList");
                    dropdown.innerHTML = ""; // Bersihkan konten dropdown sebelum menambahkan notifikasi
                    response.forEach(function (notification) {
                        var notificationItem = document.createElement("a");
                        notificationItem.classList.add("dropdown-item");
                        notificationItem.href = "#";
                        notificationItem.innerHTML = `
                            <strong>${notification.message}</strong>
                            <br>
                            <small>Waktu Mulai: ${notification.created_at}</small>
                        `;
                        dropdown.appendChild(notificationItem);
                    });
                    // Atur posisi dropdown agar berada di bawah navbar
                    var navbarHeight = document.querySelector(".navbar").offsetHeight;
                    dropdown.style.top = navbarHeight + "px";
                } else {
                    // Gagal memuat data, tampilkan pesan kesalahan
                    console.error("Failed to load notifications.");
                }
            }
        };
        xhr.send();
    }

    </script>

</body>

</html>
