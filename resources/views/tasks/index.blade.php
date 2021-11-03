<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tasks
        </h2>
    </x-slot>

    <a href="{{route('tasks.create')}}" class="text-2xl m-16 text-green-800">Create Task</a>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div
                    class="
          shadow
          overflow-hidden
          border-b border-gray-200
          sm:rounded-lg
        "
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th
                                scope="col"
                                class="
                  px-6
                  py-3
                  text-left text-xs
                  font-medium
                  text-gray-500
                  uppercase
                  tracking-wider
                "
                            >
                                Name
                            </th>
                            <th
                                scope="col"
                                class="
                  px-6
                  py-3
                  text-left text-xs
                  font-medium
                  text-gray-500
                  uppercase
                  tracking-wider
                "
                            >
                                Category
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <label class="container">
                                                    <input type="checkbox"
                                                           onclick="{{ route('tasks.complete' , $task) }}">

                                                </label>
                                                @if($task->completed_at) <s> @endif
                                                    {{ $task->name }}
                                                    @if($task->completed_at) </s> @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ $task->category}}
                                    </div>
                                </td>
                                <td
                                    class="
                  px-6
                  py-4
                  whitespace-nowrap
                  text-right text-sm
                  font-medium
                "
                                >
                                    <a href="{{ route('tasks.edit', $task) }}"
                                       class="text-indigo-600 hover:text-indigo-900"
                                    >Edit</a
                                    >
                                </td>
                                <td
                                    class="
                  px-6
                  py-4
                  whitespace-nowrap
                  text-right text-sm
                  font-medium
                "
                                >
                                    <form method="post" action="{{ route('tasks.destroy' , $task) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600" type="submit" onclick="confirm('Confirm Delete')">
                                            DELETE
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
