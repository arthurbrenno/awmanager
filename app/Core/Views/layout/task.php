<div class="formContainer {{cor}} rounded-lg shadow-md p-6 transform transition-all hover:scale-105">
    <form method="post" action="/updatetask">
        <input type="hidden" name="taskId" value="{{id}}">
        <textarea name="title" class="text-2xl font-semibold text-black mb-2 bg-transparent border-none outline-none resize-none h-20 w-5/6">{{titulo}}</textarea>
        <textarea name="description" class="text-gray-500 bg-transparent border-none outline-none resize-none h-20 w-5/6">{{descricao}}</textarea>
    </form>
    <form method="post" action="/deltask">
        <input type="hidden" name="id" value="{{id}}">
        <div class="flex justify-end mt-4">
            <button class="deleteButton w-8 h-8 rounded-full bg-gray-500 flex items-center justify-center hover:bg-gray-900 transition-colors duration-300" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </form>
</div>






