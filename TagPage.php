<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag</title>
</head>
<body>
<form method="post">
  <label for="nome">Nome:</label>
  <input type="text" id="nome" name="nome" required>
  <br>
  <br>
  <input type="submit" value="Cadastrar">
</form>
    <?php
    require_once './model/Tag.php';
    require_once './model/TagDAO.php';
    
    // verifica se os dados foram enviados pelo formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // obtém os dados do formulário
        $nome = $_POST['nome'];
        $tag = new Tag(True, 0, $nome);
    
      var_dump($tag); 
      $TagDAO = new TagDAO();
      $tag = $TagDAO->insert($tag);
      if($tag){
        var_dump($tag);
      }
      else{
        var_dump($tagDAO->getErro());
      }         
      
    }
    ?>
</body>
</html>

