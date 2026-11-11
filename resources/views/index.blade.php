<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rasa Kita | Beranda</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<header class="header" style="display: flex; justify-content: space-between; align-items: center;">
    <a href="{{ route('beranda') }}" class="brand">
        <span class="logo">RK</span>
        <span>Rasa Kita
            <small>Rasa istimewa, setiap hari</small>
        </span>
    </a>

    <nav style="display: flex; align-items: center; gap: 20px; margin-left: auto; margin-right: 20px;">
        <a class="active" href="{{ route('beranda') }}">Beranda</a>
        <a href="{{ route('menu.index') }}">Daftar Menu</a>
        @auth
            <a class="nav-button" href="{{ route('menu.create') }}">
                + Tambah Menu
            </a>
        @endauth
    </nav>

    <!-- Cek apakah user SUDAH login atau BELUM -->
    <div style="display: flex; align-items: center;">
        @auth
            <!-- Jika SUDAH login: Tampilkan tombol Log Out -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                @csrf
                <button type="submit" style="background-color: #2e4d38; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 500;">
                    Log Out
                </button>
            </form>
        @else
            <!-- Jika BELUM login: Tampilkan tombol Login -->
            <a href="{{ route('login') }}" style="background-color: #2e4d38; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500;">
                Login
            </a>
        @endauth
    </div>
</header>

<main class="container">

    <section class="hero">
        <div class="hero-copy">
            <span class="eyebrow">SELAMAT DATANG DI RASA KITA</span>

            <h1>Rasa yang bikin<br><em>ingin kembali.</em></h1>

            <p>
                Temukan makanan dan minuman favorit
                dengan rasa istimewa dan harga bersahabat.
            </p>

            <a href="{{ route('menu.index') }}" class="button">
                Jelajahi Menu →
            </a>
        </div>

        <div class="hero-art">
            <div class="food-circle">🍛</div>
            <span>GOOD FOOD, GOOD MOOD</span>
        </div>
    </section>

    <section class="section-heading">
        <div>
            <span class="eyebrow">KATALOG KAMI</span>
            <h2>Menu pilihan favorit.</h2>
        </div>

        <a href="{{ route('menu.index') }}" class="text-link">
            Lihat semua →
        </a>
    </section>

    <section class="stats">
        <div class="stat-card">
            <span>🍽️</span>
            <div>
                <small>Total menu tersedia</small>
                <strong>{{ $totalMenu }}</strong>
            </div>
        </div>
    </section>

    <div class="filter-kategori">
    <a href="{{ url('/') }}"
       class="filter-btn {{ !request('kategori') ? 'active' : '' }}">
        Semua
    </a>

    <a href="{{ url('/?kategori=Makanan') }}"
       class="filter-btn {{ request('kategori') == 'Makanan' ? 'active' : '' }}">
        Makanan
    </a>

    <a href="{{ url('/?kategori=Minuman') }}"
       class="filter-btn {{ request('kategori') == 'Minuman' ? 'active' : '' }}">
        Minuman
    </a>

    <a href="{{ url('/?kategori=Dessert') }}"
       class="filter-btn {{ request('kategori') == 'Dessert' ? 'active' : '' }}">
        Dessert
    </a>
</div>

    <section class="menu-grid">
        @forelse ($menu as $item)
            <article class="menu-card">
                <div class="food-image">
                    @if ($item->kategori === 'Minuman')
                        🥤
                    @elseif ($item->kategori === 'Dessert')
                        🍰
                    @else
                        🍛
                    @endif
                </div>

                <span class="category">{{ $item->kategori }}</span>

                <h3>{{ $item->nama_menu }}</h3>
                <p>{{ $item->deskripsi }}</p>

                <strong class="price">
                    Rp{{ number_format($item->harga, 0, ',', '.') }}
                </strong>
            </article>
        @empty
            <div class="empty">
                <h3>Belum ada menu.</h3>
                <p>Tambahkan menu pertama ke katalog Rasa Kita.</p>
                <a href="{{ route('menu.create') }}" class="button">
                    + Tambah Menu
                </a>
            </div>
        @endforelse
    </section>

</main>

<footer class="footer">
    <strong>Rasa Kita</strong>
    <span>© 2026</span>

    <div class="identity-box">
        <div class="identity-text">
            <div><strong>Muhammad Rizky</strong></div>
            <div>NIM 102022500017</div>
            <div>Kelas SI4906 | Kelompok 10</div>
        </div>

<img
    src="{{ asset('images/foto-gua.jpeg') }}"
    alt="Foto Muhammad Rizky"
    class="identity-photo"
>
    </div>
</footer>

</body>
</html>