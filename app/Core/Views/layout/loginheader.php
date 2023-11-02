<style>
    .fade-in {
        animation: fadeIn 0.5s;
    }

    .fade-out {
        animation: fadeOut 0.5s;
    }

    .hover-width {
        width: 18%; /* Largura inicial */
        transition: width 0.5s ease; /* Transição suave */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hover-width:hover {
        width: 17%; /* Largura quando o mouse passar sobre */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>

<header>
    <div style="display: flex; justify-content: center;">
        <div class="fixed mt-5 items-start border bg-zinc-950 flex gap-5 pl-5 pr-5 rounded-[32px] border-solid border-white max-md:flex-wrap max-md:justify-center fade-in hover-width">
            <a href="/dashboard" class="text-white text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto hover:text-pink-500 transition-colors">Dashboard</a>
            <a href="/sobre" class="text-white text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto hover:text-pink-500 transition-colors">Sobre</a>
            <a href="/source" class="text-white text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto hover:text-pink-500 transition-colors">Source</a>
            <a href="/" class="text-white mt-2 mb-2 text-sm font-medium leading-[107.692%] tracking-wide self-center my-auto bg-gray-900 rounded-full px-5 py-3 py-1 hover:bg-white hover:text-black transition-colors">
                <i class="fas fa-home"></i> <!-- Ícone de casa do Font Awesome -->
            </a>
        </div>
    </div>
</header>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        const header = document.querySelector(".fixed");
        const homeLink = document.querySelector('a[href="/home"]');
        homeLink.addEventListener("click", (event) => {
            event.preventDefault();
            header.classList.remove("fade-in");
            header.classList.add("fade-out");
            setTimeout(() => {
                window.location.href = "/home";
            }, 500);
        });
    });

    window.onload = () => {
        const hoverWidthElements = document.querySelectorAll('.hover-width');
        const cursorDot = document.querySelector('.cursor-dot');
        const cursorOutline = document.querySelector('.cursor-outline');

        hoverWidthElements.forEach((element) => {
            element.addEventListener('mouseover', () => {
                cursorDot.style.backgroundColor = 'white';
                cursorOutline.style.borderColor = 'white';
            });

            element.addEventListener('mouseout', () => {
                cursorDot.style.backgroundColor = 'black';
                cursorOutline.style.borderColor = 'hsla(0, 0%, 0%, 0.5)';
            });
        });
    };
</script>

