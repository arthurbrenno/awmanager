<header>
    <div class="flex flex-col">
        <div class="bg-black self-stretch flex w-full items-start justify-between gap-5 pl-7 pr-4 max-md:max-w-full max-md:flex-wrap">
            <div class="items-start self-center flex justify-between gap-5 my-auto max-md:justify-center">
                <img loading="lazy" draggable="false" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/logodashboard.webp" class="aspect-[0.81] object-cover object-center w-[13px] fill-white fill-opacity-90 overflow-hidden self-stretch max-w-full" />
                <a href="/" class="text-white text-opacity-90 text-sm font-semibold tracking-tight self-stretch" style="font-family: 'San Francisco', sans-serif;"> Home </a>
                <a href="https://github.com/arthurbrenno/awmanagerapp" target="_blank" class="text-white text-opacity-90 text-sm font-medium tracking-tight self-stretch" style="font-family: 'San Francisco', sans-serif;"> Source </a>
                <a href="https://github.com/arthurbrenno/" target="_blank" class="text-white text-opacity-90 text-sm font-medium tracking-tight self-stretch" style="font-family: 'San Francisco', sans-serif;"> Arthur </a>
                <a href="https://github.com/Welcleys" target="_blank" class="text-white text-opacity-90 text-sm font-medium tracking-tight self-stretch" style="font-family: 'San Francisco', sans-serif;"> Welcleys </a>
                <a href="/logout" class="text-white text-opacity-90 text-sm font-medium tracking-tight self-stretch" style="font-family: 'San Francisco', sans-serif;"> Logout </a>
            </div>
            <div class="items-start self-stretch flex gap-1.5 max-md:justify-center">
                <img loading="lazy" draggable="false" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/battery.svg" class="aspect-[1.17] object-cover object-center w-7 justify-center items-center self-stretch overflow-hidden max-w-full" />
                <img loading="lazy" draggable="false" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/appleconfig.svg" class="aspect-[1.17] object-cover object-center w-7 justify-center items-center overflow-hidden self-stretch max-w-full" />
                <img loading="lazy" draggable="false" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/applesearch.svg" class="aspect-[1.17] object-cover object-center w-7 justify-center items-center overflow-hidden self-stretch max-w-full" />
                <img loading="lazy" draggable="false" src="https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/applewifi.svg" class="aspect-[1.17] object-cover object-center w-7 justify-center items-center overflow-hidden self-stretch max-w-full" />
                <div id='date' class="text-white text-opacity-90 text-sm font-medium tracking-tight self-center my-auto"></div>
                <div id='time' class="text-white text-opacity-90 text-sm font-medium tracking-tight self-center my-auto whitespace-nowrap">AWM</div>
            </div>
        </div>
    </div>
</header>



<script>
    const updateTime = () => {
        const now     = new Date();
        const hours   = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        document.getElementById('time').innerHTML = `${hours}:${minutes}:${seconds}`;
    }

    const updateDate = () => {
        const options = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
        document.getElementById('date').innerHTML = new Date().toLocaleDateString('pt-BR', options);
    }

    setInterval(updateTime, 1000);
    setInterval(updateDate, 3600000);
</script>

