<x-guest-layout>
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-x-8 mx-auto">
            <div class="col-span-4 md:col-span-6 lg:col-span-4 mx-auto">
                <div class="my-8">
                    <div style="text-align: center;">
                        <p class="mb-4">Please enter the <strong>OTP</strong> generated on your Authenticator App</p>
                        <p class="mb-4">
                            Alternatively, an email has been sent to you with the <strong>current OTP</strong>
                        </p>

                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <x-input-label for="name" :value="__('One Time Password')" />
                                    <x-input-error :messages="$errors->get('one_time_password')" class="mt-2" />
                                    <div class="mb-8">
                                        <input id="one_time_password" type="number" name="one_time_password" class="form-control" required autofocus>
                                    </div>
                                </div>


                                <div class="mt-8">
                                    <button type="submit" class="inline-flex px-10 py-2 hover:bg-red-500 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-900 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition ease-in-out duration-150 hover:bg-gray-900">
                                        Login
                                    </button>
                                    <form method="POST" action="{{ route('sendGoogle2FACode') }}">
                                        @csrf
                                        <button  class="mt-4 inline-flex px-4 py-2 hover:bg-red-500 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-900 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition ease-in-out duration-150 hover:bg-gray-900" type="button" id="send-google-2fa-code">Resend Email</button>
                                    </form>
                                </div>
                            </form>

                            <p class="mt-4">or</p>
                            @if(\Illuminate\Support\Facades\View::exists('dashboard'))
                                <form method="POST" class="mt-4 dropdown-item cursor-pointer" action="{{ route('logout') }}">
                                @csrf
                                    <button class="hover:underline no-underline hover:cursor-pointer" type="submit">
                                        Cancel Action
                                    </button>
                                </form>
                            @endif
                                <p class="mt-12">Ensure you submit the current one because it refreshes every <strong>30 seconds</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
