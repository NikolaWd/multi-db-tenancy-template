<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Domain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                

                <form action="{{ url('domain') }}" class="px-3 py-4" method="POST">
                    <x-success-status class="mb-4 mt-6 ml-10" :status="session('message')" />
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <x-input-label for="Name" :value="__('Ime')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Domain -->
                    <div class="mb-4">
                        <x-input-label for="subdomain" :value="__('Domen')" />
                        <x-text-input id="subdomain" onkeyup="check_data()" class="block mt-1 w-full" type="text" name="subdomain" :value="old('subdomain')"  />
                        <x-input-error :messages="$errors->get('subdomain')" class="mt-2" />
                        <div style="color:white;">Domen mora da ispunjava sledeće uslove:</div>
                        <ul>
                            <li><span style="color: red;" id="min_char">Minimum 4 karaktera</span></li>
                            <li><span style="color: red;" id="max_char">Maksimalno 12 karaktera</span></li>
                            <li><span style="color: red;" id="no_space">Ne sme imati razmak između reči</span></li>
                            <li><span style="color: red;" id="numbers">Ne sme sadržati brojeve i simbole</span></li>
                            <li><span style="color: red;" id="letterSmall">Mora imati isključivo mala slova</span></li>
                        </ul>
                    </div>

                    <!-- Button -->
                    <x-primary-button class="ml-3 mt-6" id="create_tenant">
                        {{ __('Dodaj') }}
                    </x-primary-button>

                </form>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('create_tenant').disabled = true;

        function check_data(){

            let subdomain = $("#subdomain").val();
            let color = "rgb(77, 206, 77)";

            if (subdomain.length >= 4 && subdomain.length < 12) {
                $("#min_char").css({
                    "color": color
                });
                $("#max_char").css({
                    "color": color
                });
            } else {
                $("#min_char").css({
                    "color": "red"
                });
                $("#max_char").css({
                    "color": "red"
                });
            }


            if (/[a-z]+$/.test(subdomain)) {
                $("#letterSmall").css({
                    "color": color
                });
            } else {
                $("#letterSmall").css({
                    "color": "red"
                });
            }

            if (/[A-Z]/.test(subdomain)) {
                document.getElementById('create_tenant').disabled = true;
            } else {
                document.getElementById('create_tenant').disabled = false;
            }

            if(subdomain.includes(" ")){
                $("#no_space").css({
                    "color": "red"
                });
            } else {
                $("#no_space").css({
                    "color": color
                });
            }

            if(/\d/.test(subdomain)){
                $("#numbers").css({
                    "color": "red"
                });
            } else {
                $("#numbers").css({
                    "color": color
                });
            }


            if (subdomain.length >= 4 && subdomain.length < 12 && !subdomain.includes(" ") && /[a-z]+$/.test(subdomain) && !/[A-Z]/.test(subdomain) && !/\d/.test(subdomain))
                document.getElementById('create_tenant').disabled = false;
            else
                document.getElementById('create_tenant').disabled = true;
                
        }

    </script>

</x-app-layout>