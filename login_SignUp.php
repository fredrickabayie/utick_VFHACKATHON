<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTICK</title>
    <!--<meta name="description" content="Morphing Buttons Concept: Inspiration for revealing content by morphing the action element" />-->
    <!--<meta name="keywords" content="expanding button, morph, modal, fullscreen, transition, ui" />-->
    <!--<link rel="shortcut icon" href="../favicon.ico">-->
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="css/component.css"/>
    <link rel="stylesheet" type="text/css" href="css/content.css"/>
    <script src="js/modernizr.custom.js"></script>
</head>
<body style="background-color: #4A4B4D">
<div class="container" style="background-color: #4A4B4D">
    <!-- Top Navigation -->
    <div class="codrops-top clearfix">
        <!--<a class="codrops-icon codrops-icon-prev" href="http://tympanus.net/Development/PageLoadingEffects/"><span>Previous Demo</span></a>-->
        <!--<span class="right"><a class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=19004"><span>Back to the Codrops Article</span></a></span>-->
    </div>
    <header class="codrops-header">

        <h1 style="margin-top: 120px">UTICK</h1>
        <!--<p>Inspiration for revealing content by morphing the action element. Examples:</p>-->
        <nav class="codrops-demos">
            <!--<a class="current-demo" href="login_SignUp.html">Login/Signup</a>-->
        </nav>
    </header>
    <section>
        <!--<p>Click one of the buttons below to see a <strong>modal dialog</strong>:</p>-->
        <div class="mockup-content">
            <!--<p>Pea horseradish azuki bean lettuce avocado asparagus okra.</p>-->
            <div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">
                <button type="button" style="background-color: white; color: #A61E24">Login</button>
                <div class="morph-content" style="background-color: white">
                    <div>
                        <div class="content-style-form content-style-form-1">
                            <span class="icon icon-close">Close the dialog</span>
                            <h2>Login</h2>
                            <form>
                                <p><label>Email</label><input type="text"/></p>
                                <p><label>Password</label><input type="password"/></p>
                                <p>
                                    <button style="background-color: #A61E24">Login</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- morph-button -->
            <strong class="joiner">or</strong>
            <div class="morph-button morph-button-modal morph-button-modal-3 morph-button-fixed">
                <button type="button" style="background-color: white; color: #A61E24">Signup</button>
                <div class="morph-content" style="background-color: white">
                    <div>
                        <div class="content-style-form content-style-form-3">
                            <span class="icon icon-close">Close the dialog</span>
                            <h2>Sign Up</h2>
                            <form>
                                <p><label>Email</label><input type="text"/></p>
                                <p><label>Phone</label><input type="text"/></p>
                                <p><label>Password</label><input type="password"/></p>
                                <p>
                                    <button style="background-color: #A61E24">Sign Up</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- morph-button -->
            <!--<p>Kohlrabi radish okra azuki bean corn fava bean mustard tigernut juccama green bean celtuce collard greens-->
                <!--avocado quandong.</p>-->
        </div><!-- /form-mockup -->
    </section>
    <section class="related">
    <p><small>Terms and conditions apply.</small></p>
        <p><a href="#">HOME</a></p>
    <!--<a href="http://tympanus.net/Development/ProgressButtonStyles/">-->
    <!--<img src="http://tympanus.net/codrops/wp-content/uploads/2013/12/ProgressButtonStyles-300x162.png" />-->
    <!--<h3>Progress Button Styles</h3>-->
    <!--</a>-->
    <!--<a href="http://tympanus.net/Development/SidebarTransitions/">-->
    <!--<img src="http://tympanus.net/codrops/wp-content/uploads/2013/08/sidebartransitions-300x162.png" />-->
    <!--<h3>Sidebar Transitions</h3>-->
    <!--</a>-->
    </section>
</div><!-- /container -->
<script src="js/classie.js"></script>
<script src="js/uiMorphingButton_fixed.js"></script>
<script>
    (function () {
        var docElem = window.document.documentElement, didScroll, scrollPosition;

        // trick to prevent scrolling when opening/closing button
        function noScrollFn() {
            window.scrollTo(scrollPosition ? scrollPosition.x : 0, scrollPosition ? scrollPosition.y : 0);
        }

        function noScroll() {
            window.removeEventListener('scroll', scrollHandler);
            window.addEventListener('scroll', noScrollFn);
        }

        function scrollFn() {
            window.addEventListener('scroll', scrollHandler);
        }

        function canScroll() {
            window.removeEventListener('scroll', noScrollFn);
            scrollFn();
        }

        function scrollHandler() {
            if (!didScroll) {
                didScroll = true;
                setTimeout(function () {
                    scrollPage();
                }, 60);
            }
        };

        function scrollPage() {
            scrollPosition = {x: window.pageXOffset || docElem.scrollLeft, y: window.pageYOffset || docElem.scrollTop};
            didScroll = false;
        };

        scrollFn();

        [].slice.call(document.querySelectorAll('.morph-button')).forEach(function (bttn) {
            new UIMorphingButton(bttn, {
                closeEl: '.icon-close',
                onBeforeOpen: function () {
                    // don't allow to scroll
                    noScroll();
                },
                onAfterOpen: function () {
                    // can scroll again
                    canScroll();
                },
                onBeforeClose: function () {
                    // don't allow to scroll
                    noScroll();
                },
                onAfterClose: function () {
                    // can scroll again
                    canScroll();
                }
            });
        });

        // for demo purposes only
        [].slice.call(document.querySelectorAll('form button')).forEach(function (bttn) {
            bttn.addEventListener('click', function (ev) {
                ev.preventDefault();
            });
        });
    })();
</script>
</body>
</html>