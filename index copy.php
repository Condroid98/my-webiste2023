<!DOCTYPE html>
<html>
<head>
  <title>My website</title>
  <link rel="stylesheet" href="style.css">
  <script src="fontawesome/js/all.js"></script>
  <script>
    function showDateTime() {
      var now = new Date();
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      var dateTime = now.toLocaleDateString('id-ID', options) + ' - ' + now.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
      document.getElementById('date-time').innerHTML = dateTime;
    }
    setInterval(showDateTime, 1000); // Memperbarui waktu setiap detik
  </script>
</head>
<body>
  <div class="container">
    <?php
      require_once 'config.php';
      
      $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      if ($conn->connect_error) {
        die('Koneksi ke database gagal: ' . $conn->connect_error);
      }

      $sql = "SELECT username FROM users ORDER BY id DESC LIMIT 1";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
      }
      else {
        header("Location: username.html");
        exit();
      }

      $conn->close();
    ?>

    <h1>Halo, <?php echo $username; ?> !</h1>
    <div class="message">
    <p>Salah satu pengkerdilan terkejam dalam hidup adalah membiarkan pikiran yang cemerlang <br> menjadi budak bagi tubuh yang malas, yang mendahulukan istirahat sebelum lelah.</p>
    <p><em>~ Buya Hamka</em></p>
    </div>
    <div class="search-form">
      <img src="google.png" alt="Google Logo" class="google-logo">
      <form action="https://www.google.com/search" method="GET" target="_blank">
        <input type="text" name="q" class="search-input" placeholder="Cari di Google" required>
        <button type="submit" class="button-cari"><i class="fas fa-search"></i></button>
      </form>
    </div>
    <button class="button" onclick="window.location.href='username.html'">Edit</button>
  </div>
  <p id="date-time"></p> 
</body>
</html>

