<div class="text-center">
  <div class="w-32 h-32 mb-5 rounded-full mx-auto border bg-verde-adecco/50 overflow-hidden">
    <img class="w-full h-36 object-cover" src="{{ $image }}" />
  </div>
  <h3 class="text-3xl font-lust text-balance"> {{ $title }}</h3>
  <span class="w-20 h-[3px] my-4 bg-verde-adecco block mx-auto"></span>
  <p class="text-2xl">{{ $slot }} </p>
</div>
