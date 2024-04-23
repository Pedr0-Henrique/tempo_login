<!DOCTYPE html>
<html>
<head>
  <title>Resultado</title>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("img/macos-big-sur-apple-layers-fluidic-colorful-wwdc-stock-4096x2304-1455.jpg");
      background-position: center;
      background-size: cover;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1, p {
      text-align: center;
    }

    a {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #4caf50;
    }

    a:hover {
      color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    if (isset($_GET["nome"])) {
      $v_usuario = $_GET["nome"];
      $v_time = time();
      setcookie("c_usuario", $v_usuario, time()+(2 * 60 * 60));
      setcookie("c_time_login", $v_time, time()+30); // Alteração aqui para 30 segundos
      echo "<h1>Ola $v_usuario</h1>";
      echo "<p id='tempoDecorrido'></p>"; // Aqui será exibido o tempo decorrido
      echo "<a href=proc_dados.php>Testar tempo após login</a>";
    } else {
      if(isset($_COOKIE["c_time_login"])) {
        $agora = time();
        $ult_login = $_COOKIE["c_time_login"];
        $passou = $agora - $ult_login;
        if ($passou > 30) { // Alteração aqui para 30 segundos
          echo "<h1>Faça login novamente</h1>";
          echo "<p>Passaram $passou segundos</p>";
          echo "<a href=index.html>Login</a>";
        } else {
          echo "<h1>Faça login novamente</h1>";
          echo "<p id='tempoDecorrido'>Após 30 segundos será solicitado novo login</p>"; // Alteração aqui para 30 segundos
          echo "<a href=proc_dados.php>Testar tempo após login</a>";
        }
      } else {
        echo "<h1>Faça login novamente</h1>";
        echo "<a href=index.html>Login</a>";
      }
    }
    ?>
  </div>
  <script>
    // JavaScript para atualizar o tempo decorrido
    function atualizarTempoDecorrido() {
      var tempoDecorridoElemento = document.getElementById('tempoDecorrido');
      var tempoDecorrido = parseInt(tempoDecorridoElemento.innerText.split(' ')[1] || 0) + 1; // Obtém o tempo decorrido atual e adiciona 1 segundo
      tempoDecorridoElemento.innerText = 'Passaram ' + tempoDecorrido + ' segundos'; // Atualiza o elemento com o novo tempo decorrido
      
      // Verifica se passaram 30 segundos
      if (tempoDecorrido >= 30) {
        // Exibe mensagem para fazer login novamente
        document.querySelector('.container').innerHTML = "<h1>Faça login novamente</h1><p>Passaram 30 segundos</p><a href='index.html'>Login</a>";
        clearInterval(intervalo); // Para de atualizar o contador
      }
    }

    // Atualiza o tempo decorrido a cada segundo
    var intervalo = setInterval(atualizarTempoDecorrido, 1000);
  </script>
</body>
</html>





