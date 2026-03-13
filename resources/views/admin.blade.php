<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-end gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                Список заявок
            </h2>
            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Пошук..." value="{{ request('search') }}"
                    class="border rounded py-1 px-2">
                <select name="status"
                    class="p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 w-60">
                    <option value="">Виберіть статус</option>
                    <option value="new">Новий</option>
                    <option value="in_progress">В роботі</option>
                    <option value="resolved">Вирішений</option>
                </select>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="border rounded py-1 px-2">
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="border rounded py-1 px-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Пошук
                </button>
                <a href="{{ route('tickets.statistics') }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Статистика
                </a>
                <a href="{{ route('home') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ">
                    На сайт
                </a>
            </form>
        </div>
    </x-slot>
    <div class="py-12 container mx-auto px-4">
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="table-fixed w-full ">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-gray-600 uppercase text-xs font-medium">
                        <th class="admin-table-th w-20">Номер заявки</th>
                        <th class="admin-table-th w-24">Номер клієнта</th>
                        <th class="admin-table-th w-48">Ім'я</th>
                        <th class="admin-table-th w-32">Телефон</th>
                        <th class="admin-table-th w-32">Email</th>
                        <th class="admin-table-th w-64">Тема</th>
                        <th class="admin-table-th w-80">Опис звернення</th>
                        <th class="admin-table-th w-80">Скріншот</th>
                        <th class="admin-table-th w-32">Статус</th>
                        <th class="admin-table-th w-48">Відповідь</th>
                        <th class="admin-table-th w-40">Створено</th>
                        <th class="admin-table-th w-40">Оновлено</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($tickets as $ticket)
                    <tr class="hover:bg-gray-50">
                        <td class="admin-table-td">{{ $ticket->id }}</td>
                        <td class="admin-table-td">{{ $ticket->customer_id }}</td>
                        <td class="admin-table-td">{{ $ticket->customer->name }}</td>
                        <td class="admin-table-td">{{ $ticket->customer->phone }}</td>
                        <td class="admin-table-td">{{ $ticket->customer->email }}</td>
                        <td class="admin-table-td">{{ $ticket->subject }}</td>
                        <td class="admin-table-td">{{ $ticket->message }}</td>
                        <td class="admin-table-td">
                            @if($ticket->hasMedia('tickets_attachments'))
                            <a href="{{ $ticket->getFirstMediaUrl('tickets_attachments') }}"
                                download="{{ $ticket->subject }}-attachment" target="_blank"
                                class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full hover:bg-indigo-200 transition">
                                Відкрити
                            </a>
                            <a href="{{ route('tickets.download', $ticket->getFirstMedia('tickets_attachments')) }}"
                                download
                                class="p-1.5 bg-gray-100 text-gray-600 rounded-full hover:bg-gray-200 transition"
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-indigo-700 rounded-full hover:bg-indigo-200 transition">
                                Скачати
                            </a>
                            @else
                            <span class="text-gray-400 italic text-xs">Немає файлу</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 min-w-5">
                            <form action="{{route('tickets.updateStatus', $ticket)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="text-xs w-full p-1.5" onchange="this.form.submit()">
                                    <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>Новий</option>
                                    <option value="in_progress"
                                        {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>В роботі</option>
                                    <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>
                                        Вирішений</option>
                                </select>
                            </form>
                        </td>
                        <td class="admin-table-td">
                            {{ $ticket->manager_replied_at == null ? 'Не відповіли' : 'Відповіли' }}</td>
                        <td class="admin-table-td">{{ $ticket->created_at }}</td>
                        <td class="admin-table-td">{{ $ticket->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $tickets->links()}}
        </div>
    </div>

</x-app-layout>