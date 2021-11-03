<x-app-layout>
    <div class="max-w-2xl bg-white py-10 px-5 m-auto w-full mt-10">

        <div class="text-3xl mb-6 text-center ">
            {{ 'Edit task '. $task->name }}
        </div>

        <form method="post" action="{{ route('tasks.update', $task) }}}">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4 max-w-xl m-auto">

                <div class="col-span-2 lg:col-span-1">
                    <input name="category" type="text"
                           class="border-solid border-gray-400 border-2 p-3 md:text-xl w-full"
                           value="{{ $task->category ?? 'Category' }}"/>
                </div>
                @error('category')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="col-span-2">
                    <textarea name="name" cols="30" rows="8"
                              class="border-solid border-gray-400 border-2 p-3 md:text-xl w-full"
                              placeholder="Task description">
                        {{ $task->name ?? '' }}
                    </textarea>
                </div>
                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="col-span-2 text-right">
                    <button class="py-3 px-6 bg-green-500 text-white font-bold w-full sm:w-32">
                        Update
                    </button>
                </div>

            </div>
        </form>

    </div>
</x-app-layout>

