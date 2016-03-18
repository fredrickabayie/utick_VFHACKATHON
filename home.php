<!DOCTYPE html>
<html lang="en" class="demo-2 no-js">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shape Hover Effect with SVG | Demo 2</title>
    <meta name="description" content="Hover Effects with animated SVG Shapes using Snap.svg"/>
    <meta name="keywords" content="animated svg, hover effect, grid, svg shape html, "/>
    <meta name="author" content="Codrops"/>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/normalize2.css"/>
    <link rel="stylesheet" type="text/css" href="css/demo2.css"/>
    <link rel="stylesheet" type="text/css" href="css/component2.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/snap.svg-min.js"></script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body style="background-color: #4A4B4D">
<div class="container">
    <!-- Top Navigation -->
    <div class="codrops-top clearfix">
        <a class="codrops-icon codrops-icon-prev" href="http://tympanus.net/Development/SVGDrawingAnimation/"><span>Previous Demo</span></a>
        <span class="right"><a href="http://cargocollective.com/isaac317">Artwork by Isaac Montemayor</a><a
                class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=18145"><span>Back to the Codrops Article</span></a></span>
    </div>
    <!--<header class="codrops-header">-->
    <!--<h1>Shape Hover Effect with SVG<span>Recreating the effect as seen on <a href="http://christmasexperiments.com/">The Christmas Experiments</a></span></h1>-->
    <!--<nav class="codrops-demos">-->
    <!--<a href="index.html">Demo 1</a>-->
    <!--<a class="current-demo" href="home.html">Demo 2</a>-->
    <!--<a href="index3.html">Demo 3</a>-->
    <!--</nav>-->
    <!--</header>-->
    <section id="grid" class="grid clearfix" style="">
        <a href="#"
           data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
            <figure>
                <img src="images/2.png"/>
                <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                    <path
                        d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"></path>
                </svg>
                <figcaption>
                    <h2>Crystalline</h2>
                    <p>Soko radicchio bunya nuts gram dulse.</p>
                    <button>View</button>
                </figcaption>
            </figure>
        </a>
        <a href="#"
           data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
            <figure>
                <img src="images/4.png"/>
                <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                    <path
                        d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"></path>
                </svg>
                <figcaption>
                    <h2>Cacophony</h2>
                    <p>Two greens tigernut soybean radish artichoke.</p>
                    <button>View</button>
                </figcaption>
            </figure>
        </a>
        <a href="#"
           data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
            <figure>
                <img src="images/6.png"/>
                <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                    <path
                        d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"></path>
                </svg>
                <figcaption>
                    <h2>Languid</h2>
                    <p>Beetroot water spinach okra water chestnut.</p>
                    <button>View</button>
                </figcaption>
            </figure>
        </a>
        <a href="#"
           data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
            <figure>
                <img src="images/8.png"/>
                <svg viewBox="0 0 180 320" preserveAspectRatio="none">
                    <path
                        d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"></path>
                </svg>
                <figcaption>
                    <h2>Serene</h2>
                    <p>Water spinach arugula pea tatsoi.</p>
                    <button>View</button>
                </figcaption>
            </figure>
        </a>
    </section>
    <!--<section class="related">-->
    <!--<p>If you enjoyed these effects you might also like:</p>-->
    <!--<div><a href="http://tympanus.net/Tutorials/CaptionHoverEffects/"><h4>Caption Hover Effects</h4></a></div>-->
    <!--<div><a href="http://tympanus.net/Development/AnimatedSVGIcons/"><h4>Animated SVG Icons</h4></a></div>-->
    <!--</section>-->
</div><!-- /container -->
<script>
    (function () {

        function init() {
            var speed = 330,
                easing = mina.backout;

            [].slice.call(document.querySelectorAll('#grid > a')).forEach(function (el) {
                var s = Snap(el.querySelector('svg')), path = s.select('path'),
                    pathConfig = {
                        from: path.attr('d'),
                        to: el.getAttribute('data-path-hover')
                    };

                el.addEventListener('mouseenter', function () {
                    path.animate({'path': pathConfig.to}, speed, easing);
                });

                el.addEventListener('mouseleave', function () {
                    path.animate({'path': pathConfig.from}, speed, easing);
                });
            });
        }

        init();

    })();
</script>
</body>
</html>