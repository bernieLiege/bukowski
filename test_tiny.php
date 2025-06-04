<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#content',
      height: 300
    });
  </script>
</head>
<body>
  <form method="post">
    <input type="text" name="title" placeholder="Titre"><br><br>
    <textarea id="content" name="content"></textarea><br><br>
    <button type="submit">Envoyer</button>
  </form>
</body>
</html>
