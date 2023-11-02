<div id="createTaskModal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-96">
        <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-100 rounded-t-lg">
            <div class="flex space-x-2">
                <button class="w-3 h-3 bg-red-500 rounded-full hover:bg-red-600" onclick="fecharModal()"></button>
                <button class="w-3 h-3 bg-yellow-500 rounded-full hover:bg-yellow-600"></button>
                <button class="w-3 h-3 bg-green-500 rounded-full hover:bg-green-600"></button>
            </div>
            <h3 class="text-lg font-semibold">Nova Tarefa</h3>
        </div>
        <form id="taskForm" class="p-4 space-y-4" action="/createtask" method="post" onsubmit="submitForm(event)">
            <div>
                <input required type="text" id="titulo" name="title" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md p-2 text-base outline-none" placeholder="Título">
            </div>
            <div>
                <input type="text" id="descricao" name="description" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md p-2 text-base outline-none resize-none" rows="4" placeholder="Descrição"></input>
            </div>
            <div>
                <div class="flex space-x-4">
                    <label>
                        <input type="radio" name="priority" value="Baixa" class="hidden">
                        <span class="px-2 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-600 cursor-pointer" onclick="setBrightness(this)">Sem pressa</span>
                    </label>
                    <label>
                        <input type="radio" name="priority" value="Media" class="hidden">
                        <span class="px-2 py-1 rounded-md bg-yellow-500 text-white hover:bg-yellow-600 cursor-pointer" onclick="setBrightness(this)">Atenção</span>
                    </label>
                    <label>
                        <input type="radio" name="priority" value="Alta" class="hidden">
                        <span class="px-2 py-1 rounded-md bg-red-500 text-white hover:bg-red-600 cursor-pointer" onclick="setBrightness(this)">Urgente</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="bg-black text-white rounded p-2 hover:bg-blue-600 transition duration-200 ease-in-out">Criar</button>
        </form>
    </div>
</div>

<script>
    let labels;
    let modal;

    const setBrightness = (element) => {
        labels = labels || document.querySelectorAll("input[type=radio]");
        labels.forEach(label => {
            label.nextElementSibling.style.filter = "brightness(20%)";
        });
        element.style.filter = "brightness(100%)";
        element.previousElementSibling.checked = true;
    }

    const fecharModal = () => {
        modal = modal || document.getElementById('createTaskModal');
        modal.classList.add('hidden');
    }

    let queue = Promise.resolve();

    const submitForm = async (event) => {
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        if (!formData.get('priority')) {
            alert('Por favor, selecione uma prioridade.');
            return;
        }

        try {
            const response = await fetch('/createtask', {
                method: 'POST',
                body: formData,
                credentials: 'include'
            });

            if (response.status === 200) {
                const htmlTask = await response.text();

                const taskList = document.getElementById('tasklist');
                taskList.insertAdjacentHTML('beforeend', htmlTask);

                // Aguardar segundos antes de redirecionar para o dashboard
                await new Promise(resolve => setTimeout(resolve, 900));

                // Redirecionar para o dashboard
                window.location.href = '/dashboard';

                fecharModal();
            } else {
                throw new Error('Erro ao criar a tarefa');
            }
        } catch (error) {
            console.error('Ocorreu um erro:', error);
        }
    };
</script>





