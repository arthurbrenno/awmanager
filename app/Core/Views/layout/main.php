<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_clean();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Google Tag Manager -->
<!--    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':-->
<!--                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],-->
<!--            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=-->
<!--            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);-->
<!--        })(window,document,'script','dataLayer','GTM-TTLV6CC6');</script>-->
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{titulo}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.0/build/three.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>

        * {
            cursor: none !important;
        }


        .cursor-dot {
            width: 5px;
            height: 5px;
            background-color: black;
        }

        .cursor-outline {
            width: 30px;
            height: 30px;
            border: 2px solid hsla(0, 0%, 0%, 0.5);
        }

        .cursor-dot, .cursor-outline {
            position: fixed;
            top: 0;
            left: 0;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: 9999;
            pointer-events: none;
        }

        /* Bloqueio extra para o cursor */
        html {
            cursor: none !important;
        }

    </style>
</head>
<body>

    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TTLV6CC6"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    {{header}}

    {{content}}

    {{footer}}

    <script>
        const cursorDot = document.querySelector("[data-cursor-dot]");
        const cursorOutline = document.querySelector("[data-cursor-outline]");

        window.addEventListener("mousemove", (e) => {
            const { clientX: xpos, clientY: ypos } = e;

            [cursorDot, cursorOutline].forEach(cursor => {
                Object.assign(cursor.style, {
                    left: `${xpos}px`,
                    top: `${ypos}px`
                });
            });

            cursorOutline.animate({
                left: `${xpos}px`,
                top: `${ypos}px`
            }, {duration: 500, fill: "forwards"});
        });
    </script>

</body>



</html>

