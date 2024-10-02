<div>
  <hr class="mt-12">
  <div class="mx-auto mt-5 flex gap-3 w-full md:w-96 items-center justify-center md:justify-between">
    {{-- button rounded --}}
    <button id="btn-prev" class="btn-rounded pr-4 disabled">
      <x-heroicon-m-chevron-left class="h-8 w-8" />
      <p class="hidden md:block">Anterior</p>
      <p class="block md:hidden">Ant.</p>
    </button>
    <div>
      <span class="font-bold">Página <span class="current-page">1</span></span> de <span class="total-page">6</span>
    </div>
    <button id="btn-next" class="btn-rounded pl-4">
      <p class="hidden md:block">Siguiente</p>
      <p class="block md:hidden">Sig.</p>
      <x-heroicon-m-chevron-right class="h-8 w-8" />
    </button>
  </div>
</div>
