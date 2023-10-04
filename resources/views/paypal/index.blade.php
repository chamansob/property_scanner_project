<x-frontend-layout> 

 <div class="full-row py-5">
        <div class="container">
        <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Make A Payment</h1>
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <center>
            <a href="{{ route('make.payment') }}" class="w-full bg-indigo-500 uppercase rounded-xl font-extrabold text-dark px-6 h-8">Pay with PayPal👉</a>
        </center>
    </div>
</div>

</x-frontend-layout>