
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Menu | Rasa Kita</title>
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
        <a href="{{ route('menu.index') }}">Daftar Menu</a>
    </nav>
</header>

<main class="container">

    <section class="page-heading">
        <div>
            <span class="eyebrow">PERBARUI KATALOG</span>
            <h1>Edit menu<span class="dot">.</span></h1>
            <p>Perbarui informasi menu yang dipilih.</p>
        </div>
    </section>

    <section class="form-card">

        @if ($errors->any())
            <div class="alert error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menu.update', $menu->id) }}"
              method="POST" class="menu-form">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="nama_menu">Nama Menu</label>
                <input id="nama_menu" name="nama_menu"
                       type="text" maxlength="100"
                       value="{{ old('nama_menu', $menu->nama_menu) }}"
                       required>
            </div>

            <div class="field">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="Makanan"
                        {{ old('kategori', $menu->kategori) === 'Makanan' ? 'selected' : '' }}>
                        Makanan
                    </option>
                    <option value="Minuman"
                        {{ old('kategori', $menu->kategori) === 'Minuman' ? 'selected' : '' }}>
                        Minuman
                    </option>
                    <option value="Dessert"
                        {{ old('kategori', $menu->kategori) === 'Dessert' ? 'selected' : '' }}>
                        Dessert
                    </option>
                </select>
            </div>

            <div class="field full">
                <label for="deskripsi">Deskripsi Menu</label>
                <textarea id="deskripsi" name="deskripsi"
                          rows="4" required>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
            </div>

            <div class="field">
                <label for="harga">Harga (Rp)</label>
                <input id="harga" name="harga"
                       type="number" min="0" step="1"
                       value="{{ old('harga', $menu->harga) }}"
                       required>
            </div>

            <div class="form-actions">
                <a href="{{ route('menu.index') }}"
                   class="button secondary">Batal</a>

                <button type="submit" class="button">
                    Simpan Perubahan
                </button>
            </div>
        </form>
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
<div>
</footer>

</body>
</html>
