
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Menu | Rasa Kita</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<header class="header">
    <a href="{{ route('beranda') }}" class="brand">
        <span class="logo">RK</span>
        <span>Rasa Kita
            <small>Rasa istimewa, setiap hari</small>
        </span>
    </a>

    <nav>
        <a href="{{ route('beranda') }}">Beranda</a>
        <a class="active" href="{{ route('menu.index') }}">Daftar Menu</a>

        @auth
            <span>{{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>

            <a class="nav-button" href="{{ route('menu.create') }}">
                + Tambah Menu
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </nav>
</header>

<main class="container">

    <section class="page-heading">
        <div>
            <span class="eyebrow">MANAJEMEN KATALOG</span>
            <h1>Daftar menu<span class="dot">.</span></h1>
            <p>Kelola semua makanan dan minuman Rasa Kita.</p>
        </div>

        @auth
            <a href="{{ route('menu.create') }}" class="button">
                + Tambah Menu
            </a>
        @endauth
    </section>

    @if (session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert error">
            Periksa kembali data yang dimasukkan.
        </div>
    @endif

    <section class="table-card">
        <div class="table-heading">
            <div>
                <h2>Semua menu</h2>
                <p>Data langsung dari database.</p>
            </div>
            <span>{{ $menu->count() }} item</span>
        </div>

        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>

                        @auth
                            <th>Aksi</th>
                        @endauth
                    </tr>
                </thead>

                <tbody>
                    @forelse ($menu as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->nama_menu }}</strong>
                            </td>

                            <td>
                                <span class="category">
                                    {{ $item->kategori }}
                                </span>
                            </td>

                            <td>{{ $item->deskripsi }}</td>

                            <td class="price">
                                Rp{{ number_format($item->harga, 0, ',', '.') }}
                            </td>

                            @auth
                                <td>
                                    <div class="actions">
                                        {{-- Admin dan Kasir boleh Edit --}}
                                        <a class="button small secondary"
                                           href="{{ route('menu.edit', $item->id) }}">
                                            Edit
                                        </a>

                                        {{-- Hanya Admin boleh Hapus --}}
                                        @if (auth()->user()->role === 'admin')
                                            <form action="{{ route('menu.destroy', $item->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="button small danger"
                                                        onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada data menu.

                                @auth
                                    <a href="{{ route('menu.create') }}">
                                        Tambahkan menu sekarang.
                                    </a>
                                @endauth
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
