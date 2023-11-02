<script src="https://cdn.jsdelivr.net/gh/mattboldt/typed.js@2.0.11/lib/typed.min.js"></script>
<style>
    @supports (-webkit-background-clip: text) or (background-clip: text) {
        .gradient-text {
            background: linear-gradient(270deg, #ff8a00, #e52e71, #6610f2, #e52e71, #ff8a00);
            background-size: 500% 500%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 10s ease infinite, fadeIn 3s forwards; /* Adicionado animação de fadeIn */
            opacity: 0; /* Definido opacidade inicial para 0 */
        }

        /* Adicione o estilo para o texto inicial em preto */
        .initial-text {
            color: black;
            -webkit-text-fill-color: black;
        }
    }

    /* Define a animação de gradiente */
    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    /* Define a animação de fadeIn */
    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    .plyr--video {
        border-radius: 15px;
    }
</style>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css">

<div class="bg-white flex flex-col">
    <div class="self-stretch flex flex-col  mt-44 mb-24 max-md:max-w-full max-md:my-10">
        <div class="self-center initial-text text-neutral-950 text-8xl font-bold leading-[96px] max-w-[900px] ml-auto mr-auto max-md:max-w-full max-md:text-4xl text-center" id="typed-text" style="height: 200px;"></div>

        <img loading="lazy" id="showcase-image" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/showcase.png" class="w-full mt-56 max-w-[1200px] mx-auto" draggable="false"/>
        <div class="text-center">
            <div class="mx-auto max-w-[1018px] mt-32 max-md:max-w-full max-md:mt-10">
                <div class="flex justify-center">
                    <div class="gap-5 flex max-md:flex-col max-md:items-center max-md:gap-0">
                        <div class="flex flex-col items-center w-[81%] max-md:w-full max-md:ml-0 mx-auto">
                            <div class="flex grow flex-col max-md:max-w-full max-md:mt-10">
                                <div class="w-[755px] max-w-full self-center">
                                    <div class="gap-5 flex max-md:flex-col max-md:items-center max-md:gap-0">
                                        <div class="flex flex-col items-center w-[38%] max-md:w-full max-md:ml-0">
                                            <div class="flex grow flex-col max-md:mt-10">
                                                <img draggable="false" loading="lazy" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/1.svg" class="aspect-square object-cover object-center w-20 justify-center items-center overflow-hidden self-center max-w-full" />
                                                <div class="text-black text-center text-3xl font-bold leading-8 mt-3">Economiza<br />seu tempo</div>
                                                <img draggable="false" loading="lazy" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/2.svg" class="aspect-square object-cover object-center w-20 justify-center items-center overflow-hidden self-center max-w-full mt-10 max-md:mt-10" />
                                                <div class="text-black text-center text-3xl font-bold leading-8 mt-3">Interface<br />simples</div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-center w-[28%] ml-5 max-md:w-full max-md:ml-0">
                                            <div class="flex grow flex-col max-md:mt-10">
                                                <img draggable="false" loading="lazy" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/3.svg" class="aspect-square object-cover object-center w-20 justify-center items-center overflow-hidden self-center max-w-full" />
                                                <div class="text-black text-center text-3xl font-bold leading-8 mt-3">Rápida<br />navegação</div>
                                                <img draggable="false" loading="lazy" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/4.svg" class="aspect-square object-cover object-center w-20 justify-center items-center overflow-hidden self-center max-w-full mt-10 max-md:mt-10" />
                                                <div class="text-black text-center text-3xl font-bold leading-8 mt-3">Monitore<br />seu dia</div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-center w-[34%] ml-5 max-md:w-full max-md:ml-0">
                                            <div class="flex grow flex-col max-md:mt-10">
                                                <img draggable="false" loading="lazy" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/data-encryption-xxl.webp" class="aspect-square object-cover object-center w-20 justify-center items-center overflow-hidden self-center max-w-full" />
                                                <div class="text-black text-center text-3xl font-bold leading-8 mt-3">Dados<br />criptografados</div>
                                                <img draggable="false" loading="lazy" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/6.svg" class="aspect-square object-cover object-center w-20 justify-center items-center overflow-hidden self-center max-w-full mt-10 max-md:mt-10" />
                                                <div class="text-black text-center text-3xl font-bold leading-8 self-center items-start w-[181px] max-w-full grow mt-3 pt-8 whitespace-nowrap">Direto do<br>navegador</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-20">
                                    <video id="custom-video" controls width="100%" style="border-radius: 15px;" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/AWManager+-+Official+Trailer.mp4" class="max-w-full">
                                        Seu navegador não suporta a reprodução de vídeo.
                                    </video>
                                </div>


                                <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>

                                <div class="justify-center shadow-[0px_40px_40px_0px_rgba(0,0,0,0.25),0px_20.2497px_20.2497px_0px_rgba(0,0,0,0.13),0px_11.0474px_11.0474px_0px_rgba(0,0,0,0.07),0px_6.35486px_6.35486px_0px_rgba(0,0,0,0.04),0px_3.63429px_3.63429px_0px_rgba(0,0,0,0.02),0px_1.92107px_1.92107px_0px_rgba(0,0,0,0.01),0px_0.7834px_0.7834px_0px_rgba(0,0,0,0.00)] bg-stone-900 flex w-[225px] max-w-full gap-4 mt-28 pl-5 pr-5 pt-4 pb-6 rounded-2xl mx-auto max-md:mt-10">
                                    <img draggable="false" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/1a8eddf9-8199-492a-ae9c-d94a43d03067?" class="aspect-[0.78] object-cover object-center w-[18px] justify-center items-center overflow-hidden max-w-full self-start" />
                                    <a href="http://localhost:3000/signup" class="text-white text-center text-xl font-semibold leading-5 mt-1 self-start whitespace-nowrap">Fazer Meu Cadastro<a>
                                </div>
                                <div class="items-center flex w-[321px] max-w-full grow flex-col mt-12 mx-auto max-md:mt-10">
                                    <img draggable="false" loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/e50a6fad-ce25-4a6b-aa15-58f5f50c3c59?" class="aspect-[1.09] object-cover object-center w-6 justify-center items-center opacity-50 overflow-hidden self-center max-w-full" />
                                    <div class="text-black text-center text-xl font-bold leading-6 opacity-50 self-stretch mt-1 whitespace-nowrap">Feito por Arthur Brenno e Welcleys</div>
                                    <div class="text-black text-center text-base font-bold leading-5 opacity-30 self-center mt-1 whitespace-nowrap">
                                        <a href="https://trycoffee.co/" target="_blank">Universidade de Uberaba</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const player = new Plyr('#custom-video');
    });

    const showcaseImage = document.getElementById("showcase-image");

    function addGradientAnimation() {
        const textElement = document.getElementById("typed-text");
        textElement.classList.remove("initial-text");
        textElement.classList.add("gradient-text");
    }

    setTimeout(addGradientAnimation, 2700);

    function updateImagePosition(event) {
        const mouseX = event.clientX;
        const mouseY = event.clientY;
        const imageX = showcaseImage.getBoundingClientRect().left + showcaseImage.width / 2;
        const imageY = showcaseImage.getBoundingClientRect().top + showcaseImage.height / 2;

        const deltaX = (imageX - mouseX) * 0.005;
        const deltaY = (imageY - mouseY) * 0.005;

        showcaseImage.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
    }

    document.addEventListener("mousemove", updateImagePosition);

    const options = {
        strings: ["Gerenciamento de tarefas para todos."],
        typeSpeed: 20,
        backSpeed: 25,
        startDelay: 500,
        backDelay: 500,
        showCursor: false,

    };

    const typed = new Typed("#typed-text", options);
</script>


