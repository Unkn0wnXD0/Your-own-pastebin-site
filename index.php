<?php
require "./include/autoload.php";

if(isset($_POST['button'])){
    $title = getPost("title");
    $content = getPost("content");
    $syntax = getPost("syntax");

    $req = newPaste($title, $content, $syntax);

    if(isset($req['success']) && $req['success'] == true){
        header("Location: " . getLink("/paste") . "?id=" . $req['id']);
        exit;
    }

    if(isset($req["error"])){
        $error_message = $req["error"];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Paste</title>
        <link rel="stylesheet" href="<?= getRawLink("/styles/main.min.css") ?>">
    </head>
    <body>
        <?php require "./include/views/nav.php"; ?>

        <div class="container">
            <center>
                <h1 class="page-title">Create New Paste</h1>
                <p class="page-overview">Store large code & text online and share with the world.</p>
            </center>

            <form class="paste-wrap" method="post" action="">
                <div class="paste-head">
                    <input name="title" type="text" placeholder="Untitled Paste">

                    <select name="syntax">
                        <option value="">Text</option>
                        <option value="bash">Bash</option>
                        <option value="brainfuck">Brainfuck</option>
                        <option value="c">C</option>
                        <option value="cpp">C++</option>
                        <option value="csharp">C#</option>
                        <option value="css">CSS</option>
                        <option value="dart">Dart</option>
                        <option value="go">Go</option>
                        <option value="html">HTML</option>
                        <option value="java">Java</option>
                        <option value="javascript">JavaScript</option>
                        <option value="json">JSON</option>
                        <option value="kotlin">Kotlin</option>
                        <option value="lua">Lua</option>
                        <option value="markdown">Markdown</option>
                        <option value="php">PHP</option>
                        <option value="python">Python</option>
                        <option value="ruby">Ruby</option>
                        <option value="rust">Rust</option>
                        <option value="sql">SQL</option>
                        <option value="typescript">TypeScript</option>
                    </select>

                    <div class="paste-action">
                        <button name="button" type="submit">Create Paste</button>
                    </div>
                </div>

                <?php if(isset($error_message)): ?> 
                <div class="paste-alert alert-error">
                    <p><?= $error_message ?></p>    
                </div>
                <?php endif; ?>
            
                <textarea name="content" placeholder="Create a new paste..."></textarea>
            </form>
        </div>

        <?php require "./include/views/footer.php"; ?>

        <script src="<?= getRawLink("/js/main.js") ?>"></script>
    </body>
</html>