<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Revolution 2.3</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <link rel="stylesheet" href="assets/reveal/css/reveal.min.css">
    <link rel="stylesheet" href="assets/reveal/css/theme/night.css" id="theme">

    <!-- For syntax highlighting -->
    <link rel="stylesheet" href="assets/reveal/lib/css/zenburn.css">

    <!-- custom styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- If the query includes 'print-pdf', use the PDF print sheet -->
    <script>
        document.write('<link rel="stylesheet" href="assets/reveal/css/print/' + ( window.location.search.match(/print-pdf/gi) ? 'pdf' : 'paper' ) + '.css" type="text/css" media="print">');
    </script>

    <!--[if lt IE 9]>
    <script src="assets/reveal/lib/js/html5shiv.js"></script>
    <![endif]-->
</head>

<body>

<div class="reveal">

    <!-- Any section element inside of this container is displayed as a slide -->
    <div class="slides">
        <section>
            <h1>Revolution 2.3</h1>

            <br />

            <h3>Wat is er nieuw en wat is er beter</h3>
        </section>
    </div>

</div>

<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="assets/reveal/lib/js/head.min.js"></script>
<script src="assets/reveal/js/reveal.min.js"></script>
<?php

$base = dirname(__FILE__) . '/slides/';
$slides = array();
if ($handle = opendir($base)) {

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        if (in_array($entry, array('.', '..'))) continue;

        if (!isset($slides[$entry])) $slides[$entry] = array();

        if (is_dir($base.$entry.'/')) {
            $dir = opendir($base.$entry.'/');
            while (false !== ($slide = readdir($dir))) {
                if (in_array($slide, array('.', '..'))) continue;
                $slides[$entry][] = $slide;
            }
        }
    }
    closedir($handle);
}

?>
<script>
    var slides = <?= json_encode($slides) ?>;

    $(document).ready(function() {
        var path = 'slides/';
        $.each(slides, function(folder, slides) {
            var folderPath = path + folder + '/';

            $.each(slides, function (idx, slide) {
                $.ajax({
                    url: folderPath + slide,
                    async: false,
                    cache: false,
                    success: function(data) {
                        $('.slides').append(data);
                    }
                });
            })
        });

        // Full list of configuration options available here:
        // https://github.com/hakimel/reveal.js#configuration
    setTimeout(function() {
        Reveal.initialize({
            controls: true,
            progress: true,
            history: true,

            width: '100%',
            //height: '100%',

            theme: Reveal.getQueryHash().theme, // available themes are in /css/theme
            transition: 'page', // default/cube/page/concave/zoom/linear/fade/none

            // Optional libraries used to extend on reveal.js
            dependencies: [
                { src: 'assets/reveal/lib/js/classList.js', condition: function () {
                    return !document.body.classList;
                } },
                { src: 'assets/reveal/plugin/markdown/marked.js', condition: function () {
                    return !!document.querySelector('[data-markdown]');
                } },
                { src: 'assets/reveal/plugin/markdown/markdown.js', condition: function () {
                    return !!document.querySelector('[data-markdown]');
                } },
                { src: 'assets/reveal/plugin/highlight/highlight.js', async: true, callback: function () {
                    hljs.initHighlightingOnLoad();
                } },
                { src: 'assets/reveal/plugin/zoom-js/zoom.js', async: true, condition: function () {
                    return !!document.body.classList;
                } },
                { src: 'assets/reveal/plugin/notes/notes.js', async: true, condition: function () {
                    return !!document.body.classList;
                } }
                // { src: 'assets/reveal/plugin/search/search.js', async: true, condition: function() { return !!document.body.classList; } }
                // { src: 'assets/reveal/plugin/remotes/remotes.js', async: true, condition: function() { return !!document.body.classList; } }
            ]
        });
    }, 1000);

    });

</script>

</body>
</html>
