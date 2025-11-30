<section>
    <header>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
            {{ __("Actualiza la información de tu perfil y dirección de correo electrónico.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mb-6">
            
            {{-- Nombre (Todos) --}}
            <div class="w-full">
                <label class="mb-2.5 block text-black dark:text-white font-medium">
                    Nombre Completo
                </label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                    class="w-full rounded border-[1.5px] border-gray-300 bg-transparent py-3 px-5 font-medium outline-none transition focus:border-indigo-600 active:border-indigo-600 disabled:cursor-default disabled:bg-whiter dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-indigo-600" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Email (Todos) --}}
            <div class="w-full">
                <label class="mb-2.5 block text-black dark:text-white font-medium">
                    Correo Electrónico
                </label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                    class="w-full rounded border-[1.5px] border-gray-300 bg-transparent py-3 px-5 font-medium outline-none transition focus:border-indigo-600 active:border-indigo-600 disabled:cursor-default disabled:bg-whiter dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-indigo-600" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Tu dirección de correo no está verificada.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                        </button>
                    </div>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Se ha enviado un nuevo enlace de verificación.') }}
                        </p>
                    @endif
                @endif
            </div>

            {{-- 🎓 CAMPOS EXCLUSIVOS PARA PARTICIPANTES --}}
            @if(isset($esParticipante) && $esParticipante)
                
                {{-- No. Control --}}
                <div class="w-full">
                    <label class="mb-2.5 block text-black dark:text-white font-medium">
                        Número de Control
                    </label>
                    <input type="text" name="no_control" value="{{ old('no_control', $user->participante->no_control ?? '') }}" required
                        class="w-full rounded border-[1.5px] border-gray-300 bg-transparent py-3 px-5 font-medium outline-none transition focus:border-indigo-600 active:border-indigo-600 disabled:cursor-default disabled:bg-whiter dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-indigo-600" />
                    <x-input-error class="mt-2" :messages="$errors->get('no_control')" />
                </div>

                {{--Telefono--}}
                <div class="w-full">
                    <label class="mb-2.5 block text-black dark:text-white font-medium">
                        Telefono
                    </label>
                    <input type="number" name="telefono" value="{{ old('telefono', $user->participante->telefono ?? '') }}" required
                        class="w-full rounded border-[1.5px] border-gray-300 bg-transparent py-3 px-5 font-medium outline-none transition focus:border-indigo-600 active:border-indigo-600 disabled:cursor-default disabled:bg-whiter dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-indigo-600" />
                    <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
                </div>
                {{-- Carrera --}}
                <div class="w-full">
                    <label class="mb-2.5 block text-black dark:text-white font-medium">
                        Carrera
                    </label>
                    <div class="relative z-20 bg-transparent dark:bg-gray-700 rounded">
                        <select name="carrera_id"
                            class="relative z-20 w-full appearance-none rounded border-[1.5px] border-gray-300 bg-transparent py-3 px-5 outline-none transition focus:border-indigo-600 active:border-indigo-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-indigo-600">
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->id }}" 
                                    {{ (old('carrera_id') ?? ($user->participante->carrera_id ?? '')) == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2">
                            <svg class="fill-current text-gray-500 dark:text-gray-400" width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill="currentColor"></path></svg>
                        </span>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('carrera_id')" />
                </div>
            @endif

        </div>

        <div class="flex items-center gap-4 justify-end">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >
                    ✓ {{ __('Guardado correctamente.') }}
                </p>
            @endif

            <button type="submit" class="flex justify-center rounded bg-indigo-600 py-2 px-6 font-medium text-white hover:bg-opacity-90 hover:bg-indigo-700 transition">
                {{ __('Guardar Cambios') }}
            </button>
        </div>
    </form>
</section>