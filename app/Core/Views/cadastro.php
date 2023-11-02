<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<main class="h-screen bg-slate-100 flex items-center justify-center gradient-background">
    <div class="bg-white p-8 rounded-lg shadow-lg w-80 mx-auto">
        <div class="text-black text-xl font-semibold text-center mb-4">Cadastro</div>
        <form action="/signupvalidator" method="post" onsubmit="handleSubmit(event)">
            <div class="mb-4">
                <div class="text-black text-base">Nome</div>
                <input required type="text" id="name" name="name" class="w-full px-3 py-2 rounded-lg border border-zinc-500 focus:outline-none focus:border-blue-400" placeholder="Seu nome">
            </div>
            <div class="mb-4">
                <div class="text-black text-base">Email</div>
                <input required type="email" id="email" name="email" class="w-full px-3 py-2 rounded-lg border border-zinc-500 focus:outline-none focus:border-blue-400" placeholder="seuemail@example.com">
            </div>
            <div class="mb-4">
                <div class="text-black text-base">Senha</div>
                <div class="relative">
                    <input required type="password" id="password" name="password" class="w-full px-3 py-2 rounded-lg border border-zinc-500 focus:outline-none focus:border-blue-400" placeholder="Sua senha" onkeyup="checkPasswordRequirements()">
                    <button id="password-toggle" type="button" class="absolute top-0 right-0 mt-2 mr-2 text-sm text-black" onclick="togglePasswordVisibility('password')">Mostrar</button>
                </div>
                <div id="password-requirements">
                    <ul>
                        <li><span id="upper-case-icon">❌</span> Letra maiúscula</li>
                        <li><span id="lower-case-icon">❌</span> Letra minúscula</li>
                        <li><span id="special-character-icon">❌</span> Caractere especial</li>
                        <li><span id="number-icon">❌</span> Número</li>
                        <li><span id="length-icon">❌</span> 8 caracteres</li>
                    </ul>
                </div>
            </div>
            <div class="mb-6">
                <div class="text-black text-base">Confirme a senha</div>
                <div class="relative">
                    <input required type="password" id="password_confirmation" name="passwordConfirmation" class="w-full px-3 py-2 rounded-lg border border-zinc-500 focus:outline-none focus:border-blue-400" placeholder="Confirme sua senha" onkeyup="checkPasswordMatch()">
                    <button id="password-confirmation-toggle" type="button" class="absolute top-0 right-0 mt-2 mr-2 text-sm text-black" onclick="togglePasswordVisibility('password_confirmation')">Mostrar</button>
                </div>
                <div id="password-match">
                    <span id="match-icon">❌</span> Senha corresponde
                </div>
            </div>
            <div class="mb-4">
                <div class="g-recaptcha" data-sitekey="6LdHhq8oAAAAAMBNkilvj_910lYh1FWg22MhGRvk" style="transform:scale(0.8);transform-origin:0 0;"></div>
            </div>
            <div class="mb-4 text-center">
                <button type="submit" class="w-full bg-black text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Cadastrar</button>
            </div>
            <div class="text-center">
                <a href="{{authurl}}" class="inline-block bg-white text-gray-700 font-thin py-2 px-4 rounded-lg border border-zinc-500 hover:border-gray-400 flex items-center justify-center">
                    <img src="https://freesvg.org/img/1534129544.png" alt="Google" class="w-5 h-5 mr-2">Login with Google
                </a>
            </div>
            <div class="mt-4 text-red-500 text-center">
                {{erro}}
                {{errogoogle}}
            </div>
        </form>
        <div class="text-center mt-4">
            <a href="/login" class="text-blue-500 underline">Já possuo uma conta</a>
        </div>
    </div>
</main>

<script>
    const grecaptcha = document.querySelector('.g-recaptcha');

    const isCaptchaCompleted = () => grecaptcha.getResponse().trim() !== '';

    const handleSubmit = (event) => {
        if (!isCaptchaCompleted()) {
            event.preventDefault();
            alert('Por favor, complete o captcha antes de enviar o formulário.');
        }
    }

    const togglePasswordVisibility = (inputId) => {
        const passwordInput = document.getElementById(inputId);
        const passwordToggle = document.getElementById(inputId + '-toggle');

        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordToggle.textContent = passwordInput.type === 'password' ? 'Mostrar' : 'Ocultar';
    }

    const checkPasswordRequirements = () => {
        const passwordInput = document.getElementById('password');
        const upperCaseIcon = document.getElementById('upper-case-icon');
        const lowerCaseIcon = document.getElementById('lower-case-icon');
        const specialCharacterIcon = document.getElementById('special-character-icon');
        const numberIcon = document.getElementById('number-icon');
        const lengthIcon = document.getElementById('length-icon');

        const password = passwordInput.value;

        upperCaseIcon.textContent = /[A-Z]/.test(password) ? '✅' : '❌';
        lowerCaseIcon.textContent = /[a-z]/.test(password) ? '✅' : '❌';
        specialCharacterIcon.textContent = /[!@#$%^&*(),.?":{}|<>]/.test(password) ? '✅' : '❌';
        numberIcon.textContent = /[0-9]/.test(password) ? '✅' : '❌';
        lengthIcon.textContent = password.length >= 8 ? '✅' : '❌';
    }

    const checkPasswordMatch = () => {
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const matchIcon = document.getElementById('match-icon');

        matchIcon.textContent = passwordInput.value === passwordConfirmationInput.value ? '✅' : '❌';
    }
</script>

