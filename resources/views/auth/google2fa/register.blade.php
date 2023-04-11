<x-guest-layout>
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-x-8 mx-auto">
            <div class="col-span-4 md:col-span-6 lg:col-span-4 mx-auto">
                <div class="my-8">
                    <div style="text-align: center;">
                        <p class="mb-4">Set up your two factor authentication by scanning the QRcode below with your Google Authenticator app.</p>

                        <div class="flex justify-center mb-4">
                            {!! $QR_Image !!}
                        </div>

                        <p class="mb-8">
                            Alternatively, you can use the code <strong>{{ $secret }}</strong>
                        </p>
                        <div class="mt-8">
                            <a class="inline-flex items-center px-4 py-2 hover:bg-red-500 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-900 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition ease-in-out duration-150 hover:bg-gray-900" href="/complete-registration">
                                {{ __('Complete Registration') }}
                            </a>
                            <p class="mt-4">
                                or
                            </p>
                            <a href="/" class="mt-4 hover:underline no-underline hover:cursor-pointer">
                                <u>Cancel Login</u>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
