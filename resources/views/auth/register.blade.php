<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img style="height: 12vh"
                     src="https://i.ibb.co/FsmWnWM/kisspng-vector-graphics-book-stock-illustration-logo-research-vector-book-transparent-amp-png-clipar.png">
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <div style="overflow: auto; max-height: 70vh">
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div class="registerForm">
                <x-label for="name" :value="__('Nazwa')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus/>
            </div>

            <!-- Email Address -->
            <div class="registerForm">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            </div>

            <!-- Password -->
            <div class="registerForm">
                <x-label for="password" :value="__('Hasło')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="registerForm">
                <x-label for="password_confirmation" :value="__('Potwierdź hasło')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            <!-- Age -->
            <div class="registerForm">
                <x-label for="age" :value="__('Wiek')"/>

                <x-input id="age" class="block mt-1 w-full" type="text" name="age" :value="old('age')" required/>
            </div>


            <!-- Living -->
            <div class="registerForm">
                <x-label for="living" :value="__('Miasto/Wieś')"/>

                <select id="living" class="block mt-1 w-full" name="living" :value="old('living')" required>
                    <option selected="selected" value="" disabled>Wybierz z listy...</option>
                    <option value="Miasto">Miasto</option>
                    <option value="Wieś">Wieś</option>
                </select>
            </div>


            <!-- Gender -->
            <div class="registerForm">
                <x-label for="gender" :value="__('Płeć')"/>

                <select id="gender" class="block mt-1 w-full" type="text" name="gender" :value="old('gender')" required>
                    <option selected="selected" value="" disabled>Wybierz z listy...</option>
                    <option value="Mężczyzna">Mężczyzna</option>
                    <option value="Kobieta">Kobieta</option>
                    <option value="Inna">Inna</option>
                </select>
            </div>

            <!-- Voivodeship -->
            <div class="registerForm">
                <x-label for="voivodeship" :value="__('Województwo')"/>

                <select id="voivodeship" class="block mt-1 w-full" type="text" name="voivodeship" :value="old('voivodeship')" required>
                    <option selected="selected" value="" disabled>Wybierz z listy...</option>
                    <option value="Dolnośląskie">Dolnośląskie</option>
                    <option value="Kujawsko-Pomorskie">Kujawsko-Pomorskie</option>
                    <option value="Lubelskie">Lubelskie</option>
                    <option value="Lubuskie">Lubuskie</option>
                    <option value="Łódzkie">Łódzkie</option>
                    <option value="Małopolskie">Małopolskie</option>
                    <option value="Mazowieckie">Mazowieckie</option>
                    <option value="Opolskie">Opolskie</option>
                    <option value="Podkarpackie">Podkarpackie</option>
                    <option value="Podlaskie">Podlaskie</option>
                    <option value="Pomorskie">Pomorskie</option>
                    <option value="Śląskie">Śląskie</option>
                    <option value="Świętokrzyskie">Świętokrzyskie</option>
                    <option value="Warmińsko-Mazurskie">Warmińsko-Mazurskie</option>
                    <option value="Wielkopolskie">Wielkopolskie</option>
                    <option value="Zachodniopomorskie">Zachodniopomorskie</option>
                </select>
            </div>


            <!-- Education -->
            <div class="registerForm">
                <x-label for="education" :value="__('Wykształcenie')"/>

                <select id="education" class="block mt-1 w-full" type="text" name="education" :value="old('education')" required>
                    <option selected="selected" value="" disabled>Wybierz z listy...</option>
                    <option value="Podstawowe">Podstawowe</option>
                    <option value="Gimnazjalne">Gimnazjalne</option>
                    <option value="Zasadnicze zawodowe">Zasadnicze zawodowe</option>
                    <option value="Średnie">Średnie</option>
                    <option value="Wyższe">Wyższe</option>
                </select>
            </div>


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Masz już konto? Zaloguj się') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Rejestracja') }}
                </x-button>
            </div>
        </form>
        </div>
    </x-auth-card>
</x-guest-layout>
