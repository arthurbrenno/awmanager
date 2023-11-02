<style>
    @keyframes modalShow {
        0%   {opacity: 0;}
        100% {opacity: 1;}
    }

    @keyframes modalHide {
        0%   {opacity: 1;}
        100% {opacity: 0;}
    }

    .hidden {
        display: none;
    }

    .show {
        animation-name: modalShow;
        animation-duration: 1s;
    }

    .hide {
        animation-name: modalHide;
        animation-duration: 1s;
    }

</style>


<div class="flex h-screen font-sans bg-gray-100">
    <div class="w-1/4 bg-white p-4 flex flex-col items-center justify-center">
        <div class="w-16 h-16 rounded-full mb-2 profile-pic" style="background: url('{{avatarUrl}}') center / cover no-repeat;">
        </div>
        <h1 class="text-2xl font-semibold text-center">{{nome}}</h1>
        <button id="createTaskButton" class="bg-blue-500 text-white w-6 h-6 rounded-full hover:bg-blue-600 transition-colors duration-300 mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </button>
    </div>

    <div class="w-3/4 p-4">
        <h2 class="text-xl font-semibold mb-4">Tarefas</h2>
        {{modalCriarTarefa}}

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" id="tasklist">
            {{tarefas}}
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let profilePicDiv = $(".profile-pic");
        let currentPic = parseInt(profilePicDiv.css("background-image").match(/(\d+)\.webp/)[1]);
        let ajaxPromise = Promise.resolve();

        profilePicDiv.click(function() {
            currentPic = (currentPic + 1) % 13;
            $(this).css("background", `url('https://arthurbrenno-avatarstrabalho.s3.sa-east-1.amazonaws.com/${currentPic}.webp') center / cover no-repeat`);

            ajaxPromise = ajaxPromise.then(() => $.ajax({
                url: '/changeavatar',
                type: 'POST',
                data: { avatarNumber: currentPic }
            }));
        });

        $("textarea").change(function(e) {
            e.preventDefault();
            ajaxPromise = ajaxPromise.then(() => submitForm($(this).closest("form")));
        });

        $(".deleteButton").click(function(e) {
            e.preventDefault();
            ajaxPromise = ajaxPromise.then(() => submitForm($(this).closest("form"), true));
        });

        function submitForm(form, isDelete=false) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: form.serialize(),
                    xhrFields: { withCredentials: true },
                    success: function(data) {
                        if (isDelete) form.closest('.formContainer').hide();
                        resolve(data);
                    },
                    error: reject
                });
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const createTaskButton = document.getElementById('createTaskButton');
        const createTaskModal  = document.getElementById('createTaskModal');

        createTaskButton.addEventListener('click', () => {
            if (createTaskModal.classList.contains('hidden') || createTaskModal.classList.contains('hide')) {
                createTaskModal.classList.remove('hidden', 'hide');
                createTaskModal.classList.add('show');
            } else {
                createTaskModal.classList.remove('show');
                createTaskModal.classList.add('hide');
                setTimeout(() => {
                    if (createTaskModal.classList.contains('hide')) {
                        createTaskModal.classList.add('hidden');
                    }
                }, 1000);
            }
        });

        const taskForm = document.getElementById('taskForm');
        taskForm.addEventListener('submit', (e) => {
            e.preventDefault();

            createTaskModal.classList.remove('show');
            createTaskModal.classList.add('hide');
            setTimeout(() => {
                if (createTaskModal.classList.contains('hide')) createTaskModal.classList.add('hidden');
            }, 1000);
        });
    });
</script>

