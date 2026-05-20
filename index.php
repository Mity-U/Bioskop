<?php
include 'connection.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$genre_filter = isset($_GET['genre']) ? mysqli_real_escape_string($conn, $_GET['genre']) : '';

$sql = "SELECT * FROM films WHERE judul LIKE '%$search%'";
if ($genre_filter != '') {
    $sql .= " AND genre = '$genre_filter'";
}
$sql .= " ORDER BY id DESC";
$res = mysqli_query($conn, $sql);

$list_genres = ["Action", "Adventure", "Animation", "Comedy", "Crime", "Drama", "Fantasy", "Horror", "Romance", "Sci-Fi", "Thriller"];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cho-Cho Streaming</title>
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>

    <nav>
        <div class="nav-left">
            <a href="index.php" class="logo">Cho-Cho</a>
            <a href="javascript:void(0)" class="nav-link" id="genreBtn">Genre ▼</a>
        </div>
        <form method="GET" class="search-group">
            <input type="text" name="search" placeholder="Cari film..." value="<?= htmlspecialchars($search) ?>">
        </form>
    </nav>

    <section id="genreMenu" class="genre-overlay">
        <div class="genre-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #fcf6ba; margin: 0;">Explore Genres</h2>
                <a href="index.php" class="nav-link"
                    style="font-size: 0.8rem; border: 1px solid #bf953f; padding: 5px 15px; border-radius: 20px;">RESET
                    / ALL MOVIES</a>
            </div>
            <div class="genre-grid">
                <?php foreach ($list_genres as $g): ?>
                    <a href="index.php?genre=<?= $g ?>"
                        class="genre-card <?= ($genre_filter == $g) ? 'active-genre' : '' ?>">
                        <span><?= $g ?></span>
                        <i style="color:#555">›</i>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <header class="hero">
        <h1>Premium Streaming</h1>
        <p>Nikmati ribuan koleksi film pilihan eksklusif dalam satu genggaman.</p>
    </header>

    <main style="padding: 40px 5%;">
        <h2 style="color: #bf953f; margin-bottom: 25px;">
            <?= $genre_filter ? "Genre: $genre_filter" : "Rekomendasi Hari Ini" ?></h2>
        <div class="catalog">
            <?php while ($f = mysqli_fetch_assoc($res)): ?>
                <article class="card"
                    onclick="openModal('<?= addslashes($f['judul']) ?>', '<?= addslashes($f['sinopsis']) ?>', '<?= $f['genre'] ?>', '<?= $f['durasi'] ?>', 'assets/<?= $f['poster'] ?>')">
                    <img src="assets/<?= $f['poster'] ?>">
                    <p class="card-title"><?= $f['judul'] ?></p>
                </article>
            <?php endwhile; ?>
        </div>
    </main>

    <dialog id="movieDialog">
        <button class="btn-close-pop" onclick="movieDialog.close()">✕</button>
        <div class="detail-wrapper">
            <div class="detail-left">
                <img id="m-poster" src="" alt="Poster">
            </div>
            <div class="detail-right">
                <h1 id="m-judul"></h1>
                <div class="detail-meta">
                    <span class="tag-genre" id="m-genre"></span>
                    <span style="color: #888; margin-left: 10px;">• <span id="m-durasi"></span> Mins</span>
                </div>
                <p class="detail-synopsis" id="m-sinopsis"></p>
                <div style="margin-top: 30px;">
                    <button class="btn-play">WATCH NOW</button>
                    <button
                        style="background:transparent; border:1px solid #555; color:#fff; padding:12px 20px; border-radius:4px; margin-left:10px; cursor:pointer;">+
                        MY LIST</button>
                </div>
                
            </div>
        </div>
    </dialog>

    <script>
        const genreBtn = document.getElementById('genreBtn');
        const genreMenu = document.getElementById('genreMenu');
        const dialog = document.getElementById('movieDialog');
        const mPoster = document.getElementById('m-poster');

        // Toggle Genre
        genreBtn.onclick = (e) => { e.stopPropagation(); genreMenu.classList.toggle('show'); };
        window.onclick = (e) => { if (!genreMenu.contains(e.target) && e.target !== genreBtn) genreMenu.classList.remove('show'); };

        // Open Detail Modal
        function openModal(judul, sinopsis, genre, durasi, poster) {
            document.getElementById('m-judul').innerText = judul;
            document.getElementById('m-sinopsis').innerText = sinopsis;
            document.getElementById('m-genre').innerText = genre;
            document.getElementById('m-durasi').innerText = durasi;
            mPoster.src = poster;
            dialog.showModal();
        }

        // Close on Click Outside
        dialog.addEventListener('click', (e) => {
            const rect = dialog.getBoundingClientRect();
            if (e.clientX < rect.left || e.clientX > rect.right || e.clientY < rect.top || e.clientY > rect.bottom) dialog.close();
        });
    </script>

</body>

</html>