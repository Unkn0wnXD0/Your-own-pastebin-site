<?php
require "./include/autoload.php";

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: " . getLink("/"));
    exit;
}

$paste = getPaste($_GET['id']);

if(!$paste){
    header("Location: " . getLink("/"));
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Paste - <?= $paste['paste_title']; ?></title>
        <link rel="stylesheet" href="<?= getRawLink("/styles/main.min.css") ?>">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/monokai-sublime.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js"></script>
    </head>
    <body>
        <?php require "./include/views/nav.php"; ?>

        <div class="container">
            <center>
                <h1 class="page-title"><?= $paste['paste_title']; ?></h1>
                <p class="page-overview">Store large code & text online and share with the world.</p>
            </center>

            <div class="paste-wrap">
                <div class="paste-head">
                    <div class="paste-action">
                        <a href="<?= getLink("/raw")."?id=".$paste['paste_id'] ?>">
                            <button class="alt" name="button" type="submit">Raw</button>
                        </a>
                        <a href="<?= getLink("/") ?>">
                            <button name="button" type="submit">New Paste</button>
                        </a>
                    </div>
                </div>
            
                <?php if($paste['paste_syntax'] === "text"): ?>
                    <textarea name="content" readonly><?= $paste['paste_content']; ?></textarea>
                <?php else: ?>
                    <pre><code class="language-<?= $paste['paste_syntax']; ?>"><?= htmlspecialchars($paste['paste_content']); ?></code></pre>
                <?php endif; ?>
            </div>
        </div>

        <?php require "./include/views/footer.php"; ?>

        <script src="<?= getRawLink("/js/main.js") ?>"></script>
        <script>hljs.highlightAll();hljs.initLineNumbersOnLoad();</script>
    </body>
</html>