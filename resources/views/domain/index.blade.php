<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight d-flex">
            {{ __('Lista Domena') }} <a href="{{url('domain')}}" class="text-white mt-6 px-3 d-flex" style="border: 1px solid white; border-radius:7px;">Dodaj Domen</a>
        </h2>
        
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto text-lime-700">
                <x-success-status class="mb-4 mt-6 ml-10" :status="session('message')" />
            </div>
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 p-3">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 p-4">
                            <tr class="p-4">
                                <th scope="col" class="px-6 py-3 p-4">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Ime
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Domen
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Datum kreiranja
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Akcija
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tenants as $t)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{$t->id}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$t->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$t->email}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$t->domain}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$t->created_at}}
                                    </td>
                                    <td class="px-6 py-4 text-red-600">
                                        <form action="{{ route('domains.destroy', $t->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="if(!confirm('Da li ste sigurni?')){return false;}else return true;" type="submit">Obrisi</button>
                                        </form>                                    
                                    </td>
                                </tr>
                            @empty
                                <tr align="center">
                                    <td colspan="6" class="py-4 text-red-600">Spisak domena je trutno prazan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div>

</x-app-layout>