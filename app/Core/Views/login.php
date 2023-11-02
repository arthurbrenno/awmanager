
<main class="h-screen bg-slate-100 flex items-center justify-center gradient-background">
    <div class="bg-white p-8 rounded-lg shadow-lg w-80 mx-auto">
        <div class="text-black text-xl font-semibold text-center mb-4">Login</div>
        <form action="/loginvalidator" method="post">
            <div class="mb-4">
                <div class="text-black text-base">Email</div>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 rounded-lg border border-zinc-500 focus:outline-none focus:border-blue-400" placeholder="duneida@gmail.com" required>
            </div>
            <div class="mb-6">
                <div class="text-black text-base">Senha</div>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 rounded-lg border border-zinc-500 focus:outline-none focus:border-blue-400" placeholder="DUneid@96" required>
                    <button id="password-toggle" type="button" class="absolute top-0 right-0 mt-2 mr-2 text-sm text-black" onclick="togglePasswordVisibility()">Show</button>
                </div>
            </div>
            <div class="self-stretch flex items-start justify-between gap-2.5 mt-7">
                <input type="checkbox" id="remember" name="remember" class="checkbox">
                <label for="remember" class="text-black text-xs font-light self-start">Lembrar de mim</label>
                <a href="/forgotpassword" class="text-neutral-600 text-xs font-light self-start">Esqueci minha senha</a>
            </div>
            <div class="mb-4 mt-4 text-red-500 text-center {{ empty($error) ? 'hidden' : '' }}">{{erro}}</div>
            <div class="mb-4 text-center">
                <button type="submit" class="w-full bg-black text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Login</button>
            </div>
            <div class="text-center">
                <a href="{{authurl}}" class="inline-block bg-white text-gray-700 font-thin py-2 px-4 rounded-lg border border-zinc-500 hover:border-gray-400 flex items-center justify-center">
                    <img src="https://freesvg.org/img/1534129544.png" alt="Google" class="w-5 h-5 mr-2">Login with Google
                </a>
                <!-- Botão "Login com o GitHub" -->
                <a href="https://github.com/login/oauth/authorize?client_id={{githubsecret}}&scope={{githubscope}}" class="inline-block mt-2 bg-white text-gray-700 font-thin py-2 px-4 rounded-lg border border-zinc-500 hover:border-gray-400 flex items-center justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" alt="GitHub" class="w-5 h-5 mr-2">Login with GitHub
                </a>
            </div>
            <div class="mt-4 text-center">
                <a href="/signup" class="text-blue-500 font-thin text-sm">Não tenho uma conta</a>
            </div>
        </form>
    </div>
</main>








<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggle.textContent = 'Ocultar';
        } else {
            passwordInput.type = 'password';
            passwordToggle.textContent = 'Mostrar';
        }
    }
</script>