<x-app-layout>

    <div class="py-12">
        <div class="ml-10 menuAdmin">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-center">Statystyki użytkownika "{{Auth::user()->name}}":</h2>
                    <h5>Ilość wypozyczonych ksiązek ogółem:</h5>
                    <h5>Ilość wypozyczonych ksiązek w ostatnim miesiącu:</h5>
                    <h5>Ulubiona książka:</h5>
                    <h5>Ulubiony autor:</h5>
                    <h5>Ulubiony gatunek:</h5>
                    {{Auth::user()}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
