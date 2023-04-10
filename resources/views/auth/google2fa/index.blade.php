<x-guest-layout>
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-4 md:gap-x-8 mx-auto">
            <div class="col-span-4 md:col-span-6 lg:col-span-4 mx-auto">
                <div class="my-8">
                    <div style="text-align: center;">
                        <p class="mb-4">Please enter the  <strong>OTP</strong> generated on your Authenticator App. <br> Ensure you submit the current one because it refreshes every 30 seconds.</p>

                        <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="one_time_password" class="col-md-4 control-label">One Time Password</label>
                                <div class="mb-8">
                                    <input id="one_time_password" type="number" class="form-control" name="one_time_password" required autofocus>
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="mt-8">
                                <button type="submit" class="inline-flex px-4 py-2 hover:bg-red-500 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-900 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition ease-in-out duration-150 hover:bg-gray-900">
                                    Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
