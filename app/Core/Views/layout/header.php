<header>
    <div style="display: flex; justify-content: center;">
        <div class="fixed z-[9] mt-5 items-start border bg-zinc-950 flex gap-5 pl-5 pr-5 rounded-[32px] border-solid border-white max-md:flex-wrap max-md:justify-center animate__animated animate__fadeInDown hover-width">
            <a href="/dashboard" class="text-white text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto hover:text-pink-500 transition-colors">Dashboard</a>
            <a href="https://github.com/arthurbrenno/awmanagerapp" target="_blank" class="text-white text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto hover:text-pink-500 transition-colors">Sobre</a>
            <a href="https://github.com/arthurbrenno/awmanagerapp" target="_blank" class="text-white text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto hover:text-pink-500 transition-colors">Source</a>
            <a href="/login" class="text-white mt-2 mb-2 text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto bg-gray-900 rounded-full px-5 py-3 py-1 hover:bg-white hover:text-black transition-colors">Login</a>
        </div>
    </div>
</header>

<style>
    .hover-width {
        width: 21%; /* Largura inicial */
        transition: width 0.5s ease, background-color 0.5s ease; /* Transição suave */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hover-width:hover {
        width: 19%; /* Largura quando o mouse passar sobre */
    }


</style>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        const header = document.querySelector(".fixed");
        header.classList.add("animate__fadeInDown");

        const hoverWidthElements = document.querySelectorAll('.hover-width');
        const cursorDot = document.querySelector('.cursor-dot');
        const cursorOutline = document.querySelector('.cursor-outline');

        hoverWidthElements.forEach(function(element) {
            element.addEventListener('mouseover', function() {
                cursorDot.style.backgroundColor = 'white';
                cursorOutline.style.borderColor = 'white';
            });

            element.addEventListener('mouseout', function() {
                cursorDot.style.backgroundColor = 'black';
                cursorOutline.style.borderColor = 'hsla(0, 0%, 0%, 0.5)';
            });
        });
    });
</script>
